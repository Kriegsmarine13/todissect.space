<?php

class Router
{

    private $routes;

    public function __construct()
    {
        $routesPath = ROOT.'/config/routes.php';
        $this->routes = include($routesPath);
    }
    //return request string
    //return string
    private function getURI()
    {
        if(!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {

        //Get request string
        $uri = $this->getURI();
        //Check request in routes.php
        foreach ($this->routes as $uriPattern => $path) {

            //comparing $uriPattern and $uri
            if(preg_match("~$uriPattern~", $uri)){

                //getting internal path from outer according statement
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

                //define which controller and action work on request
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'.ucfirst(array_shift($segments));

                $parameters = $segments;

                //connect controller-class file
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';

                if(file_exists($controllerFile)) {
                    include_once($controllerFile);
                } else { echo "FILES DOES NOT EXIST";}


                //create object, call method
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName),$parameters);
                if($result != null) {
                    break;
                }
            }
        }
    }
}