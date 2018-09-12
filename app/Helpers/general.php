<?php

use App\System\Kernel\App;

function app() {
    return App::getInstance();
}

function render($name, $arr = [])
{
    $arr['template'] = renderView($name, $arr);
    return renderView('main', $arr);
}

function renderView($name, $arr = [])
{
    extract($arr);
    ob_start();
    include ('../app/views/' . $name . '.php');
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}

function href($routeName, $id = null) {

	$route = Router::getCompiled($routeName, $id);

	return $route->url;
}

function old($name, $item)
{
    return isset($_POST[$name]) ? htmlspecialchars($_POST[$name]): (isset($item->{$name}) ? htmlspecialchars($item->{$name}):  '');
}

function validateFromInput($input)
{
    $messages = [
        'int' => 'Only integer values are allowed.',
        'email' => 'Invalid email format.',
    ];
    foreach ($input as $name => $type) {
        if (in_array($type, ['int', 'email'])) {
            $filter = constant('FILTER_VALIDATE_' . strtoupper($type));
            if (!filter_var($_POST[$name], $filter)) {
                $errorMessage = $messages[$type];
                $isValid = false;
            }
        }
    }
    return (object) ['isValid' => $isValid, 'error' => $errorMessage ?? ''];
}

function form_open($routeName, $attr = [])
{
	$route = Router::getCompiled($routeName, $attr['id'] ?? null);
    return '<form action="'. $route->url . '" method="POST"><input type="hidden" name="_method" value="' . $route->http . '">';
}

function redirect( $routeName, $id = null)
{
    $route = Router::getCompiled($routeName, $id);

    header('Location:' . $route->url);
    exit;
}

function notFound()
{
    header('HTTP/1.0 404 Not Found');
    exit;
}

function keyBy($items, $key) {
    $arr = [];
    foreach($items as $item) {
        $arr[$item->{$key}] = $item;
    }
    return $arr;
}
