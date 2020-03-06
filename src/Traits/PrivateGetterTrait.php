<?php

namespace Itigoppo\BacklogApi\Traits;

trait PrivateGetterTrait
{
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        throw new \OutOfRangeException('Unexpected key:"' . $name . '"');
    }

    public function __isset($name)
    {
        return isset($this->$name);
    }
}
