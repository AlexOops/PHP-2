<?php

namespace app\controllers;

class AboutController extends Controller
{
    protected $defaultAction = "about";

    public function actionAbout()
    {
        echo $this->render('about');
    }
}