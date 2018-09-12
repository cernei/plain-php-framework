<?php

namespace App\System;

use \Config;

class Request
{
    protected $url;
    protected $method;
    protected $serverName;

    function __construct($url = null, $method = null)
    {
        $this->url = $url ?? str_replace(Config::get('general.url_path_prefix'), '', $_SERVER['REQUEST_URI']);
        $this->method = $method ?? $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];
        $this->serverName = $_SERVER['SERVER_NAME'] ?? 'localhost';
    }

    function getUrl()
    {
        return $this->url;
    }

    function getMethod()
    {
        return $this->method;
    }

    function getServerName()
    {
        return $this->serverName;
    }
}