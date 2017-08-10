<html>
<head>
    <title>Dollars Admin Panel</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../../panadm/css/style.css">
</head>
<body>
<h1>Welcome, <?php echo($_COOKIE["Name"]); ?></h1>
<div class="left-menu">
    <ul>
        <li><a href="/admin/add_news.php">Добавление новости</a></li>
        <li><a href="/admin/list">Список новостей</a></li>
        <li>Вариант 3</li>
    </ul>
</div></div>


<div class="main-menu">
    <h2>Список новостей</h2>
    <?php foreach($newsList as $newsItem):?>
    <div class="news-admin">
        <div class="admin-options">
            <ul>
                <li><a href="/admin/edit/<?php echo $newsItem['link']?>">Изменить новость</a></li>
                <li><a href="/admin/hide">Скрыть/показать новость</a></li>
                <li><a href="/admin/delete_news">Удалить новость</a></li>
            </ul>
        </div>
        <div class="admin-main-info">
            <b>Заголовок новости:</b>
            <br>
            <?php echo $newsItem['title'];?>
            <br>
            <b>Короткое описание:</b>
            <br>
            <?php echo $newsItem['s_descr'];?>
            <br>
        </div>
        <div class="admin-image">
            <img src="../../<?php echo $newsItem['img'];?>">
            <br>
        </div>
    </div>
    <?php endforeach;?>
</div>
<div class="options-menu">
    <ul>
        <li><a href="../../panadm/second_menu/time.php">Timestamp</a></li>
        <li>Option 2</li>
        <li>Option 3</li>
        <li>Option 4</li>
        <li>Option 5</li>
        <li>Option 6</li>
    </ul>
</div>
</body>
</html>