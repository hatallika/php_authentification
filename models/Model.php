<?php

namespace app\models;

use app\engine\Db;
use app\interfaces\IModel;

abstract class Model implements IModel
{

    protected $id;

 // магические методы
    public function __set($name, $value)
    {
        $this->$name = $value;
        $this->props[$name] = true;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function __isset($name)
    {
        // TODO: Implement __isset() method.
        return isset($this->name);
    }


}