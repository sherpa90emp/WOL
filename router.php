<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($path, '/api'))
{
    require __DIR__.'/Backend/index.php';
    return true;
}

$file = __DIR__.'/Frontend'.$path;
if ($path !== '/' && is_file($file))
{
    return false;
}

readfile(__DIR__.'/Frontend/index.html');