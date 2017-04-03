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
<h1><?php echo ("Success! Welcome, ").$_SESSION['name']; ?> <div align="right"><a href="../main.php">Main Page</a></div> </h1>
<div class="left-menu">
    <ul>
        <li><a href="first_menu/add_news.php">Добавление новости</a></li>
        <li>Вариант 2</li>
        <li>Вариант 3</li>
    </ul>
</div></div>


<div class="main-menu">
    <form enctype="multipart/form-data" action="readyNewsScript.php" method="POST">
        <label for="link">
            URL: <input type="text" name="link" id="link">
        </label>
        <br><br>
        <label for="img_mini">
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
            Preview Image: <input type="file" name="img_mini" id="img_mini">
        </label><br>
        <br><br>
        <label for="img_main">
            Main Image: <input type="file" name="img_main" id="img_main">
        </label>
        <br><br>
        <label for="title">
            Title: <input type="text" name="title" id="title">
        </label>
        <br><br>
        <label for="small_descr">
            Short Description: <input type="text" name="small_descr" id="small_descr">
        </label>
        <br><br>
        <label for="descr">
            News' Body:<br> <textarea name="descr" rows="20" cols="120">
                Enter HTML here...
            </textarea>
        </label>
        <br><br>
        <input type="submit" name="send" value="Ready!">
    </form>
</div>
</body>
</html>

