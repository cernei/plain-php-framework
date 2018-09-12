<?php

use App\System\Kernel\Facade;

class Auth extends Facade
{
    function getClassName()
    {
        return 'App\System\Auth';
    }
}