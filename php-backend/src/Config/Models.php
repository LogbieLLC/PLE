<?php

declare(strict_types=1);

namespace PLEPHP\Config;

use RedBeanPHP\R;
use PLEPHP\Model\Equipment;
use PLEPHP\Model\Checklist;
use PLEPHP\Model\InspectionLock;

/**
 * Configure RedBean model extensions
 */
function configureModels(): void
{
    try {
        // Reset database to clean state and allow schema modifications
        R::nuke();
        R::freeze(false);

        error_log('Model configuration completed successfully');
    } catch (\Exception $e) {
        error_log('Model configuration failed: ' . $e->getMessage());
        throw $e;
    }
}
