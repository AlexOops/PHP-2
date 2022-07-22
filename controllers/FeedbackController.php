<?php

namespace app\controllers;

use app\models\repositories\FeedbacksRepository;

class FeedbackController extends Controller
{
    public function actionIndex()
    {
        $feedbacks = (new FeedbacksRepository())->getAll();
        echo $this->render('feedback', [
            'feedbacks' => $feedbacks,
        ]);
    }
}