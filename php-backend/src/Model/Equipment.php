<?php

/**
 * Equipment Model Class
 *
 * This file contains the Equipment model class for managing powered lifting equipment.
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
 * Equipment Model
 *
 * Represents a piece of powered lifting equipment in the system.
 * Handles storage and retrieval of equipment data using RedBeanPHP.
 *
 * @property int    $id                Primary key
 * @property string $ple_id           Equipment identifier (e.g., R1, E2)
 * @property string $ple_id_normalized Normalized equipment identifier
 * @property string $type             Equipment type (Walkie-stacker, etc.)
 * @property string $make             Equipment manufacturer
 * @property string $model            Equipment model number
 * @property string $serial_number    Equipment serial number
 * @property string $department       Department assignment
 * @property string $status           Current equipment status
 * @property string $last_work_order  Most recent work order number
 * @property string $pleId           Legacy property for ple_id
 * @property string $pleIdNormalized Legacy property for ple_id_normalized
 * @property string $serialNumber    Legacy property for serial_number
 *
 * @category Models
 * @package  PLEPHP\Model
 * @author   Devin AI <devin@logbie.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/LogbieLLC/PLE
 */
class Equipment extends \RedBeanPHP\SimpleModel
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
