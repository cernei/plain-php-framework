<?php

require_once  __DIR__ . '/../bootstrap.php';

$activeRoute = Router::getActiveRoute();


if ($activeRoute) {
    try {
        $controller = app()->make('App\\Controllers\\' . $activeRoute->class);
        $response = $controller->{$activeRoute->method}($activeRoute->param ?? null);
    } catch (Exception $e) {
        $response = $e->getMessage();
    }
    
} else {
	notFound();
}
echo $response;