<?php
return array(
    //NEWS PAGE ROUTES
    'news/page/([0-9]+)' => 'news/index/$1',
    'news/([a-zA-Z0-9_-]+)' => 'news/view/$1', //path to one article
    'news' => 'news/index',  //actionIndex in NewsController
    //STARTING PAGE ROUTES
    'welcome' => 'main/index',  //loginPage
    'login' => 'main/verify', //calling actionVerify  to login
    'registration' => 'main/registration',
    'register' => 'main/register',
    //ARTISTS PAGE ROUTES
    'artists/join' => 'artists/join',
    'artists/addArtist' => 'artists/addArtist',
    'artists/upload' => 'artists/upload',
    'artists/user/([a-zA-Z0-9_-]+)' => 'artists/view/$1',
    'artists' => 'artists/index',
    //========ADMIN ROUTES
    'admin' => 'admin/index', // admin login page
    'verify' => 'admin/login', //calling actionLogin in AdminController
    'panel' => 'admin/panel',
    'panel/([a-z]+)' => 'admin/view/$1', //call to admin panel buttons
    'admin/Send_news' => 'admin/Send_news',
    'product' => 'product/list', //actionList in ProductController
);