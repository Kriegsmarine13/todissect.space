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
<h1>Добро пожаловать в твоё убежище</h1>
<div class="menu-block">
    Навигация
    <ul type="none">
        <li><a href="/main/">Новости</a></li>
        <li><a href="/artists">Художники</a></li>
        <li><a href="#">Обзоры</a></li>
        <li><a href="#">Рецензии</a></li>
        <li><a href="#">Аниме Релизы</a></li>
        <li><a href="#">Музыкальные релизы</a></li>
        <li><a href="/Chat1/index.php">Чат</a></li>
        <li><a href="/php/test.php">Test</a></li>
    </ul>
</div>
<div class="main-block">
    <?php foreach($newsList as $newsItem):?>
    <div class=\"main-post\">
        <div class=\"main-img-mini\"><img src=\"<?php echo $newsItem['img'];?>\"></div>
        <div class=\"main-title\"><?php echo $newsItem['title'];?></div>
        <div class=\"main-descr\"><?php echo $newsItem['s_descr'];?></div>
        <a class='main-link' href="<?php echo $newsItem['link'];?>">Читать далее</a>
        <div class=\"main-timestamp\"><?php echo $newsItem['timestamp'];?></div>
    </div><br>
    <?php endforeach;?>
</div>
</body>
</html>