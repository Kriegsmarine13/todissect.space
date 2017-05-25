<html>
    <head>
        <link type="text/css" rel="stylesheet" href="../../css/style.css">
        <link type="text/css" rel="stylesheet" href="../../css/dropzone.css">
<!--        <script src="../../js/modernizr-custom-full.js"></script>-->
        <script src="../../js/dropzone.min.js"></script>
<!--        <script src ="../../js/jquery-3.2.1.min.js"></script>-->
        <script>
            Dropzone.options.myDropzone = {
                init: function() {
                    thisDropzone = this;
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
    <form action="/artists/upload" class="dropzone" method="post" id="my-dropzone" enctype="multipart/form-data">
<!--        <label for="info">-->
<!--            <input type="text" name="info" id="info">-->
<!--        </label>-->
<!---->
<!--        <script>-->
<!--            Dropzone.options.myDropzone = {-->
<!--                autoProcessQueue : false,-->
<!--                addRemoveLinks : true,-->
<!--                init : function() {-->
<!--                    myDropzone = this;-->
<!---->
<!--                    this.on("success", function(){-->
<!--                        $.ajax({-->
<!--                            url: "/artists/upload",-->
<!--                            type: "POST",-->
<!--                            data: {-->
<!---->
<!--                            },-->
<!--                            success: function(data){-->
<!--                                alert("Data save: " + data);-->
<!--                            }-->
<!--                        })-->
<!--                    })-->
<!--                }-->
<!--            }-->
<!--        </script>-->
    </form>
    </body>
</html>