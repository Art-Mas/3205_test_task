<?php


namespace ThreeTwoZeroFive\Classes;


/**
 * Class Controller
 * @package ThreeTwoZeroFive\Classes
 *
 * @method ResponseBody actionView
 * @method actionCreate
 * @method actionUpdate
 */
abstract class Controller
{
    private $requestMethod_action = [
        'GET' => 'View',
        'POST' => 'Create',
        'PUT' => 'Update'
    ];

    public final function runAction($params)
    {
        $requestMethod = mb_strtoupper($_POST['_method'] ?? $_SERVER['REQUEST_METHOD']);
        $action = $this->requestMethod_action[$requestMethod];
        $method = 'action' . $action;
        if (method_exists($this, 'action' . $action)) {
            /** @var ResponseBody $content */
            $content = $this->$method($params);
            if ($content) {
                echo $content->get();
            }
        } else {
            throw new \Exception('method ' . $method . ' not exists');
        }
    }
}