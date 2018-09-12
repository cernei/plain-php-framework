<?php

use App\System\Kernel\Facade;

class Request extends Facade
{
    function getClassName()
    {
        return 'App\System\Request';
    }
}