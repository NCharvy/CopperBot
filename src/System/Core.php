<?php
namespace CopperBot\System;

use CopperBot\System\Router\Interpret; 

class Core {
    private $router;

    public function __construct(){
        $this->router = new Interpret();
    }

    public function init(){
        $this->router->routeCommand();
    }
}