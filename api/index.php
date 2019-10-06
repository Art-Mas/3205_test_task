<?php
require_once './vendor/autoload.php';
use ThreeTwoZeroFive\Classes\Router;
use Rakit\Validation\Validator;
use ThreeTwoZeroFive\Application;

// projname/api to /
$_SERVER['REQUEST_URI'] = preg_replace('#.*\/api\/?(.*)#i', '/${1}', $_SERVER['REQUEST_URI']);

$router = new Router();
(new Application($router))->run();
