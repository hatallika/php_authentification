<?php

namespace app\controllers;

use app\engine\EditUserValidator;
use app\engine\Message;
use app\models\Users;

class UserController extends Controller
{
    //render index страницы
    public function actionIndex()
    {
        echo $this->render('index');
    }

    //рендер блока с формой авторизации с передачей параметров
    public function actionLogin()
    {
        echo $this->render('auth/auth', [
            'auth' => Users::isAuth(),
            'username' => Users::get_user(),
            'message_auth' => Message::getMessageAuth()
        ]);
    }

    //Рендер блока с формой регистрации
    public function actionRegister()
    {
        if (Users::isAuth()) {
            header("Location: /");
        }

        $oldLogin = $this->select_value('register', 'login');
        $oldEmail = $this->select_value('register', 'email');
        $oldPhone = $this->select_value('register', 'phone');

        echo $this->render('auth/registration', [
            'oldLogin' => $oldLogin,
            'oldEmail' => $oldEmail,
            'oldPhone' => $oldPhone,
        ]);
    }


    //страница профиля пользователя
    public function actionProfile()
    {
        if (Users::isAuth()) {
            $user = Users::getOne(Users::getAuthId());
            echo $this->render('profile', [
                'user' => $user,
            ]);
        } else {
            header("Location: /");
            die();
        }
    }

    //регистрация пользователя после проверки входных данных.
    // Не успела разделить по принципу единой ответственности
    //в авторизациии для этого работает класс валидации
    public function actionCreate()
    {
        //сделать обработку полей
        $login = $_POST['login'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        //Сохраним заполненые поля в сессии
        $this->insert_value('register', 'login');
        $this->insert_value('register', 'email');
        $this->insert_value('register', 'phone');

        $pass = $_POST['password'];
        $confPass = $_POST['password_confirmation'];

        // проверяем совпадение паролей
        $checkPass = $this->checkPassword($pass, $confPass);
        // проверяем логин на уникальность
        $checkUserData = $this->checkUserExist($login, $email, $phone);

        if ($checkPass && $checkUserData) {
            //очистим данные пользователя при успешном заполнении формы
            $this->delete_value('register', 'login');
            $this->delete_value('register', 'email');
            $this->delete_value('register', 'phone');

            //создаем пользователя
            $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $hash = uniqid(rand(), true);
            $newUser = new Users($login, $email, $phone, $pass, $hash);
            $user = $newUser->save();

            // если пользователь создан запишем в сессию
            if ($user) {
                $_SESSION['id'] = $user->id;
                $_SESSION['login'] = $user->login;
                setcookie("hash", $hash, time() + 36000, '/');
                header("Location: /user/profile/");
                die();
            } else {
                var_dump('Не удалось создать пользователя');
            }

        } else {
            //перегружаем страницу
            header("Location: " . $_SERVER['HTTP_REFERER']);
            die();
        }
    }

    //изменить данные профиля
    public function actionEdit()
    {
        //класс валидации для формы изменения данных пользователя
        $validator  = new EditUserValidator($this->getGlobalParams());

        $id = $_SESSION['id'];
        $user = Users::getOne($id);
        //получим ошибки валидации
        $errors = $validator->validate();

        //перерендер страницы профиля с параметрами ошибок
        if($errors){
            echo $this->render('profile', [
                'user'=>$user,
                'errors'=>$errors
                ]);
        } else {
            //обновим разрешенные данные пользователя
            foreach ($this->getGlobalParams() as $key => $value) {
                if ($key == 'login' || $key == 'email' || $key == 'phone'|| $key=='password') {
                    //Редактируем  данные пользователя
                    unset($_SESSION['edit_err']);
                    $user = Users::getOne($id);
                    $user->$key = $value;
                    $updateUser = $user->save();
                    if ($updateUser) {
                        if ($key == 'login') $_SESSION['login'] = $user->login;
                        header("Location: /user/profile/");
                        die();
                    }
                }
            }
        }
    }

    //здесь прямая валидация для формы регистрации, еще без использования класса валидатора
    // так как в регистрации пользуемся ссесией для сохранения полей и ошибок.
    private function checkPassword($pass, $confPass): bool
    {
        if ($pass != $confPass) {
            $_SESSION['register_err']['password'] = "Пароли не совпадяют";
            return false;
        }
        unset($_SESSION['register_err']['password']);
        return true;
    }


    // cохранение вводимых полей в форму в сессию в случае обновления страницы
    function insert_value($key, $name)
    {
        if (isset($_POST[$name])) {
            if (!empty($_POST[$name])) {
                $_SESSION[$key . $name] = $_POST[$name];
            }
        }
    }

    // очистка сессии
    function delete_value($key, $name)
    {
        if (isset($_SESSION[$key . $name])) unset($_SESSION[$key . $name]);
    }

    // безопасное представление value поля
    function select_value($key, $name)
    {
        if (isset($_SESSION[$key . $name])) return htmlspecialchars($_SESSION[$key . $name]);
    }

    //проверка на существование пользователя с такими данными
    public function checkUserExist($login, $email, $phone): bool
    {
        //проверяем есть ли такой пользователь в БД
        $user = Users::getOneWhereOr([
            'login' => $login,
            'email' => $email,
            'phone' => $phone
        ]);
        //если пользователь уже существует проверяем по каким данным совпадение

        if ($user) {

            if ($user->login === $login) {
                $_SESSION['register_err']['user']['login'] = "Такой пользователь существует";
            } else {
                unset($_SESSION['register_err']['user']['login']);
            }
            if ($user->email === $email) {
                $_SESSION['register_err']['user']['email'] = "Такая почта занята";
            } else {
                unset($_SESSION['register_err']['user']['email']);
            }
            if ($user->phone === $phone) {
                $_SESSION['register_err']['user']['phone'] = "Такой номер телефона занят";
            } else {
                unset($_SESSION['register_err']['user']['phone']);
            }

            return false;
        }
        unset($_SESSION['register_err']['user']);
        return true;
    }


}