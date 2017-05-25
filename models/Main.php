<?php


class Main
{

    public static function verify() {

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
            setcookie("Authorized", $login, 0, '/', 'todissect.space');
            header('Location: /news');
        } else {
            header('Refresh:2 , /welcome');
        echo "Invalid Password";
        }

    }

    public static function register() {
        $db = Db::getConnection();

        $login = $_POST['login'];
        $login = $db->quote($login);
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $password = $db->quote($password);
        $mail =  $_POST['email'];
        $mail = $db->quote($mail);
        $registered = $db->query('INSERT INTO users (login, pass, email) VALUES ('.$login.', '.$password.', '.$mail.')');
        if($registered) {
            header('Location: /welcome');
        } else { echo "EЯЯОЯ";}
    }

}