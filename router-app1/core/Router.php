<?php
/**
 * Created by PhpStorm.
 * User: Julius Alvarado
 * Date: 3/8/2017
 * Time: 2:02 PM
 */

class Router {
    protected $routes = [];
    protected $uri = '';

    public function define($routes) {
        $this->routes = $routes;
    }

    public function direct($uri) {
        // e.g. app.com/about/culture
        echo $uri;
        if(array_key_exists($uri, $this->routes)) {
            return $this->routes[$uri];
        }

        throw new Exception('jha - No route for this uri');
    }
}