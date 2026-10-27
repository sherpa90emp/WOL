<?php

header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__.'/Router.php';

$router = new Router(__DIR__.'/Controller');
$router->dispatch();