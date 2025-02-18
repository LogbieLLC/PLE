<?php

declare(strict_types=1);

namespace PLEPHP\Setup;

require_once __DIR__ . '/vendor/autoload.php';

use RedBeanPHP\R;
use function PLEPHP\Config\initializeDatabase;
use function PLEPHP\Config\configureModels;

/**
 * PLE System Setup Script
 * 
 * This script validates server configuration and sets up the PLE system.
 * It can be run via CLI or web interface.
 */

// Determine if running via CLI or web
$isCli = php_sapi_name() === 'cli';
$errors = [];
$success = [];

/**
 * Log a message to appropriate output
 */
function log_message(string $message, string $type = 'info'): void {
    global $isCli;
    
    $prefix = match($type) {
        'error' => '❌ ',
        'success' => '✅ ',
        default => 'ℹ️ '
    };
    
    if ($isCli) {
        echo $prefix . $message . PHP_EOL;
    } else {
        echo "<div class='message $type'>$prefix $message</div>";
    }
}

/**
 * Configure and validate PHP settings
 */
function configure_php(): array {
    $errors = [];
    $required_version = '8.2.0';
    
    // Check PHP version
    if (version_compare(PHP_VERSION, $required_version, '<')) {
        $errors[] = "PHP version must be $required_version or higher. Current version: " . PHP_VERSION;
    }
    
    // Configure timezone
    $required_timezone = 'America/Chicago';
    if (!date_default_timezone_set($required_timezone)) {
        $errors[] = "Failed to set timezone to $required_timezone";
    }
    
    // Verify timezone setting
    $current_timezone = date_default_timezone_get();
    if ($current_timezone !== $required_timezone) {
        $errors[] = "Timezone must be set to $required_timezone. Current timezone: $current_timezone";
    }
    
    // Check required extensions
    $required_extensions = [
        'pdo_sqlite',
        'mbstring',
        'json',
        'xml',
        'curl',
        'openssl'
    ];
    
    $optional_extensions = [
        'fpm'  // Optional for local development
    ];
    
    $errors = [];
    
    // Check PHP version
    if (version_compare(PHP_VERSION, $required_version, '<')) {
        $errors[] = "PHP version must be $required_version or higher. Current version: " . PHP_VERSION;
    }
    
    // Check required extensions
    foreach ($required_extensions as $ext) {
        if (!extension_loaded($ext)) {
            $errors[] = "Required PHP extension missing: $ext";
        }
    }
    
    // Check optional extensions
    foreach ($optional_extensions as $ext) {
        if (!extension_loaded($ext)) {
            log_message("Optional extension not available: $ext", 'info');
        }
    }
    
    return $errors;
}

/**
 * Validate timezone configuration
 */
function validate_timezone(): array {
    $errors = [];
    $required_timezone = 'America/Chicago';
    
    $current_timezone = date_default_timezone_get();
    if ($current_timezone !== $required_timezone) {
        $errors[] = "Timezone must be set to $required_timezone. Current timezone: $current_timezone";
    }
    
    return $errors;
}

/**
 * Validate directory permissions
 */
function validate_directories(): array {
    $errors = [];
    $required_dirs = [
        'data' => 0775,
        'cache' => 0775,
        'templates' => 0755,
        'public' => 0755,
        'logs' => 0775
    ];
    
    // Required PHP extensions
    $required_extensions = [
        'pdo_sqlite',
        'mbstring',
        'json',
        'xml',
        'curl',
        'openssl',
        'fpm'
    ];
    
    foreach ($required_dirs as $dir => $perms) {
        $path = __DIR__ . "/$dir";
        
        // Create directory if it doesn't exist
        if (!is_dir($path)) {
            log_message("Creating directory: $dir");
            if (!@mkdir($path, 0777, true)) {
                $errors[] = "Failed to create directory: $dir";
                continue;
            }
        }
        
        // Try to set permissions, but don't fail if we can't
        $current_perms = octdec(substr(sprintf('%o', fileperms($path)), -4));
        if ($current_perms !== $perms) {
            @chmod($path, $perms);
            log_message("Note: Optimal permissions ($perms) could not be set for $dir", 'info');
        }
        
        // Verify directory is usable
        if (!is_readable($path)) {
            $errors[] = "Directory not readable: $dir";
        }
        if (!is_writable($path)) {
            log_message("Warning: Directory not writable: $dir. Using fallback permissions.", 'info');
            // Try fallback permissions
            @chmod($path, 0777);
            if (!is_writable($path)) {
                $errors[] = "Directory not writable: $dir";
            }
        }
    }
    
    return $errors;
}

/**
 * Initialize database and create admin account
 */
function initialize_database(): array {
    $errors = [];
    
    try {
        // Initialize database
        initializeDatabase();
        
        // Verify database connection
        if (!R::testConnection()) {
            throw new \Exception('Database connection failed');
        }
        
        // Configure models
        configureModels();
        
        // Create admin user if it doesn't exist
        if (!R::count('user')) {
            $admin = R::dispense('user');
            $admin->username = 'admin';
            $admin->password = password_hash('admin', PASSWORD_DEFAULT);
            $admin->role = 'admin';
            R::store($admin);
        }
        
    } catch (\Exception $e) {
        $errors[] = "Database initialization failed: " . $e->getMessage();
    }
    
    return $errors;
}

/**
 * Run setup process
 */
function run_setup(): void {
    global $errors, $success, $isCli;
    
    // Output header
    if (!$isCli) {
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>PLE System Setup</title>
            <style>
                body { font-family: sans-serif; max-width: 800px; margin: 2em auto; padding: 0 1em; }
                .message { padding: 1em; margin: 0.5em 0; border-radius: 4px; }
                .error { background: #fee; color: #c00; }
                .success { background: #efe; color: #0a0; }
                .info { background: #eef; color: #00c; }
            </style>
        </head>
        <body>
        <h1>PLE System Setup</h1>";
    }
    
    // Run configuration and validation steps
    log_message("Starting PLE system setup...");
    
    // 1. Configure PHP and timezone
    log_message("Configuring PHP and timezone settings...");
    if ($php_errors = configure_php()) {
        $errors = array_merge($errors, $php_errors);
    } else {
        $success[] = "PHP configuration valid";
        $success[] = "Timezone configured to America/Chicago";
    }
    
    // 2. Check PHP-FPM status
    log_message("Checking PHP-FPM status...");
    if (extension_loaded('fpm')) {
        $success[] = "PHP-FPM extension loaded";
    } else {
        $errors[] = "PHP-FPM extension not available. Please install php8.2-fpm package";
    }
    
    // 3. Validate directories
    log_message("Checking directory permissions...");
    if ($dir_errors = validate_directories()) {
        $errors = array_merge($errors, $dir_errors);
    } else {
        $success[] = "Directory permissions valid";
    }
    
    // 4. Initialize database
    log_message("Initializing database...");
    if ($db_errors = initialize_database()) {
        $errors = array_merge($errors, $db_errors);
    } else {
        $success[] = "Database initialized successfully";
    }
    
    // Output results
    if ($errors) {
        log_message("Setup completed with errors:", 'error');
        foreach ($errors as $error) {
            log_message($error, 'error');
        }
    } else {
        log_message("Setup completed successfully!", 'success');
        foreach ($success as $msg) {
            log_message($msg, 'success');
        }
        log_message("Default admin credentials:", 'info');
        log_message("Username: admin", 'info');
        log_message("Password: admin", 'info');
        log_message("Please change these credentials immediately after first login.", 'info');
    }
    
    // Output footer
    if (!$isCli) {
        echo "</body></html>";
    }
}

// Execute setup
run_setup();
