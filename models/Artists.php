<?php

class Artists
{

    public function getArtists() {
        $db = Db::getConnection();

        $result = $db->query('SELECT * '.
            'FROM users '.
            'INNER JOIN artists '.
            'ON users.login = artists.login');

        $i = 0;
        while($row = $result->fetch()) {
            $artistsItem[$i]['id'] = $row['id'];
            $artistsItem[$i]['login'] = $row['login'];
            $artistsItem[$i]['name'] = $row['name'];
            $artistsItem[$i]['profile_img'] = $row['profile_img'];
            $artistsItem[$i]['info'] = $row['info'];
            $i++;
        }
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
}