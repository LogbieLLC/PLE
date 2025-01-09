<?php

declare(strict_types=1);

namespace PLEPHP\Model;

/**
 * @property int $id
 * @property string $ple_id
 * @property string $date_inspected
 * @property string $time_inspected
 * @property string $inspector_initials
 * @property bool $damage
 * @property bool $leaks
 * @property bool $safety_devices
 * @property bool $operation
 * @property bool $repair_required
 * @property bool $tagged_out_of_service
 * @property string $work_order_number
 * @property string $comments
 * @property string $pleId
 * @property string $dateInspected
 * @property string $timeInspected
 * @property string $inspectorInitials
 * @property bool $safetyDevices
 * @property bool $repairRequired
 * @property bool $taggedOutOfService
 * @property string $workOrderNumber
 */
class Checklist extends \RedBeanPHP\SimpleModel
{
    /**
     * @param string $property
     * @return mixed
     */
    public function __get(string $property)
    {
        return $this->bean->$property;
    }

    /**
     * @param string $property
     * @param mixed $value
     * @return void
     */
    public function __set(string $property, $value): void
    {
        $this->bean->$property = $value;
    }
}
