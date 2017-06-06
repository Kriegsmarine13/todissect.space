<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../../css/style.css">
        <link type="text/css" rel="stylesheet" href="../../css/dropzone.css">
        <script src="../../js/dropzone.min.js"></script>
        <script src ="../../js/jquery-3.2.1.min.js"></script>
        <script>
            Dropzone.options.myDropzone = {
                autoProcessQueue: false,
                addRemoveLinks: true,
                init: function() {
                    var submitButton = document.querySelector("#submit-all")
                    thisDropzone = this;
                    submitButton.addEventListener("click", function(){
                        thisDropzone.processQueue();
                    });

                    $.get('artists/upload', function(data) {
                        $.each(data, function(key,value){
                            var mockFile = { name: value.name, size: value.size };
                            thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                            thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "img/"+value.name);
                        });
                    });
                }
            }
        </script>
        <title> Здравствуй, <?php echo $_COOKIE["Authorized"] ?></title>
    </head>
    <body>
    <?php include(ROOT.'/views/layouts/side-menu.php'); ?>
    <a href="javascript:history.go(-1)" class="join-btn">Вернуться назад</a>
    <br>
    <form action ="/artists/addArtist" method="post" enctype="multipart/form-data">
        <label class="pass-field-main" for="nickname">
            Придумайте свой псевдоним: <input type="text" name="nickname">
        </label><br>
        <label class="pass-field-main" for="info">
            Добавьте информацию о себе (опционально): <textarea name="info"></textarea>
        </label>
        <br>
        <input type="hidden" name="MAX_FILE_SIZE" value="5000000">
        Изображения профиля: <input type="file" name="img" id="img">
        <br>
        <input type="submit" class="input2" value="Отправить">
    </form>
    <form action="/artists/upload" class="dropzone" method="post" id="my-dropzone" enctype="multipart/form-data">
    </form>
    <button class="input2" id="submit-all">Загрузить</button>
    </body>
</html>