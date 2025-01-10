# PLE System Deployment Documentation

## Production Server Details
- IP Address: 143.244.164.33
- Operating System: Ubuntu 24.04 LTS
- Web Server: Nginx
- PHP Version: 8.2
- Database: SQLite3

## Deployment Process

### 1. Package Preparation
```bash
# Create deployment package
cd ~/repos/PLE
tar czf php-backend.tar.gz php-backend/
```

### 2. Server Access
```bash
# Set up SSH key with proper permissions
mkdir -p ~/.ssh
chmod 700 ~/.ssh
touch ~/.ssh/do_deploy_key
chmod 600 ~/.ssh/do_deploy_key
```

### 3. File Transfer
```bash
# Create application directory
ssh -i ~/.ssh/do_deploy_key -o StrictHostKeyChecking=no root@143.244.164.33 'mkdir -p /var/www/ple'

# Copy deployment package
scp -i ~/.ssh/do_deploy_key php-backend.tar.gz root@143.244.164.33:/var/www/ple/
```

### 4. Server Configuration
```bash
# Update package lists
apt-get update

# Add PHP repository
add-apt-repository -y ppa:ondrej/php

# Install required packages
apt-get install -y nginx php8.2-fpm php8.2-sqlite3 php8.2-mbstring php8.2-intl php8.2-xml php8.2-curl composer unzip
```

### 5. Application Setup
```bash
# Extract application files
cd /var/www/ple
tar xzf php-backend.tar.gz

# Install dependencies
cd php-backend
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Set permissions
chown -R www-data:www-data /var/www/ple
chmod -R 755 /var/www/ple
chmod -R 775 /var/www/ple/php-backend/data
```

### 6. Nginx Configuration
```nginx
server {
    listen 80;
    server_name 143.244.164.33;
    root /var/www/ple/php-backend/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
    }
}
```

Save to `/etc/nginx/sites-available/ple` and enable:
```bash
ln -sf /etc/nginx/sites-available/ple /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default
systemctl restart nginx php8.2-fpm
```

### 7. Database Configuration
- Location: `/var/www/ple/php-backend/data/ple.db`
- Auto-created on first access
- Permissions: 775 (www-data writable)

### 8. Access Information
- URL: http://143.244.164.33
- Default Login:
  - Username: admin
  - Password: admin
  - **Important**: Change immediately after first login

### 9. Verification Steps
1. Check Nginx status: `systemctl status nginx`
2. Check PHP-FPM status: `systemctl status php8.2-fpm`
3. Verify permissions: `ls -la /var/www/ple/php-backend/data`
4. Test database access: `sudo -u www-data test -w /var/www/ple/php-backend/data/ple.db`

### 10. Monitoring
- Nginx logs: `/var/log/nginx/error.log`
- PHP-FPM logs: `/var/log/php8.2-fpm.log`
- Application logs: `/var/www/ple/php-backend/data/logs/`

### 11. Backup Considerations
- Database: `/var/www/ple/php-backend/data/ple.db`
- Configuration: `/etc/nginx/sites-available/ple`
- Application files: `/var/www/ple/php-backend/`

### 12. Security Notes
- Default admin credentials must be changed
- Database directory permissions are 775
- Application files are owned by www-data
- SSL/TLS certificates pending setup
