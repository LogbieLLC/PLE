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
class Equipment implements \RedBeanPHP\Model
{
    private \RedBeanPHP\OODBBean $bean;

    public function loadBean(\RedBeanPHP\OODBBean $bean)
    {
        $this->bean = $bean;
    }

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
