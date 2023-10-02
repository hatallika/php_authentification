<?php

namespace app\interfaces;

interface IRender
{
    //для возможности создавать разные рендеры шаблонизаторы
    public function renderTemplate($template, $params=[]);
}