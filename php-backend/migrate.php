<?php

declare(strict_types=1);

use function PLEPHP\migrateData;

// Usage
if ($argc !== 2) {
    die("Usage: php migrate.php <path_to_json_file>\n");
}

require_once __DIR__ . '/bootstrap.php';

try {
    migrateData($argv[1]);
} catch (\Exception $e) {
    die("Error: " . $e->getMessage() . "\n");
}
