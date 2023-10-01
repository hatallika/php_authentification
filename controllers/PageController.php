<?php

namespace app\controllers;

class PageController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('index');
    }
}