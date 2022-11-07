<?php

namespace CPE\Framework;

/**
 * Almighty powerful and wonderful routing class
 */
class Router extends AbstractComponent
{
    protected string $routeParamName;
    protected array $routes;
    protected string $file;

    public function __construct(AbstractApplication $app)
    {
        parent::__construct($app);

        $this->routes = [];
        $this->routeParamName = $app->routeParamName();
        $this->file = '';
    }

    public function map(
        string $url,
        string $controller,
        string $action = 'index',
        string $method = 'GET',
        array $additional = [],
        array $optional = []
    ): Route {
        $route = new Route($url, $controller, $action, $method, $additional, $optional);
        $this->routes[] = $route;
        return $route;
    }

    /**
     * Returns a route based requested URL
     * @param string $url meaningful part of the url
     */
    public function findRoute(?string $url = null): ?Route
    {
        $foundRoute = false;
        $result = null;
        $parameters = [];

        if (is_null($url)) {
            $url = $this->getUrl();
        }

        //check for a predefined route
        foreach ($this->routes as $route) {
            $parameters = $this->matchRoute($url, $route);
            if (!is_null($parameters)) {
                $result = $route;
                break;
            }
        }

        //add other parameters given after '?' in a subarray
        $get = $_GET;
        unset($get[$this->routeParamName]);
        if (empty($get) === false) {
            $parameters['get'] = [];
            foreach ($_GET as $key => $getParam) {
                if ($key != $this->routeParamName) {
                    $parameters['get'][$key] = $getParam;
                }
            }
        }

        if (!is_null($result)) {
            $result->requestParams = $parameters;
        }

        //return found route and parameters
        return $result;
    }

    public function getUrl(): string
    {
        //remove '/' at the end of the url
        if (isset($_GET[$this->routeParamName])) {
            $url = rtrim($_GET[$this->routeParamName], "/");
        } else {
            $url = "/";
        }

        return $url;
    }

    public function matchRoute(string $url, Route $route): ?array
    {
        $routeIsAMatch = false;
        $requiredParams = [];

        //handle parameter types
        $regexp = preg_replace_callback(
            "/:(\w+)\|(\w+):/",
            function ($matches) use (&$requiredParams) {

                $requiredParams[] = $matches[2];

                //handle parameter type
                if ($matches[1] == 'int') {
                    return '(\d+)';
                } elseif ($matches[1] == 'string') {
                    return '(.+)';
                } else {
                    return $matches[0];
                }
            },
            str_replace('.', '\.', $route->url)
        );

        //match route including required parameters
        if (preg_match('%^' . $regexp . '(/.*)?$%i', $url, $matches)) {
            $routeIsAMatch = true;
            $parameters = [];
            $optional = '';

            //remove unnecessary match
            unset($matches[0]);
            //pop optional parameters if they exists
            if (count($matches) > count($requiredParams)) {
                $optional = array_pop($matches);
            }
            //combine required parameter values and names
            if (!empty($requiredParams)) {
                $parameters = array_combine($requiredParams, $matches);
            }

            //handle additional parameters (constants given via the route definition)
            foreach ($route->additional as $param) {
                $parameters[$param->getAttribute('name')] = $param->getAttribute('value');
            }

            //handle optional parameters
            if (!empty($optional)) {
                //if there's a "/" between required & optional part
                if ($optional[0] == "/") {
                    $optional = preg_split('%\|%', trim($optional, '/?'));
                    if (count($optional) == 1 && empty($optional[0])) {
                        unset($optional[0]);
                    }
                    $nbOptParam = $route->optional->length;

                    if (count($optional) <= $nbOptParam) {
                        //match the remaining ones to optional parameters
                        for ($i = 0; $i < $nbOptParam; $i++) {
                            if (isset($optional[$i])) {
                                $parameters[$route->optional->item($i)->getAttribute('name')] = $optional[$i];
                            }
                        }
                    } else {
                        //route don't really match (maybe has a longer path than the)
                        $routeIsAMatch = false;
                    }
                } else {
                    $routeIsAMatch = false;
                }
            }
        }
        return $routeIsAMatch ? $parameters : null;
    }

    /**
     * Returns a controller based on its name
     * @param string $controllerName controller name
     * @return AbstractController controller
     */
    public function getController(string $controllerName): AbstractController
    {
        return new $controllerName($this->app);
    }
}
