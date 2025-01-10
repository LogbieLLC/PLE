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
class InspectionLock implements \RedBeanPHP\Model
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
