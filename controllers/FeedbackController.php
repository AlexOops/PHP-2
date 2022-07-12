<?php

namespace app\controllers;

use app\models\Feedbacks;

class FeedbackController extends Controller
{
    public function actionIndex()
    {
        $feedbacks = Feedbacks::getAll();
        echo $this->render('feedback', [
            'feedbacks' => $feedbacks,
        ]);
    }
}