<html>
<head>
    <title>Dollars Admin Panel</title>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="../../panadm/css/style.css">
</head>
<body>
<h1><div align="right"><a href="../../panel">Main Page</a></div> </h1>
<div class="left-menu">
    <ul>
        <li><a href="/admin/add_news.php">Добавление новости</a></li>
        <li>Вариант 2</li>
        <li>Вариант 3</li>
    </ul>
</div></div>


<div class="main-menu">
    <form enctype="multipart/form-data" action="/admin/update" method="POST">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>"
            <label for="link">
            URL: <input type="text" name="link" id="link" value="<?php echo $data['link'];?>">
        </label>
        <br><br>
        <label for="img">
            <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
            News Image: <div class="edit-menu">
                <img src="../../<?php echo $data['img']; ?>"> (Текущее изображение)
            </div>
            <br>
            <input type="file" name="img" id="img">
        </label><br>
        <br><br>
        <label for="title">
            Title: <input type="text" name="title" id="title" value="<?php echo $data['title']; ?>">
        </label>
        <br><br>
        <label for="s_descr">
            Short Description: <input type="text" name="s_descr" id="s_descr" value="<?php echo $data['s_descr']; ?>">
        </label>
        <br><br>
        <label for="f_descr">
            News' Body:<br> <textarea name="f_descr" rows="20" cols="120">
                <?php echo $data['f_descr']; ?>
            </textarea>
        </label>
        <br><br>
        <input type="submit" name="send" value="Ready!">
    </form>
</div>
</body>
</html>

