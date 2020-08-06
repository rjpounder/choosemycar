<?php

namespace Framework\Router;

/**
 * Class Router
 * @package Framework\Router
 */
class Router
{
    /**
     * @var mixed
     */
    private $routes = [];

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routes = require(app_path('/routes.php'));
    }

    /**
     * @param string $route
     * @throws \Exception
     */
    public function load($route = '')
    {
        if (!$this->routes[$route]) {
            if(!isset($this->routes['/'])){
                throw new \Exception('404, with no fallback!');
            }
            $route = '/';
        }

        $method = $this->routes[$route]['method'];
        try {
            return (new $this->routes[$route]['controller'])->$method();
        } catch(\Exception $exception){
            throw new \Exception($exception->getMessage());
        }

    }
}
