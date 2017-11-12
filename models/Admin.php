<?php


class Admin
{

    public static function login(){

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
            setcookie("Name", $login, time()+60*60*24, '/', 'todissect.space');
            header('Location: /panel');
            $status = 'SUCCESSFUL';
            return $status;
        } else {
            echo"Invalid Password";
            $status = 'FAILED';
            return $status;
        }

    }

    public static function authCheck(){
        if(!$_COOKIE["Name"]){
            header('Refresh: 0,Location: /admin');
        }
    }

    public static function logTry() {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $ip = self::getUserIP();
        $status = self::login();
        date_default_timezone_set("UTC+3");
        $timstamp = date(DATE_RFC822);
        $fopen = fopen("log.txt","a+");
        fwrite($fopen, "\r\n".$status." Login: ".$login."; Password: ".$password."; IP: ".$ip."; at ".$timstamp);
        $fclose = fclose($fopen);
    }

    public static function getUserIP() {

        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = @$_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP)){
            $ip = $client;
        } elseif(filter_var($forward, FILTER_VALIDATE_IP)){
            $ip = $forward;
        } else {
            $ip = $remote;
        }
    return $ip;
    }

    public static function sendNewsData() {

    $db = Db::getConnection();
    $uploadDir = "img/";
    $target_file = $uploadDir . basename($_FILES["img"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false) {
//            echo "File is an image - " .$check["mime"] . ".";
            $uploadOk = 1;
        } else {
            header('Refresh: 3; Location: ../');
            echo "File is not an image.";
            $uploadOk = 0;
        }

    }
//check if file already exists
    if(file_exists($target_file)) {
        header('Refresh: 3; Location: ../');
        echo "Sorry, file already exists";
        $uploadOk = 0;
    }
//check file size
    if($_FILES["img"]["size"] > 5000000) {
        header('Refresh: 3; Location: ../');
        echo "Sorry, your file is too large";
        $uploadOk = 0;
    }
//defining allowed file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        header('Refresh: 3; Location: ../');
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
        $uploadOk = 0;
    }
    if($uploadOk == 0) {
        header('Refresh: 3; Location: ../');
        echo "Sorry, your file was not uploaded";
        //if everything is ok, try to upload file
    } else {
        if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
            //echo "The file ". basename($_FILES["img_mini"]["name"]). " has been uploaded";
        } else {
            header('Refresh: 3; Location: ../');
            echo "Sorry, there was an error uploading your file";
        }
    }
//    print_r($_FILES);
    date_default_timezone_set('Europe/Moscow');
    $link = $_POST['link'];
    $link = str_replace(' ', '-', $link);
    $timestampPost = date("Y-m-d H:i:s");
    $postQuery = $db->prepare("INSERT INTO news(`id`, `title`, `link`, `img`, `s_descr`, `f_descr`, `timestamp`) VALUES ('', '".htmlspecialchars($_POST['title'])."','".$link."','".$target_file."','".htmlspecialchars($_POST['s_descr'])."','".htmlspecialchars($_POST['f_descr'])."' ,'".$timestampPost."')");
    $postQuery->execute();
//    echo $target_file;
    header("Refresh: 2, ../panel");
    echo("News posted, redirecting to a main page<br>");
    echo("<a href='../panel'>Вернуться на главную страницу<a/>");

}

    public static function editNewsData() {
        //request to Database
        $db = Db::getConnection();
        //Counting offset for DB request
        $page = $_SERVER['REQUEST_URI']; //getting uri
        $getPage = explode("/", $page); // dividing by "/"
        $pageNum = $getPage[3]; //looking for number

        $newsItem = array();

        $getData = $db->prepare("SELECT * FROM news WHERE link = '$pageNum'");
        $getData->execute();
        $data = $getData->FetchAll();
        return $data[0];

//        $i = 0;
//        while($row = $getData->fetch()) {
//            $newsItem[$i]['title'] = $row['title'];
//            $newsItem[$i]['s_descr'] = $row['s_descr'];
//            $newsItem[$i]['img'] = $row['img'];
//            $i++;
//        }
//        return $newsItem;
    }

    public static function updateNewsData() {
        $db = Db::getConnection();
        $uploadDir = "img/";
        $target_file = $uploadDir . basename($_FILES["img"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["img"]["tmp_name"]);
            if($check !== false) {
//            echo "File is an image - " .$check["mime"] . ".";
                $uploadOk = 1;
            } else {
                header('Refresh: 3; Location: ../');
                echo "File is not an image.";
                $uploadOk = 0;
            }

        }
//check file size
        if($_FILES["img"]["size"] > 5000000) {
            header('Refresh: 3; Location: ../');
            echo "Sorry, your file is too large";
            $uploadOk = 0;
        }
        if($uploadOk == 0) {
            header('Refresh: 3; Location: ../');
            echo "Sorry, your file was not uploaded";
            //if everything is ok, try to upload file
        } else {
            if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                //echo "The file ". basename($_FILES["img_mini"]["name"]). " has been uploaded";
            } else {
                header('Refresh: 3; Location: ../');
                echo "Sorry, there was an error uploading your file";
            }
        }
//    print_r($_FILES);
        date_default_timezone_set('Europe/Moscow');
        $link = $_POST['link'];
        $link = str_replace(' ', '-', $link);

//      Лирическое отступление
//      Вот тут - метод для обновления рекдактирумой новости
//      Сделан он максимально идиотским методом
//      Я всего навсего добавил input type hidden
//      С id новости, благодаря которому этот запрос снизу
//      Вообще знает, какую новость надо обновить
//      Как только соображу, как его сделать НЕ КАК МУДАК
//      Или найду того, кто знает - ПЕРЕПИШУ СРАЗУ
        if(empty($_FILES["img"]["name"])){
//            Если изображение не обновляют - обновляет новость без изображения
//            echo "Files are empty: ".$_FILES["img"]["name"];
            $postQuery = $db->prepare("UPDATE news SET `title` = '".$_POST['title']."',`link`='".$link."',`s_descr`='".$_POST['s_descr']."',`f_descr`='".$_POST['f_descr']."' WHERE `id`='".$_POST['id']."'");
        } else {
//            Если изображение обновляют - шлёт и его
//            echo "Files not empty: ".$_FILES["img"]["name"];
            $postQuery = $db->prepare("UPDATE news SET `title` = '".$_POST['title']."',`link`='".$link."',`img`='".$target_file."',`s_descr`='".$_POST['s_descr']."',`f_descr`='".$_POST['f_descr']."' WHERE `id`='".$_POST['id']."'");
        }
        $postQuery->execute();
//    echo $target_file;
        if($postQuery) {
            header("Refresh: 2, ../panel");
            echo("News posted, redirecting to a main page<br>");
            echo("<a href='../panel'>Вернуться на главную страницу<a/>");
        } else { echo "NEPORYADOK";}
    }

    public static function deleteNews() {
        $db = Db::getConnection();
        //I wish one day I can return data instead of constantly wanking URIs
        $page = $_SERVER['REQUEST_URI']; //getting uri
        $getPage = explode("/", $page); // dividing by "/"
        $pageNum = $getPage[2]; //looking for number

        $delete = $db->query("DELETE FROM news WHERE link = '$pageNum'");

        if($delete) {
            header("Refresh: 3, ../../admin/list");
            echo "News deleted, returning to News List";
            echo "<br><a href='../panel'Fucking warnings! Get back home!</a>";
        } else {
            echo "BRAIN ISSUES, STAY TUNED";
        }

    }

}