<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// Configure RedBean model namespace
\RedBeanPHP\R::ext('equipment', function ($bean) {
    $model = new \PLEPHP\Model\Equipment();
    $model->loadBean($bean);
    return $model;
});

\RedBeanPHP\R::ext('checklist', function ($bean) {
    $model = new \PLEPHP\Model\Checklist();
    $model->loadBean($bean);
    return $model;
});

session_start();

// Initialize users table if needed
if (!\RedBeanPHP\R::testConnection()) {
    die('Database connection failed');
}

if (!\RedBeanPHP\R::count('user')) {
    // Create default admin user
    $admin = \RedBeanPHP\R::dispense('user');
    $admin->username = 'admin';
    $admin->password = password_hash('admin', PASSWORD_DEFAULT); // Change in production
    $admin->role = 'admin';
    \RedBeanPHP\R::store($admin);
}

// Setup Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$GLOBALS['twig'] = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/cache',
    'debug' => !getenv('APP_ENV') || getenv('APP_ENV') !== 'production'
]);

// Add global user data to Twig
$GLOBALS['twig']->addGlobal('user', $_SESSION['user'] ?? null);
