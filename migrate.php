<?php

declare(strict_types=1);

namespace PLEPHP\Migration;

require_once __DIR__ . '/bootstrap.php';

use function PLEPHP\migrateData;

/**
 * Main migration script entry point
 *
 * @param array<int,string> $argv Command line arguments
 */
function main(array $argv): void
{
    if (count($argv) !== 2) {
        die("Usage: php migrate.php <path_to_json_file>\n");
    }

    try {
        migrateData($argv[1]);
    } catch (\Exception $e) {
        die("Error: " . $e->getMessage() . "\n");
    }
}
