<?php
namespace ThreeTwoZeroFive\Classes;

use FastRoute;
use ThreeTwoZeroFive\Controllers\IndexController;



class Router implements \ThreeTwoZeroFive\Interfaces\Router
{
    /**
     * @var FastRoute\Dispatcher
     */
    private $dispatcher;

    public function __construct()
    {
        $this->dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
//            $r->addRoute('GET', '/{url:.+}', IndexController::class);
//            $r->addRoute('GET', '/parse/{url:.*}', IndexController::class);
            $r->addRoute('GET', '/parse', IndexController::class);
        });
    }

    public function handle()
    {
        // Fetch method and URI from somewhere
        $httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $this->dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::FOUND:
                /** @var Controller $handler */
                $handler = new $routeInfo[1]();
                $vars = $routeInfo[2];
                $handler->runAction($vars);
                break;
            default:
                http_response_code(404);
        }
    }

}