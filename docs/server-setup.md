# Server Setup Documentation

## System Information
- **OS**: Linux tarplex 6.8.0-51-generic (Ubuntu)
- **Architecture**: x86_64
- **Web Root**: /home/ple/webapps/ple
- **PHP Version**: 8.2.27 (Built: Dec 22 2024)

## PHP Configuration
- **Memory Limit**: 256M
- **Max Execution Time**: 100 seconds
- **Upload Max Filesize**: 256M
- **Post Max Size**: 256M
- **Default Timezone**: America/Chicago
- **Open Basedir**: /home/ple/webapps/ple:/var/lib/php/session:/tmp

## Enabled Extensions & Modules
- **Core Modules**: ctype, curl, date, dom, enchant
- **Database Support**: MySQL (PDO), SQLite3
- **Web Features**: 
  - curl (v8.5.0)
  - SSL/TLS Support (OpenSSL/3.0.13)
  - Zlib Support (v1.3)

## Server Software
- **Web Server**: Nginx (detected from HTTP headers)
- **HTTPS**: Enabled and enforced (301 redirects from HTTP)

## Mail Configuration
- **SMTP**: localhost:25
- **Sendmail Path**: /usr/sbin/sendmail -t -i

## Security Settings
- **expose_php**: Off (recommended)
- **display_errors**: Off (production setting)
- **log_errors**: On
- **error_reporting**: E_ALL & ~E_DEPRECATED & ~E_STRICT
- **allow_url_fopen**: On
- **allow_url_include**: Off (secure)

## File Upload Settings
- **max_file_uploads**: 20
- **upload_max_filesize**: 256M
- **post_max_size**: 256M

## Session Configuration
- **session.save_handler**: files
- **session.save_path**: /var/lib/php/session

## Notes
- Server is configured with fail2ban for security
- Web root is properly set up under user 'ple'
- HTTPS is properly configured and enforced
- Timezone is correctly set to America/Chicago as required
- Memory limits are set appropriately for a production environment
