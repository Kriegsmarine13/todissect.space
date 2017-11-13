<?php
    // FRONT CONTROLLER


    //1. Common settings
    ini_set('display_errors',1);
    error_reporting(E_ALL);

    //2. Initializing system files
    define('ROOT', dirname(__FILE__));
    require_once(ROOT.'/components/Router.php');
    require_once(ROOT.'/components/Db.php');

    //3. Connecting to database
//    $page = $_SERVER['REQUEST_URI'];
//    $thisPage = explode($page, '/');
//    $thisPage = $thisPage[2];
//    if($thisPage !== 'welcome') {
//        if (!isset($_COOKIE['Authorized'])) {
//            header('Location: /welcome');
//        }
//    }
    //4. Calling Router
    $router = new Router();
    $router->run();