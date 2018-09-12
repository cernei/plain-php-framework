<?php

use App\System\Kernel\Facade;

class Config extends Facade
{
    function getClassName()
    {
        return 'App\System\Config';
    }
}