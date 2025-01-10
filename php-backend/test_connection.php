<?php

declare(strict_types=1);

// Ensure no output before session_start
ob_start();

// Include required files in correct order
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/bootstrap.php';

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

        // Test inspection lock model
        $lock = \RedBeanPHP\R::dispense('inspection_lock');
        if (!$lock) {
            throw new \Exception("Failed to create inspection_lock model");
        }
        echo "Inspection lock model OK\n";
        
        // Test model properties
        $lock->ple_id = 'TEST1';
        $lock->inspector_id = 1;
        $lock->created = date('Y-m-d H:i:s');
        $lock->force_taken_by = null;
        $lock->force_taken_at = null;
        \RedBeanPHP\R::store($lock);
        echo "Lock properties test OK\n";
        \RedBeanPHP\R::trash($lock);
        
        echo "\nAll tests passed successfully!\n";
    } else {
        echo "Database connection failed!\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
