<?php

declare(strict_types=1);

namespace PLEPHP\Config;

use RedBeanPHP\R;
use PLEPHP\Model\Equipment;
use PLEPHP\Model\Checklist;
use PLEPHP\Model\InspectionLock;
use PLEPHP\Model\Settings;

/**
 * Configure RedBean model extensions
 */
function configureModels(): void
{
    try {
        // Register model extensions
        R::ext('equipment', function ($bean) {
            $model = new Equipment();
            $model->loadBean($bean);
            return $model;
        });

        R::ext('checklist', function ($bean) {
            $model = new Checklist();
            $model->loadBean($bean);
            return $model;
        });

        R::ext('inspection_lock', function ($bean) {
            $model = new InspectionLock();
            $model->loadBean($bean);
            return $model;
        });

        R::ext('settings', function ($bean) {
            $model = new Settings();
            $model->loadBean($bean);
            return $model;
        });

        error_log('Model configuration completed successfully');
    } catch (\Exception $e) {
        error_log('Model configuration failed: ' . $e->getMessage());
        throw $e;
    }
}
