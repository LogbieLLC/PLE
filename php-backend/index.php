<?php

/**
 * Application Entry Point
 *
 * This file serves as the main entry point for the PLE system.
 *
 * PHP version 7.4
 *
 * @category  Application
 * @package   PLEPHP\Web
 * @author    Devin AI <devin@logbie.com>
 * @copyright 2024 Logbie LLC
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/LogbieLLC/PLE
 */

declare(strict_types=1);

namespace PLEPHP\Web;

use function PLEPHP\Web\handleRoute;

require_once __DIR__ . '/bootstrap.php';

// Execute routing
handleRoute();
