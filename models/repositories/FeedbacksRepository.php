<?php

namespace app\models\repositories;

use app\models\entities\Feedbacks;
use app\models\Repository;

class FeedbacksRepository extends Repository
{
    protected function getEntityClass()
    {
        return Feedbacks::class;
    }

    protected function getTableName()
    {
        return "feedbacks";
    }
}