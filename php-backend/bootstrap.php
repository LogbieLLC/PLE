<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

// Register model classes with RedBean
\RedBeanPHP\R::ext('equipment', function ($bean) {
    return new \PLEPHP\Model\Equipment($bean);
});

\RedBeanPHP\R::ext('checklist', function ($bean) {
    return new \PLEPHP\Model\Checklist($bean);
});

session_start();

// Setup Twig
$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/cache',
    'debug' => !getenv('APP_ENV') || getenv('APP_ENV') !== 'production'
]);

// Add global user data to Twig
$twig->addGlobal('user', $_SESSION['user'] ?? null);
