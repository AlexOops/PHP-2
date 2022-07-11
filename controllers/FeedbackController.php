<?php

namespace app\controllers;

use app\models\Feedbacks;

class FeedbackController extends Controller
{
    protected $defaultAction = "feedback";

    public function actionFeedback()
    {
        $feedbacks = Feedbacks::getAll();
        echo $this->render('feedback', [
            'feedbacks' => $feedbacks,
        ]);
    }
}