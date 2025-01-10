<?php

declare(strict_types=1);

require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../index.php';

use function PLEPHP\Web\handleRoute;

// Execute routing
handleRoute();
