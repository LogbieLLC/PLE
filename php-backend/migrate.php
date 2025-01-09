<?php

declare(strict_types=1);

use function PLEPHP\migrateData;

require_once __DIR__ . '/bootstrap.php';

// Usage
if ($argc !== 2) {
    die("Usage: php migrate.php <path_to_json_file>\n");
}

try {
    migrateData($argv[1]);
} catch (\Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
}
