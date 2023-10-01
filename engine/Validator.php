<?php

namespace app\engine;

abstract class Validator
{
    private $errors = [];

    /**
     *
     * Проверяет значения на соответствие условию,
     * если условия нарушаются, помещает в массив $errors
     * сообщение об ошибке
     */
    abstract function validate() : array;



    public function addError($key,$message) {
        $this -> errors[$key] = $message;
    }


    public function getErrors(): array
    {
        return $this -> errors;
    }
}