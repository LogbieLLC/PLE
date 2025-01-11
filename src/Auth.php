<?php

/**
 * Authentication Module
 *
 * This file contains authentication-related functionality for the PLE system.
 *
 * PHP version 7.4
 *
 * @category  Authentication
 * @package   PLEPHP
 * @author    Devin AI <devin@logbie.com>
 * @copyright 2024 Logbie LLC
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/LogbieLLC/PLE
 */

declare(strict_types=1);

namespace PLEPHP;

/**
 * Authentication middleware to ensure user is logged in
 *
 * @return void
 */
function requireAuth(): void
{
    if (!isset($_SESSION['user'])) {
        header('Location: index.php?action=login');
        exit;
    }
}
