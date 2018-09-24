<?php

namespace App\System\Kernel;

abstract class Facade
{
    public static function __callStatic($method, $args)
    {
        return App::getInstance()->get(static::getClassName())->$method(...$args);
    }
}