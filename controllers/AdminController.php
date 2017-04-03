<?php
include_once(ROOT.'/models/Admin.php');

class AdminController
{

    public function actionIndex() {

        require_once(ROOT.'/views/admin/index.php');
        echo "actionIndex";
        return true;

    }

    public static function actionLogin() {
        echo "actionLogin";
        $db = Db::getConnection();

        $password = $_POST['password'];
        $login = $_POST['login'];
        $sql = $db->prepare('SELECT pass FROM kaichou WHERE login= ?');
        $sql->execute(array($login));
        foreach($sql as $row) {
            $hash = $row['pass'];
        }
        $passCheck = password_verify($password, $hash);

        if($passCheck) {
            header('Location: /admin');
        } else {echo"Invalid Password";}
    }

}