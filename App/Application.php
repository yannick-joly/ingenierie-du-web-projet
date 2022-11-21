<?php

namespace App;

use App\Controllers\DefaultController;
use CPE\Framework\AbstractApplication;
use CPE\Framework\Router;

class Application extends AbstractApplication
{
    public function run()
    {
        // default response if no route found
        $controllerName = DefaultController::class;
        $actionName = '404';
        $requestParams = [];

        // map all routes to corresponding controllers/actions
        $router = new Router($this);
        $router->map('/', DefaultController::class, 'index', 'GET');
        $router->map('/test/:int|nombre:', DefaultController::class, 'test', 'GET');

        $route = $router->findRoute();

        // route trouvée
        if (is_object($route)) {
            $controllerName = $route->controller;
            $actionName = $route->action;
            $requestParams = $route->requestParams;
        }

        $controller = $router->getController($controllerName);
        $controller->execute($actionName, $requestParams);
    }
}
