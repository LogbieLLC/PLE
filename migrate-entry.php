<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/migrate.php';

use function PLEPHP\Migration\main;

// Execute migration
main($argv);
