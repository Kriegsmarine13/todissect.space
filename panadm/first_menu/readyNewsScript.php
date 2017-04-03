<?php
error_reporting(E_ALL);
require ("../include/connector.php");
require("../include/post_data.php");
$uploadDir = '../../img/';
$target_file = $uploadDir . basename($_FILES["img_mini"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
if(isset($POST["submit"])) {
    $check = getimagesize($_FILES["img_mini"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " .$check["mime"] . ".";
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
if($_FILES["img_mini"]["size"] > 5000000) {
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
    if(move_uploaded_file($_FILES["img_mini"]["tmp_name"], $target_file)) {
        //echo "The file ". basename($_FILES["img_mini"]["name"]). " has been uploaded";
    } else {
        header('Refresh: 3; Location: ../');
        echo "Sorry, there was an error uploading your file";
    }
}
$dbcon = mysqli_connect($dbserver, $dblogin, $dbpassword, $dbname);
$postQuery = mysqli_query($dbcon, "INSERT INTO main_news(`id`, `img_mini`, `img_main`, `title`, `small_descr`, `descr`, `link`, `timestamp`) VALUES ('', '".$target_file."','".$img_MainPath."','".$titlePost."','".$sDescrPost."','".$descrPost."','".$linkData."' ,'".$timestampPost."')");
header("Refresh: 2, ../main.php");
echo("News posted, redirecting to a main page");