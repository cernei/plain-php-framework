<?php

namespace App\System;

use \Auth;
use \Config;
use \Request;

class Router
{

    protected $routes = [];
    protected $activeRoute;

    function __construct()
    {
        $this->parseRoutes(Config::get('routes'));
        $this->handle();
    }

    function parseRoutes($routes)
    {
        foreach ($routes as $groupName => $groupItems) {
            foreach ($groupItems as $routeName => $routeItems) {
                $item = [];
                $item['name'] = $routeName;
                $item['group'] = $groupName;
                $item['url'] = $routeItems[0];
                list($item['class'], $item['method']) = explode('@', $routeItems[1]);

                $item['http'] = $routeItems[2]['http'] ?? 'GET';

                $arr[$routeName] = $item;
            }

        }
        $this->routes = $arr;
    }


    function handle()
    {
        foreach ($this->routes as $route) {
            $regex = str_replace('{:int}', '([0-9]+)', $route['url']);
            $regex = str_replace('/', '\/', $regex);

            if (preg_match("/^{$regex}$/", Request::getUrl(), $matches) && Request::getMethod() == $route['http']) {
                $route['param'] = $matches[1] ?? null;
                $this->activeRoute = (object)$route;
                break;
            }
        }

        if (isset($route['group']) && $route['group'] == 'auth') {
            if (!Auth::check()) {
                $this->activeRoute = (object)$this->routes[Config::get('general.fallback_route')];
            }
        }

    }

    function getCompiled($name, $param = null)
    {
        $route = $this->routes[$name];
        $compiled = $route['url'];
        if ($param && strpos($route['url'], '{:int}') !== false) {
            $compiled = str_replace('{:int}', $param, $route['url']);
        }
        return (object)[
            'url' => Config::get('general.url_path_prefix') . $compiled,  // 'http://' . $this->request->getServerName() .  $compiled
            'http' => $route['http'],
        ];
    }

    public function getActiveRoute()
    {
        return $this->activeRoute;
    }

}