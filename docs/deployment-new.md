# PLE System Deployment Documentation

## Production Server Details
- IP Address: 38.68.14.35
- Domain: ple.logbie.com
- Operating System: Ubuntu (6.8.0-51-generic)
- Web Server: Nginx
- PHP Version: 8.2.27
- Database: SQLite3
- User: ple

## Required PHP Extensions
- php8.2-fpm
- php8.2-sqlite3
- php8.2-mbstring
- php8.2-intl
- php8.2-xml
- php8.2-curl

## Deployment Process

### 1. Package Preparation
```bash
# Create deployment package
cd ~/repos/PLE
tar czf ple-app.tar.gz ./ --exclude='.git' --exclude='vendor' --exclude='node_modules'
```

### 2. Server Access
```bash
# SSH access using DO_SSH_KEY
ssh -i $DO_SSH_KEY ple@38.68.14.35
```

### 3. File Transfer
```bash
# Create application directory
ssh -i $DO_SSH_KEY ple@38.68.14.35 'mkdir -p ~/webapps/ple'

# Copy deployment package
scp -i $DO_SSH_KEY ple-app.tar.gz ple@38.68.14.35:~/webapps/ple/
```

### 4. Application Setup
```bash
# Extract application files
cd ~/webapps/ple
tar xzf ple-app.tar.gz

# Install dependencies
composer install --no-dev --optimize-autoloader

# Set permissions
chmod -R 755 ~/webapps/ple
chmod -R 775 ~/webapps/ple/data
```

### 5. Database Configuration
- Location: `~/webapps/ple/data/ple.db`
- Auto-created on first access
- Permissions: 775 (web server writable)

### 6. Environment Configuration
```bash
# Set timezone to America/Chicago (UTC-6)
echo "date.timezone = America/Chicago" | sudo tee /etc/php/8.2/fpm/conf.d/timezone.ini
sudo systemctl restart php8.2-fpm

# Set debug mode (development only)
export PLE_DEBUG=false  # Production setting
```

### 7. Access Information
- URL: https://ple.logbie.com
- Default Login:
  - Username: admin
  - Password: admin
  - **Important**: Change immediately after first login

### 8. Verification Steps
1. Check web server access: `curl -L https://ple.logbie.com`
2. Verify PHP-FPM status: `systemctl status php8.2-fpm`
3. Check database permissions: `test -w ~/webapps/ple/data/ple.db`
4. Verify timezone setting: `php -r "echo date_default_timezone_get();"`

### 9. Monitoring
- Nginx logs: `/var/log/nginx/error.log`
- PHP-FPM logs: `/var/log/php8.2-fpm.log`
- Application logs: `~/webapps/ple/data/logs/`

### 10. Backup Considerations
- Database: `~/webapps/ple/data/ple.db`
- Application files: `~/webapps/ple/`

### 11. Security Notes
- Default admin credentials must be changed
- HTTPS is enforced
- Database directory permissions are 775
- fail2ban is enabled for SSH protection
- Regular system updates required

### 12. Time Window Restrictions
- Inspections only allowed between 12:00 AM and 7:00 AM
- Server timezone must be America/Chicago
- PLE_DEBUG=false in production to enforce time restrictions
