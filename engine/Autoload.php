<?php

namespace app\engine;
class Autoload
{

    public function loadClass($className)
    {
        //класс автозагрузки, подгружает файлы ориентируясь на namespace и имя класса.
        $filename = str_replace(['app\\', '\\'], [ROOT . DS, DS], $className) . ".php";

        if (file_exists($filename)) {
            include $filename;
        }


    }
}