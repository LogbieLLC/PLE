<?php

/**
 * Checklist Model Class
 *
 * This file contains the Checklist model class for managing equipment inspections.
 *
 * PHP version 7.4
 *
 * @category  Models
 * @package   PLEPHP\Model
 * @author    Devin AI <devin@logbie.com>
 * @copyright 2024 Logbie LLC
 * @license   https://opensource.org/licenses/MIT MIT License
 * @link      https://github.com/LogbieLLC/PLE
 */

declare(strict_types=1);

namespace PLEPHP\Model;

/**
 * Checklist Model
 *
 * Represents an equipment inspection checklist in the system.
 * Handles storage and retrieval of inspection data using RedBeanPHP.
 *
 * @property int    $id                  Primary key
 * @property string $ple_id             Equipment identifier
 * @property string $date_inspected     Date of inspection
 * @property string $time_inspected     Time of inspection
 * @property string $inspector_initials Inspector's initials
 * @property bool   $damage             Damage found flag
 * @property bool   $leaks              Leaks present flag
 * @property bool   $safety_devices     Safety device issues flag
 * @property bool   $operation          Operational issues flag
 * @property bool   $repair_required    Repair needed flag
 * @property bool   $tagged_out_of_service Out of service flag
 * @property string $work_order_number  Work order reference
 * @property string $comments           Inspection comments
 * @property string $pleId             Legacy property for ple_id
 * @property string $dateInspected     Legacy property for date_inspected
 * @property string $timeInspected     Legacy property for time_inspected
 * @property string $inspectorInitials Legacy property for inspector_initials
 * @property bool   $safetyDevices     Legacy property for safety_devices
 * @property bool   $repairRequired    Legacy property for repair_required
 * @property bool   $taggedOutOfService Legacy property for tagged_out_of_service
 * @property string $workOrderNumber   Legacy property for work_order_number
 *
 * @category Models
 * @package  PLEPHP\Model
 * @author   Devin AI <devin@logbie.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/LogbieLLC/PLE
 */
class Checklist extends \RedBeanPHP\SimpleModel
{
    /**
     * Get a property value from the underlying bean
     *
     * @param  mixed $prop Property name to retrieve
     * @return mixed Property value
     */
    public function __get($prop)
    {
        return $this->bean->$prop;
    }

    /**
     * Set a property value on the underlying bean
     *
     * @param  mixed $prop  Property name to set
     * @param  mixed $value Value to set
     * @return void
     */
    public function __set($prop, $value): void
    {
        $this->bean->$prop = $value;
    }
}
