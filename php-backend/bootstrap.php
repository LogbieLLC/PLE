<?php

declare(strict_types=1);

// Start output buffering at the very beginning
ob_start();

require_once __DIR__ . '/vendor/autoload.php';

// Initialize database
use function PLEPHP\Config\initializeDatabase;
initializeDatabase();

use function PLEPHP\Config\configureModels;

// Clear any initial output
ob_clean();

// Initialize core components
session_start();
configureModels();

// Verify database connection
if (!\RedBeanPHP\R::testConnection()) {
    die('Database connection failed');
}

// Initialize users table if needed
ob_start();
$userCount = \RedBeanPHP\R::count('user');
ob_end_clean();

if (!$userCount) {
    // Create temporary admin user for testing
    // TODO: Remove or change credentials before deploying to production
    $admin = \RedBeanPHP\R::dispense('user');
    $admin->username = 'admin';
    $admin->password = password_hash('admin', PASSWORD_DEFAULT);
    $admin->role = 'admin';
    ob_start();
    \RedBeanPHP\R::store($admin);
    ob_end_clean();
}

// Setup Twig environment
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$GLOBALS['twig'] = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/cache',
    'debug' => !getenv('APP_ENV') || getenv('APP_ENV') !== 'production'
]);

// Add global user data to Twig
$GLOBALS['twig']->addGlobal('user', $_SESSION['user'] ?? null);
