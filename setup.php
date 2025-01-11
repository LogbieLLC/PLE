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
 * Validate PHP version and extensions
 */
function validate_php(): array {
    $required_version = '8.2.0';
    $required_extensions = [
        'pdo_sqlite',
        'mbstring',
        'json',
        'xml',
        'curl',
        'openssl'
    ];
    
    $errors = [];
    
    // Check PHP version
    if (version_compare(PHP_VERSION, $required_version, '<')) {
        $errors[] = "PHP version must be $required_version or higher. Current version: " . PHP_VERSION;
    }
    
    // Check extensions
    foreach ($required_extensions as $ext) {
        if (!extension_loaded($ext)) {
            $errors[] = "Required PHP extension missing: $ext";
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
        'public' => 0755
    ];
    
    foreach ($required_dirs as $dir => $perms) {
        $path = __DIR__ . "/$dir";
        
        // Create directory if it doesn't exist
        if (!is_dir($path)) {
            if (!@mkdir($path, $perms, true)) {
                $errors[] = "Failed to create directory: $dir";
                continue;
            }
        }
        
        // Check permissions
        $current_perms = octdec(substr(sprintf('%o', fileperms($path)), -4));
        if ($current_perms !== $perms) {
            if (!@chmod($path, $perms)) {
                $errors[] = "Failed to set permissions on $dir directory";
            }
        }
        
        // Check writability
        if (!is_writable($path)) {
            $errors[] = "Directory not writable: $dir";
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
    
    // Run validation steps
    log_message("Starting PLE system setup...");
    
    // 1. Validate PHP
    log_message("Checking PHP configuration...");
    if ($php_errors = validate_php()) {
        $errors = array_merge($errors, $php_errors);
    } else {
        $success[] = "PHP configuration valid";
    }
    
    // 2. Validate timezone
    log_message("Checking timezone configuration...");
    if ($tz_errors = validate_timezone()) {
        $errors = array_merge($errors, $tz_errors);
    } else {
        $success[] = "Timezone configuration valid";
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
