<?php

namespace app\models\entities;
use app\models\Entity;

class Orders extends Entity
{
    protected $id;
    protected $name;
    protected $phone;
    protected $id_session;

    protected $props = [
        "name" => false,
        "phone" => false,
        "id_session" => false,
    ];
}