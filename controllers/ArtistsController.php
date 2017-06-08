<?php
include_once (ROOT.'/models/Artists.php');

class ArtistsController
{

    public function actionIndex(){

        $artistsList = array();
        $artistsList = Artists::getArtists();
        $checkArtists = Artists::checkArtists();

        require_once (ROOT.'/views/artists/index.php');
        return true;
    }

    public function actionView() {
        //Получаем запрашиваемого пользователя
        $page = $_SERVER['REQUEST_URI'];
        $getArtist = explode('/', $page);
        $artist = $getArtist[3];
        $db = Db::getConnection();
        $sql = $db->prepare("SELECT login FROM artists WHERE nickname = '$artist'");
        $sql->execute();
        $mas = $sql->fetchAll();
        $artistLogin = $mas[0][0];
        //Начинаем проверку, чтобы другие пользователи не могли редактировать страницы других
        if(empty($_COOKIE['Authorized']) || $_COOKIE['Authorized'] != $artistLogin) {
            header("Location: /artists/$artist");
        }
        else {
            require_once (ROOT.'/views/artists/singleartist.php');
        }
//Проверка тупо простая. Мы берём из URI юзернейм, находим его логин исравниваем с логином в кукане
        return true;
    }

    public function actionGuestView() {

        require_once (ROOT.'/views/artists/guestview.php');

        return true;

    }

    public function actionJoin() {
        if(!isset($_COOKIE["Authorized"])) {
            header('Refresh: 2, /welcome');
            print_r("Пожалуйста, авторизуйтесь чтобы добавлять изображения!");
        } else {
            require_once(ROOT.'/views/artists/join.php');
        }

        return true;
    }

    public function actionUpload() {

        Artists::uploadImage();
        return true;
    }

    public static function actionaddArtist() {

        Artists::addArtist();
        return true;
    }
}