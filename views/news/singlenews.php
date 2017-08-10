<html>
<head>
    <title> DOLLARS </title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../css/style.css"/>
</head>
<body>
<div align="right">
    <img class="img-mini" width="110" src="../img/dollars_logo.jpg" alt="dollars_logo">
</div>
<?php include(ROOT.'/views/layouts/side-menu.php'); ?>
<div class="main-block">
        <div class="main-post">
            <div class="single-title"><?php echo $newsItem['title'];?></div>

            <div class="single-descr"><?php echo $newsItem['f_descr'];?></div>
            <div class="single-img"><img src="../<?php echo $newsItem['img'];?>"></div>
            <div class="main-timestamp"><?php echo $newsItem['timestamp'];?></div>
            <a class="main-link" href="javascript:history.go(-1)">Вернуться назад</a>
        </div><br>
</div>
<?php include(ROOT.'/views/layouts/vidget.php');?>
</body>
</html>