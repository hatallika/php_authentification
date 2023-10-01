<?php
session_start();
use app\engine\Autoload;
use app\engine\Render;
use app\engine\Request;
use app\engine\TwigRender;
use app\models\{Products, Users};
use app\engine\Db;

include "../config/config.php";
include "../engine/Autoload.php";

//атозагрузчики
spl_autoload_register([new Autoload(), 'loadClass']);


//Используем модель MVC для решения задачи
// Controller
//ЧПУ разберем запрос пользователя для получения контроллера и actions
$request = new Request();
$controllerName = $request->getControllerName() ?: 'user';
$actionName = $request->getActionName();

//контроллеры будут инкапсулированы в классы c nameController
$controllerClass = CONTROLLER_NAMESPACE . ucfirst($controllerName) . "Controller";


if (class_exists($controllerClass)) {
// Укажем шаблонизатор при создании контроллера. Можно будет поменять на другой (например Twig)
    $controller = new $controllerClass(new Render());
    $controller->runAction($actionName);
} else {
    Die("404");
}


//Работа с базой данных по патерну ActiveRecord

//Для каждой таблицы с данными создадим класс модели, где объект будет управлять каждой записью таблицы.
// Организуем CRUD операции для получения данных пользователя, создания редактирования через объект модели.
// Для работы с запросами к БД будем использовать PDO (для их валидации, удобного извлечения)

//$user = new Users("username", "+74576769900", "123456");
//$user->save;
//$product = Products::getOne(8);
//$product->delete();

