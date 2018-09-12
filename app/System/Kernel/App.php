<?php

namespace App\System\Kernel;

class App extends Singleton
{
    static $_classes = [];

    function __construct()
    {
        $this->loadFacades();
    }

    function loadFacades()
    {

    }

    function make($abstract, $params = [])
    {
        return self::$_classes[$abstract] = new $abstract(...$params);
    }

    function set($abstract, $concrete)
    {
        self::$_classes[$abstract] = $concrete;
    }

    function get($abstract)
    {
        return self::$_classes[$abstract] ?? self::$_classes[$abstract] = new $abstract;
    }
}