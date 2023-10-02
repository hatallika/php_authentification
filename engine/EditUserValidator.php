<?php

namespace app\engine;

use app\models\Users;

class EditUserValidator extends Validator
{

    private array $request = [];

    public function __construct(array $request) {
        $this -> request = $request;
    }

    function validate(): array
    {
        $req = $this -> request;
        if( $req["login"] )
            if (Users::getOneWhere('login', $req["login"])){
                $this -> addError('login','Пользователь с таким именем уже существует');
            }

        if( $req["phone"] )
            if (Users::getOneWhere('phone', $req["phone"])){
                $this -> addError('login','Пользователь с таким номером уже существует');
            }

        if( $req["email"] )
            if (Users::getOneWhere('email', $req["email"])){
                $this -> addError('email','Пользователь с такой почтой уже существует');
            }

        if ($req['password'] !== $req['password_confirmation']){
            $this -> addError('password','Пароли не совпадают');
        }


        return $this->getErrors();
    }
}