<?php
require_once('../vendor/autoload.php');

$route = $_SERVER['PATH_INFO'] ?? '/';
$router = new \Framework\Router\Router;
$router->load($route);
