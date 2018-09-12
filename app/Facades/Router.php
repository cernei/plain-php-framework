<?php

use App\System\Kernel\Facade;

class Router extends Facade
{
    function getClassName()
    {
        return 'App\System\Router';
    }
}