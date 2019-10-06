<?php
namespace ThreeTwoZeroFive;

use ThreeTwoZeroFive\Interfaces\Router;

class Application {

    /**
     * @var Router
     */
    private static $router;


    public function __construct(Router $router)
    {
        self::$router = $router;
    }

    public function run()
    {
        return self::$router->handle();
    }
}