<?php

namespace app\engine;

use app\interfaces\IRender;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class TwigRender implements IRender
{
//    public $twig;
//
//    public function __construct(\Twig\Environment $twig)
//    {
//        $this->twig = $twig;
//    }

    function renderTemplate($template, $params = [])
    {
        $loader = new \Twig\Loader\FilesystemLoader('../templates');
        $twig = new \Twig\Environment($loader);
        return $twig->render($template . ".twig", $params);
    }
}