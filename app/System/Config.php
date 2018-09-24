<?php

namespace App\System;

class Config
{
    protected $configs;

    public function get($name)
    {
        if (strpos($name, '.')) {
            list($name, $param) = explode('.', $name);
        }
        $this->load($name);
        if (isset($param)) {
            return $this->configs[$name][$param];
        } else {
            return $this->configs[$name];
        }
    }

    protected function load($name)
    {
        $this->configs[$name] = $this->configs[$name] ?? require_once('../app/config/' . $name . '.php');
    }
}