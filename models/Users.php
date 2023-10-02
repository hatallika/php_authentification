<?php

namespace app\models;

use app\engine\Db;
use http\Client\Curl\User;

class Users extends DBModel
{
    //Таблица пользователей. Один объект - одна запись таблицы

    protected $id;
    protected ?string $login;
    protected ?string $phone;
    protected ?string $email;
    protected ?string $pass;
    protected ?string $hash;


    protected $props = [
        'login' => false,
        'phone' => false,
        'email' => false,
        'pass' => false,
        'hash' => false,
    ];


    public function __construct(?string $login = null, ?string $email = null, ?string $phone = null, ?string $pass = null, $hash = null)
    {
        $this->login = $login;
        $this->email = $login;
        $this->phone = $phone;
        $this->pass = $pass;
        $this->hash = $hash;
    }


    public static function getTableName(): string
    {
        return 'users';
    }

    //проверка авторизован ли посетитель
    public static function isAuth(): bool
    {

        if (isset($_COOKIE['hash']) && !($_SESSION['login'])){
            $hash = $_COOKIE['hash'];

            // найдем пользователя по хешу из кук
            $row = Users::getOneWhere('hash', $hash);

            if($row){
                $user = $row->login;
                if(!empty($user)){
                    $_SESSION['login'] = $user;
                    $_SESSION['id'] = $row->id;
                }
            }
        }
        return isset($_SESSION['login']);
    }


    //проверка логина и пароля
    public static function auth($login, $pass): bool
    {
//        $passDB = Users::getOneWhere('login', $login);
        $passDB = Users::getOneWhereOr([
            'login' => $login,
            'email' => $login,
            'phone' => $login
        ]);
        var_dump($passDB);
        //password_hash('123', PASSWORD_DEFAULT);
        if (password_verify($pass, $passDB->pass)) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $passDB->id;
            return true;
        }
        return false;
    }

    public static function updateHash()
    {
        $hash = uniqid(rand(), true);
        $id = (int)$_SESSION['id'];
        $user = Users::getOne($id);
        $user->hash = $hash;
        $user->props['hash'] = true; //разрешили изменение
        $user->save();
        setcookie("hash", $hash, time() + 36000, '/');
    }

    public static function get_user() {
        return $_SESSION['login'];
    }
    public static function getName() {
        return $_SESSION['username'];
    }

    public static function getAuthId() {
        return $_SESSION['id'];
    }
    public static function isAdmin(): bool
    {
        return $_SESSION['login'] == 'admin';
    }




}