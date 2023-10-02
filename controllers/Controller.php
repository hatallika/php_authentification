<?php

namespace app\controllers;

use app\engine\Message;
use app\engine\Render;
use app\engine\Request;
use app\interfaces\IRender;
use app\models\Basket;
use app\models\Users;
use http\Client\Curl\User;

class Controller
{
    private string $action;
    private string $defaultAction = 'index';
    private string $layout = 'main';
    private bool $useLayout = true;
    protected IRender $render;
    protected Request $globalParams;


    public function __construct(IRender $render)
    {
        $this->render = $render;
        $this->globalParams = new Request();
    }

    public function runAction($action)
    {
        $this->action = $action ?? $this->defaultAction;
        $method = "action" . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        }
    }

    //главный рендер - собирает всю страницу
    public function render($template, $params = [])
    {
        if ($this->useLayout) {

            return $this->renderTemplate('layouts/' . $this->layout, [
                'menu' => $this->renderTemplate('menu', [
                    'isAuth' => Users::isAuth(),
                    'username' => Users::get_user(),
                ]),
                'content' => $this->renderTemplate($template, $params),
                'isAuth' => Users::isAuth(),
                'username' => Users::get_user(),
            ]);
        } else {
            return $this->renderTemplate($template, $params);
        }

    }

    //расширили класс для функционала внешнего рендера
    public function renderTemplate($template, $params = []){
        return $this->render->renderTemplate($template, $params);
    }

    protected function getGlobalParams(): array
    {
        return $this->globalParams->getParams();
    }

}