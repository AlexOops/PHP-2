<?php

namespace app\models;

class feedbacks extends DBModel
{
    protected $id;
    protected $name;
    protected $feedback;
    protected $id_product;

    protected $props = [
        "name" => false,
        "feedback" => false,
        "fid_product" => false,
    ];

    public function __construct($name = null, $feedback = null, $id_product = null)
    {
        $this->name = $name;
        $this->feedback = $feedback;
        $this->id_product = $id_product;
    }

    public static function getTableName()
    {
        return "feedbacks";
    }
}