<?php

namespace app\controllers;

use app\models\Users;

class AuthController extends Controller
{
    public function actionLogin(){
        //form action='/auth/login/'
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        $token = $_POST['smart-token'];

        //Проверка каптчи
        if (!$this->check_captcha($token)) {
            $_SESSION['message']['login'] = "Вы не прошли проверку. Подтвердите что вы не робот";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            die();
        }

        if(Users::auth($login, $pass)){
            if(isset($_POST['save'])){
                Users::updateHash();
            }
            unset($_SESSION['message']['login']);
            header("Location: /user/profile  ");
            die();
        } else {
            $_SESSION['message']['login'] = "Не верный логин или пароль";
            header("Location: ". $_SERVER['HTTP_REFERER']);
            die();
        }


    }

    public function actionLogout(){
        setcookie("hash", '', time() - 3600, '/');
        session_regenerate_id();
        session_destroy();
        header("Location: /");
        die();
    }

    private function check_captcha($token): bool
    {
        $ch = curl_init();
        $args = http_build_query([
            "secret" => SMARTCAPTCHA_SERVER_KEY,
            "token" => $token,
            "ip" => $_SERVER['REMOTE_ADDR'], // Нужно передать IP-адрес пользователя.
            // Способ получения IP-адреса пользователя зависит от вашего прокси.
        ]);
        curl_setopt($ch, CURLOPT_URL, "https://smartcaptcha.yandexcloud.net/validate?$args");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);

        $server_output = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpcode !== 200) {
            echo "Allow access due to an error: code=$httpcode; message=$server_output\n";
            return true;
        }
        $resp = json_decode($server_output);
        return $resp->status === "ok";
    }
}