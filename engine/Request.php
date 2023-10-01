<?php

namespace app\engine;

class Request
//Класс обработки данных из запроса пользователя
{
    protected $requestString;
    protected $controllerName;
    protected $actionName;

    protected $method;
    protected $params = [];


    public function __construct()
    {
        //получим пользовательский запрос
        $this->parseRequest();
    }

    protected function parseRequest(){
        //строка запроса от пользователя
        $this->requestString = $_SERVER['REQUEST_URI'];
        $this->method = $_SERVER['REQUEST_METHOD']; //POST//GET ...

        $url = explode('/', $this->requestString);
        $this->controllerName = $url[1];
        $this->actionName = $url[2];
        $this->params = $_REQUEST;
    }

    /**
     * @return mixed
     */
    public function getControllerName()
    {
        return $this->controllerName;
    }

    /**
     * @return mixed
     */
    public function getActionName()
    {
        return $this->actionName;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }


}