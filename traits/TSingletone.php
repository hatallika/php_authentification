<?php

namespace app\traits;
use app\engine\Db;

trait TSingletone
{
    private static $instance = null;

    public static function getInstance(): self
    {
        if (is_null(static::$instance)) {
            static::$instance = new static(); // new Db()
        }
        return static::$instance;
    }

    private function __construct() {}
    private function __clone() {}
    private function __wakeup() {}

}