<?php

class Artists
{

    public static function getArtists() {
        $db = Db::getConnection();

        $artistsList = array();

        $result = $db->query('SELECT * '.
            'FROM users '.
            'INNER JOIN artists '.
            'ON users.login = artists.login '.
            'WHERE isArtist = 1');

        $i = 0;
        while($row = $result->fetch()) {
            $artistsList[$i]['nickname'] = $row['nickname'];
            $artistsList[$i]['profile_image'] = $row['profile_image'];
            $artistsList[$i]['info'] = $row['info'];
            $i++;
        }
        return $artistsList;
    }

    public static function uploadImage() {
        $db = Db::getConnection();

        $login = $_COOKIE['Authorized'];
        $timestamp = date("Y-m-d H:i:s");
        $ds          = DIRECTORY_SEPARATOR;
        $storeFolder = 'img/';
        $update = $db->prepare("UPDATE users SET isArtist = '1' WHERE login = '$login'");


        if (!empty($_FILES)) {

            $tempFile = $_FILES['file']['tmp_name'];

            $targetPath = ROOT . $ds . $storeFolder;

            $targetFile = $targetPath . $_FILES['file']['name'];

            $filePath = $storeFolder.basename($_FILES['file']['name']);
            $insertion = $db->prepare("INSERT INTO images (login, img_path, time_posted, img_info) VALUES('$login', '$filePath', '$timestamp', '')");

            move_uploaded_file($tempFile, $targetFile); //6
            $insertion->execute();
            $update->execute();
        } else {
                $result = array();

                $files = scandir($storeFolder);
                if(false!==$files) {
                    foreach($files as $file) {
                        if( '.'!=$file && '..'!=$file) {
                            $obj['name'] = $file;
                            $obj['size'] = filesize($storeFolder.$ds.$file);
                            $result[] = $obj;
                        }
                    }
                }
                header('Content-type: text/json');
                header('Content-type: application/json');
                echo json_encode($result);
            }
    }

    public static function addArtist() {
        $db = Db::getConnection();

        $login = $_COOKIE['Authorized'];
        $name = $_POST['nickname'];
        $info = $_POST['info'];

        $tempFile = $_FILES['img']['tmp_name'];

        $targetPath = ROOT . '/img/profiles/' . $name;

        $createDir = mkdir("$targetPath"); // Создаем директорию под изображения данного пользователя

        $targetFile = $targetPath . '/' . $_FILES['img']['name'];

        $filePath = 'img/profiles/'. $name . '/' .basename($_FILES['img']['name']);

        move_uploaded_file($tempFile, $targetFile);

        $addArtist = $db->query("INSERT INTO artists (login, nickname, profile_image,  info) VALUES ('$login', '$name', '$filePath', '$info')");
        if($addArtist) {
            header("Location: /artists");
        } else { die("Что-то пошло не так");
//            variables check
//            echo $login."<br>".$name."<br>".$filePath."<br>".$info."<br>";
        }

    }

    public static function checkArtists() {
        $db=Db::getConnection();
        $login = $_COOKIE['Authorized'];
        if($login) {
            $sql = $db->prepare("SELECT isArtist, nickname FROM users INNER JOIN artists ON users.login = artists.login WHERE users.login = '$login'");
            $sql->execute();
            $i = 0;
            $arr = array();
            while ($res = $sql->fetch()) {
                $arr[$i]['isArtist'] = $res['isArtist'];
                $arr[$i]['nickname'] = $res['nickname'];
            }
            if($arr[0]['isArtist'] == '1') {
                $button = "<a class=\"join-btn\" href=\"/artists/user/".$arr[0]['nickname']."\">Мой профиль</a>";
            } else {
                $button = "<a class=\"join-btn\" href=\"/artists/join\">Присоединиться</a>";
            }
        } else {
            $button = "<a class=\"join-btn\" href=\"/artists/join\">Присоединиться</a>";
        }
        $checkArtists = $button;
        return $checkArtists;
    }

}