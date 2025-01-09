<?php

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
