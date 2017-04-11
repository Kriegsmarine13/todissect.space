<?php
include_once(ROOT.'/models/Main.php');

class MainController
{

    public static function actionIndex() {

        require_once(ROOT.'/views/main/index.php');


        return true;

    }

    public static function actionVerify() {

        Main::verify();
        return true;
    }

}