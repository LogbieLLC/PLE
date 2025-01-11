<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

use RedBeanPHP\R;
use function PLEPHP\Config\initializeDatabase;
use function PLEPHP\Config\configureModels;

// Initialize error reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');

try {
    echo "Step 1: Initialize database connection\n";
    initializeDatabase();

    echo "Step 2: Verify database connection\n";
    if (!R::testConnection()) {
        throw new \Exception('Database connection failed');
    }
    echo "Database connection successful\n";

    echo "Step 3: Configure models\n";
    configureModels();
    echo "Models configured\n";

    echo "Step 4: Test inspection_lock CRUD operations\n";

    // Create test inspection lock
    $lock = R::dispense('inspectionlock');
    $lock->ple_id = 'TEST1';
    $lock->inspector_id = 1;
    $lock->created = date('Y-m-d H:i:s');

    echo "Attempting to store inspection lock...\n";
    $id = R::store($lock);
    echo "Stored inspection lock with ID: $id\n";

    // Retrieve the lock
    echo "Attempting to retrieve inspection lock...\n";
    $retrieved = R::load('inspection_lock', $id);
    echo "Retrieved lock data:\n";
    print_r($retrieved->export());

    // Update the lock
    echo "\nAttempting to update inspection lock...\n";
    $retrieved->force_taken_by = 2;
    $retrieved->force_taken_at = date('Y-m-d H:i:s');
    R::store($retrieved);
    echo "Updated inspection lock\n";

    // Delete the lock
    echo "Attempting to delete inspection lock...\n";
    R::trash($retrieved);
    echo "Deleted inspection lock\n";

    echo "\nAll database operations completed successfully!\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
    exit(1);
}
