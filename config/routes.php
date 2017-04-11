<?php
return array(
    'news/([a-zA-Z0-9_-]+)' => 'news/view/$1', //path to one article
    'news' => 'news/index',  //actionIndex in NewsController
    'welcome' => 'main/index',  //loginPage
    'login' => 'main/verify', //calling actionVerify  to login
    'admin' => 'admin/index', // admin login page
    'verify' => 'admin/login', //calling actionLogin in AdminController
    'panel' => 'admin/panel',
    'panel/([a-z]+)' => 'admin/view/$1', //call to admin panel buttons
    'admin/Send_news' => 'admin/Send_news',
    'product' => 'product/list', //actionList in ProductController
);