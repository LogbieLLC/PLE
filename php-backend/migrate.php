<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';

use RedBeanPHP\R;

function normalizeId($pleId) {
    return strtoupper(trim($pleId));
}

function migrateData($jsonFile) {
    if (!file_exists($jsonFile)) {
        throw new \Exception("JSON file not found: $jsonFile");
    }

    $data = json_decode(file_get_contents($jsonFile), true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        throw new \Exception("Invalid JSON data: " . json_last_error_msg());
    }

    // Start transaction
    R::begin();
    
    try {
        // Migrate equipment
        if (isset($data['equipment'])) {
            foreach ($data['equipment'] as $eq) {
                $equipment = R::dispense('equipment');
                $equipment->pleId = $eq['pleId'];
                $equipment->pleIdNormalized = normalizeId($eq['pleId']);
                $equipment->type = $eq['type'];
                $equipment->make = $eq['make'];
                $equipment->model = $eq['model'];
                $equipment->serialNumber = $eq['serialNumber'];
                $equipment->department = $eq['department'];
                
                R::store($equipment);
                echo "Migrated equipment: {$eq['pleId']}\n";
            }
        }

        // Migrate checklists
        if (isset($data['checklists'])) {
            foreach ($data['checklists'] as $check) {
                $checklist = R::dispense('checklist');
                $checklist->pleId = $check['pleId'];
                $checklist->dateInspected = $check['dateInspected'];
                $checklist->timeInspected = $check['timeInspected'];
                $checklist->inspectorInitials = $check['inspectorInitials'];
                
                // Boolean fields
                $checklist->damage = (bool)($check['damage'] ?? false);
                $checklist->leaks = (bool)($check['leaks'] ?? false);
                $checklist->safetyDevices = (bool)($check['safetyDevices'] ?? false);
                $checklist->operation = (bool)($check['operation'] ?? false);
                $checklist->repairRequired = (bool)($check['repairRequired'] ?? false);
                $checklist->taggedOutOfService = (bool)($check['taggedOutOfService'] ?? false);
                
                // Optional fields
                $checklist->workOrderNumber = $check['workOrderNumber'] ?? '';
                $checklist->comments = $check['comments'] ?? '';
                
                R::store($checklist);
                echo "Migrated checklist: {$check['pleId']} on {$check['dateInspected']}\n";
            }
        }

        // Commit transaction
        R::commit();
        echo "\nMigration completed successfully!\n";
        
        // Verify counts
        $equipmentCount = R::count('equipment');
        $checklistCount = R::count('checklist');
        echo "\nVerification:\n";
        echo "Equipment items: $equipmentCount\n";
        echo "Checklist entries: $checklistCount\n";
        
    } catch (\Exception $e) {
        // Rollback on error
        R::rollback();
        throw new \Exception("Migration failed: " . $e->getMessage());
    }
}

// Usage
if ($argc !== 2) {
    die("Usage: php migrate.php <path_to_json_file>\n");
}

try {
    migrateData($argv[1]);
} catch (\Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
}
