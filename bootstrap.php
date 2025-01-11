<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

// Import required dependencies
use RedBeanPHP\R;
use function PLEPHP\Config\initializeDatabase;
use function PLEPHP\Config\configureModels;

// Clean any existing output buffers
try {
    while (ob_get_level() !== 0) {
        if (!@ob_end_clean()) {
            throw new \RuntimeException('Failed to clean output buffer');
        }
    }
    // Start fresh output buffer
    if (!@ob_start()) {
        throw new \RuntimeException('Failed to start output buffer');
    }
} catch (\Exception $bufferException) {
    error_log('Buffer cleanup failed: ' . $bufferException->getMessage());
    // Ensure clean state
    while (ob_get_level() !== 0) {
        @ob_end_clean();
    }
}

// Initialize database with output buffering
ob_start();

try {
    // Initialize database connection first
    initializeDatabase();

    // Verify database connection before proceeding
    if (!R::testConnection()) {
        throw new \Exception('Database connection failed');
    }

    // Configure models after database is ready
    configureModels();

    // Initialize core tables
    if (!R::count('user')) {
        // Create temporary admin user for testing
        $admin = R::dispense('user');
        $admin->username = 'admin';
        $admin->password = password_hash('admin', PASSWORD_DEFAULT);
        $admin->role = 'admin';
        R::store($admin);
    }

    // Verify all required tables exist
    foreach (['user', 'equipment', 'checklist', 'inspection_lock'] as $table) {
        if (!R::inspect($table)) {
            throw new \Exception("Required table '$table' does not exist");
        }
    }
    error_log('All required tables verified');
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
