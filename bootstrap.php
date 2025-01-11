<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

// Import required dependencies
use RedBeanPHP\R;
use function PLEPHP\Config\initializeDatabase;
use function PLEPHP\Config\configureModels;

// Clean any existing output buffers
try {
    while (ob_get_level() > 0) {
        $bufferCleaned = @ob_end_clean();
        if ($bufferCleaned === false) {
            throw new \RuntimeException('Failed to clean output buffer');
        }
    }
    // Start fresh output buffer
    $bufferStarted = @ob_start();
    if ($bufferStarted === false) {
        throw new \RuntimeException('Failed to start output buffer');
    }
} catch (\Exception $bufferException) {
    error_log('Buffer cleanup failed: ' . $bufferException->getMessage());
    // Ensure clean state
    while (ob_get_level() > 0) {
        $bufferCleaned = @ob_end_clean();
        if ($bufferCleaned === false) {
            error_log('Warning: Failed to clean buffer in error handler');
        }
    }
}

// Initialize database with output buffering
ob_start();

try {
    // Initialize database connection first
    initializeDatabase();

    // Verify database connection before proceeding
    $connectionTest = R::testConnection();
    if (!$connectionTest) {
        throw new \Exception('Database connection failed');
    }

    // Keep database in fluid mode for initialization
    R::freeze(false);

    // Keep database in fluid mode and reset for fresh start
    R::nuke();
    R::freeze(false);

    // Configure models to register types
    configureModels();

    // Verify database setup
    $verificationTest = R::testConnection();
    if (!$verificationTest) {
        throw new \Exception('Database connection verification failed');
    }

    error_log('Database initialized successfully');
    error_log('Initializing database tables...');

    // Initialize tables with test data
    foreach (['user', 'equipment', 'checklist', 'inspection_lock', 'settings'] as $table) {
        error_log("Creating table structure for: $table");

        // Create and verify table
        $bean = R::dispense($table);

        // Add test data based on table type
        switch ($table) {
            case 'user':
                // Create admin user if none exists
                if (!R::count('user')) {
                    $bean->username = 'admin';
                    $bean->password = password_hash('admin', PASSWORD_DEFAULT);
                    $bean->role = 'admin';
                    R::store($bean);
                    error_log('Admin user created');
                }
                break;

            case 'inspection_lock':
                $bean->ple_id = 'TEST1';
                $bean->inspector_id = 1;
                $bean->created = date('Y-m-d H:i:s');
                break;

            case 'equipment':
                $bean->import([
                    'ple_id' => 'TEST1',
                    'ple_id_normalized' => 'TEST1',
                    'type' => 'test',
                    'make' => 'test',
                    'model' => 'test',
                    'serial_number' => 'test',
                    'department' => 'test'
                ]);
                break;

            case 'checklist':
                $bean->import([
                    'ple_id' => 'TEST1',
                    'date_inspected' => date('Y-m-d'),
                    'time_inspected' => date('H:i:s'),
                    'inspector_initials' => 'TST'
                ]);
                break;

            case 'settings':
                $bean->import([
                    'key' => 'debug_mode',
                    'value' => '0'
                ]);
                break;
        }

        // Store test data to create table structure
        R::store($bean);

        // Clean up test data (except admin user)
        if ($table !== 'user') {
            R::trash($bean);
        }

        // Verify table exists
        if (!R::inspect($table)) {
            throw new \Exception("Failed to create table: $table");
        }
        error_log("Successfully initialized table: $table");
    }

    error_log('All tables initialized successfully');
} catch (\Exception $e) {
    error_log('Database initialization failed: ' . $e->getMessage());
    throw $e;
} finally {
    ob_end_clean();
}

// Initialize core components
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Setup Twig environment
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$GLOBALS['twig'] = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/cache',
    'debug' => !getenv('APP_ENV') || getenv('APP_ENV') !== 'production'
]);

// Set timezone to UTC-6 (Chicago)
date_default_timezone_set('America/Chicago');

// Read debug mode from settings table with environment variable fallback
$debugSetting = R::findOne('settings', ' `key` = ? ', ['debug_mode']);
$debugMode = ($debugSetting && $debugSetting->value === '1') || getenv('PLE_DEBUG') === 'true';

// Add global variables to Twig
$user = $_SESSION['user'] ?? null;
$GLOBALS['twig']->addGlobal('user', $user);
$GLOBALS['twig']->addGlobal('currentTime', date('g:i A T'));
$GLOBALS['twig']->addGlobal('debugMode', $debugMode);
$GLOBALS['twig']->addGlobal('isAdmin', ($user['role'] ?? '') === 'admin');

// Store debug mode in global scope for router access
$GLOBALS['PLE_DEBUG'] = $debugMode;
