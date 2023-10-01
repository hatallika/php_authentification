<?php

namespace app\engine;

use app\interfaces\IRender;

class Render implements IRender
{
    public function renderTemplate($template, $params = [])
    {
        ob_start(); //соберем в буфер html вывод
        extract($params);
        $templatePath = VIEWS_DIR . $template . ".php";
        include $templatePath;
        return ob_get_clean(); //вернем в нужный момент
    }
}