<?php
include_once(ROOT.'/models/Main.php');

class MainController
{

    public static function actionIndex() {

        if(isset($_COOKIE['Authorized'])){
            header('Location: /news');
        } else {
            require_once(ROOT.'/views/main/index.php');
        }

        return true;

    }

    public static function actionRegistration() {
        require_once(ROOT.'/views/main/register.php');

        return true;
    }

    public static function actionRegister() {
        Main::register();
        return true;
    }

    public static function actionVerify() {

        Main::verify();
        return true;
    }

}