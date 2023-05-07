<?php
require_once 'constants.php';
$request = $_SERVER['REQUEST_URI'];
$queryString = '?'.$_SERVER["QUERY_STRING"];

switch ($request) {
    case '':
    case '/':
        require __DIR__.'/app/index.php';
        break;

    case '/resize'.$queryString:
        require __DIR__.'/app/resize.php';
        break;

    default:
        http_response_code(404);
        require __DIR__.'/app/404.php';
        break;
}
