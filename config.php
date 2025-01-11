<?php

declare(strict_types=1);

namespace PLEPHP\Config;

use RedBeanPHP\Logger;

/**
 * Null logger implementation to suppress query output
 */
class NullLogger implements Logger
{
    public function log(): void
    {
        // Do nothing
    }
}
