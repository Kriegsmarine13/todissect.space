<?php
return array(
    'news/([a-z]+)' => 'news/view/$1', //path to one article
    'news' => 'news/index',  //actionIndex in NewsController
    '' => 'main/index',  //loginPage
    'login' => 'main/verify', //calling actionVerify  to login
    'admin' => 'admin/index', // admin login page
    'admin/verify' => 'admin/login', //calling actionVerify to login into admin page
    'product' => 'product/list', //actionList in ProductController
);