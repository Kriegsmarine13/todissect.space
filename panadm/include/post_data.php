<?php
$img_miniPath = "";
$img_MainPath = "";
$titlePost = $_POST['title'];
$sDescrPost = $_POST['small_descr'];
$descrPost = $_POST['descr'];
date_default_timezone_set('Europe/Moscow');
$timestampPost = date("Y-m-d H:i:s");
$linkData = "/news/".$_POST['link'];