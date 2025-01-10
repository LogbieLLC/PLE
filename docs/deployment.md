# PLE System Deployment Guide

## Server Requirements
- Ubuntu 24.04 LTS
- PHP 8.2
- Nginx
- SQLite3

## Required PHP Extensions
- php8.2-fpm
- php8.2-sqlite3
- php8.2-mbstring
- php8.2-intl
- php8.2-xml
- php8.2-curl

## Deployment Steps

### 1. Server Preparation
```bash
# Update package lists
apt-get update

# Add PHP repository
add-apt-repository -y ppa:ondrej/php

# Install required packages
apt-get install -y nginx php8.2-fpm php8.2-sqlite3 php8.2-mbstring php8.2-intl php8.2-xml php8.2-curl composer unzip
```

### 2. Application Setup
```bash
# Create application directory
mkdir -p /var/www/ple/php-backend/data

# Set proper permissions
chown -R www-data:www-data /var/www/ple
chmod -R 755 /var/www/ple
chmod -R 775 /var/www/ple/php-backend/data
```

### 3. Nginx Configuration
Create a new Nginx site configuration at `/etc/nginx/sites-available/ple`:
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

Enable the site:
```bash
ln -sf /etc/nginx/sites-available/ple /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default
systemctl restart nginx php8.2-fpm
```

### 4. Application Deployment
```bash
# Copy application files
cd /var/www/ple
tar xzf php-backend.tar.gz

# Install dependencies
cd php-backend
COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader

# Set final permissions
chown -R www-data:www-data /var/www/ple
chmod -R 755 /var/www/ple
chmod -R 775 /var/www/ple/php-backend/data
```

### 5. Database Setup
The SQLite database will be automatically created in `/var/www/ple/php-backend/data/ple.db` when the application is first accessed. The directory permissions are set to allow the web server to create and modify the database file.

### 6. Initial Access
- Access the application at http://143.244.164.33
- Default admin credentials:
  - Username: admin
  - Password: admin
  - **Important**: Change these credentials immediately after first login

### 7. Security Considerations
1. Configure a firewall (UFW recommended)
2. Set up SSL/TLS certificates
3. Change default admin credentials
4. Regularly update system packages
5. Monitor log files in /var/log/nginx and /var/log/php

### 8. Maintenance
- Logs are located in:
  - Nginx: `/var/log/nginx/`
  - PHP-FPM: `/var/log/php8.2-fpm.log`
  - Application: `/var/www/ple/php-backend/data/logs/`
- Database backups should be taken from `/var/www/ple/php-backend/data/ple.db`
