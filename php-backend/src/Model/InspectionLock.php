<?php

declare(strict_types=1);

namespace PLEPHP\Model;

/**
 * @property int $id
 * @property string $ple_id
 * @property int $inspector_id
 * @property string $created
 * @property int|null $force_taken_by
 * @property string|null $force_taken_at
 */
class InspectionLock extends \RedBeanPHP\SimpleModel
{
    // Inherits all functionality from SimpleModel
    // Properties documented above for IDE support and type checking
}
