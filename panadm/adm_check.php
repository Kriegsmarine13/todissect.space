<?php
error_reporting(E_ALL);
include_once('../components/Db.php');
$db = Db::getConnection();
$result = $db->query('SELECT * from users WHERE login='.$_POST['login']);
if(password_verify($result['password'], $_POST['password'])) {
    header('Location: main.php');
}

?>