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

                //ACCESS RESTRICTON! If user is asking for any page
                //except login page
                //then check his login cookie
                //if there is not - redirect to login page
                if($uri !== 'welcome'){
                    if(!isset($_COOKIE['Authorized'])){
                        header('Location: /welcome');
                    }
                }

                //Admin page access restriction
                //Checking cookie for access to admin page like admin/list or /panel
                //if no cookie - redirects to admin login page
                if(preg_match("/^admin\/[a-zA-Z0-9_-]+$/i", $uri) || preg_match('/panel/i', $uri)){
//                if($uri == 'admin/([a-zA-Z0-9_-]+)' || $uri == 'panel'){
                    if(!isset($_COOKIE['Name'])){
                        header('Location: /admin');
                    }
                }

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