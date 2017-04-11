<?php
include_once(ROOT.'/models/Admin.php');

class AdminController
{

    public function actionIndex() {

        require_once(ROOT.'/views/admin/index.php');
        return true;

    }

    public static function actionLogin() {
        Admin::login();
        return true;
    }

    public function actionPanel() {

        require_once(ROOT.'/views/admin/main.php');
        Admin::authCheck();
        return true;

    }

    public function actionView() {
        echo "actionView in AdminController";
        return true;
    }

    public function actionAdd_news() {
        require_once(ROOT.'/views/admin/add_news.php');
        return true;
    }

    public function actionSend_News() {
        Admin::sendNewsData();
        return true;
    }

}