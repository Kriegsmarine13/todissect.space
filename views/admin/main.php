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
<h2>Здесь будет выводиться всякая бытовая хрень, не знаю зачем</h2>
    <?php
        $db = Db::getConnection();
        echo("Php Version: ".phpversion()."<br>");
        echo("MySQL Version: ".$db->query('select version()')->fetchColumn());
    ?>
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
