<?php
    session_start();
?>
<html>
<head>
    <title>Dollars Admin Panel</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/style.css">
</head>
<body>
<h1><?php echo ("Success! Welcome, ").$_SESSION['name']; ?></h1>
<div class="left-menu">
    <ul>
        <li><a href="first_menu/add_news.php">Добавление новости</a></li>
        <li><a href="first_menu/news_list.php">Список новостей</a></li>
        <li>Вариант 3</li>
    </ul>
</div></div>


<div class="main-menu">
<h2>Здесь будет выводиться всякая бытовая хрень, не знаю зачем</h2>
    <?php
    require_once("../php/meta.php");
        $dbcon = mysqli_connect($dbserver, $dblogin, $dbpass, $dbname);
        echo("Php Version: ".phpversion()."<br>");
        if($dbcon) {
            echo("MySQL Version: ".mysqli_get_server_info($dbcon));
        } else {
            echo ("no connection");
        }

    ?>
</div>
<div class="options-menu">
    <ul>
        <li><a href="second_menu/time.php">Timestamp</a></li>
        <li>Option 2</li>
        <li>Option 3</li>
        <li>Option 4</li>
        <li>Option 5</li>
        <li>Option 6</li>
    </ul>
</div>
</body>
</html>
