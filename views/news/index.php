<html>
<head>
    <title> DOLLARS </title>
    <meta charset="UTF-8">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../../css/style.css"/>
</head>
<body>
<div align="right">
        <img class="img-mini" width="110" src="../../img/dollars_logo.jpg" alt="dollars_logo">
</div>
<h1>Добро пожаловать в секту</h1>
<?php include(ROOT.'/views/layouts/side-menu.php'); ?>

<div class="main-block" id="main-block">
    <?php foreach($newsList as $newsItem):?>
    <div class="main-post">
        <div class="main-title"><?php echo $newsItem['title'];?></div>
        <div class="main-img-mini"><img src="../../<?php echo $newsItem['img'];?>"></div>
        <div class="main-descr"><?php echo $newsItem['s_descr'];?></div>
        <a class='main-link' href="/news/<?php echo $newsItem['link'];?>">Читать далее</a>
        <div class="main-timestamp"><?php echo $newsItem['timestamp'];?></div>
    </div><br>
    <?php endforeach;?>
    <?php for($i=1;$i<$total;$i++):?>
        <a href="/news/page/<?php echo $i; ?>"><?php echo $i ?></a>
    <?php endfor;?>
</div>
<?php include(ROOT.'/views/layouts/vidget.php');?>
</body>

</html>