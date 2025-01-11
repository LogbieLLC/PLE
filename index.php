<?php

declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';
require_once __DIR__ . '/src/Web/Router.php';

use function PLEPHP\Web\handleRoute;

// Only execute if running as a script
if (php_sapi_name() !== 'cli') {
    handleRoute();
}
