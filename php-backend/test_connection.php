<?php

declare(strict_types=1);

// Ensure no output before session_start
ob_start();

// Include required files in correct order
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/src/Config/Models.php';
require_once __DIR__ . '/config.php';

try {
    // Test database connection
    if (\RedBeanPHP\R::testConnection()) {
        echo "Database connection successful!\n";
        echo "Testing model configuration...\n";

        // Test equipment model
        $equipment = \RedBeanPHP\R::dispense('equipment');
        echo "Equipment model OK\n";

        // Test checklist model
        $checklist = \RedBeanPHP\R::dispense('checklist');
        echo "Checklist model OK\n";

        echo "\nAll tests passed successfully!\n";
    } else {
        echo "Database connection failed!\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
