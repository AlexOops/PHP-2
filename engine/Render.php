<?php

namespace app\engine;

use app\config\Config;
use app\interfaces\IRender;

class Render implements IRender
{
    public function renderTemplate($template, $params = [])// ($шабон, $значение переменных для подстановки)
    {
        ob_start(); // вкл буфер
        extract($params);
        $templatePath = Config::VIEWS_DIR . $template . ".php"; //собирается имя
        include $templatePath;
        return ob_get_clean(); // возвращает весь HTML и очищает
    }
}

