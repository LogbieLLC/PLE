<?php

declare(strict_types=1);

namespace PLEPHP\Model;

/**
 * @property int $id
 * @property string $ple_id
 * @property string $ple_id_normalized
 * @property string $type
 * @property string $make
 * @property string $model
 * @property string $serial_number
 * @property string $department
 * @property string $status
 * @property string $last_work_order
 * @property string $pleId
 * @property string $pleIdNormalized
 * @property string $serialNumber
 */
class Equipment extends \RedBeanPHP\SimpleModel
{
    /**
     * @param  mixed $prop
     * @return mixed
     */
    public function __get($prop)
    {
        return $this->bean->$prop;
    }

    /**
     * @param  mixed $prop
     * @param  mixed $value
     * @return void
     */
    public function __set($prop, $value): void
    {
        $this->bean->$prop = $value;
    }
}
