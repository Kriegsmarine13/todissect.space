<?php
include_once(ROOT.'/models/Main.php');

class MainController
{

    public static function actionIndex() {

        require_once(ROOT.'/views/main/index.php');


        return true;

    }

    public static function actionIndexlmain() {

        return false;
    }

    public static function actionVerify() {
        $db = Db::getConnection();

        $password = $_POST['password'];
        $login = $_POST['login'];
        $sql = $db->prepare('SELECT pass FROM users WHERE login= ?');
        $sql->execute(array($login));
        foreach($sql as $row) {
            $hash = $row['pass'];
        }
        $passCheck = password_verify($password, $hash);

        if($passCheck) {
            header('Location: /news');
        } else {echo"Invalid Password";}
    }

}