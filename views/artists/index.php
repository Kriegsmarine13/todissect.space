<html>
    <head>
        <title> DOLLARS </title>
        <meta charset="UTF-8">
        <script src="../js/jquery-3.2.1.min.js"></script>
        <link type="text/css" rel="stylesheet" href="../../css/style.css"/>
    </head>
    <body>

        <?php include (ROOT.'/views/layouts/side-menu.php'); ?>
        <?php echo $checkArtists;?>
        <div class="main-block">
            <?php foreach ($artistsList as $artistsItem); ?>
            <div class="artist-item">
                <div class="artist-item-profile-photo">
                    <img src="../../<?php echo $artistsItem['profile_image'];?>">
                </div>
                <a class="artist-item-name" href="/artists/<?php echo $artistsItem['nickname']; ?>"><?php echo $artistsItem['nickname'];?></a>
            </div>
        </div>
        <?php include(ROOT.'/views/layouts/vidget.php');?>
    </body>
</html>