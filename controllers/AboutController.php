<?php

namespace app\controllers;

class AboutController extends Controller
{
    public function actionIndex()
    {
        echo $this->render('about');
    }
}