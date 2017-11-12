<?php
include_once(ROOT.'/models/Admin.php');
include_once(ROOT.'/models/News.php'); //DRY! Using method from News.php to get news data

class AdminController
{

    public function actionIndex() {

        require_once(ROOT.'/views/admin/index.php');
        return true;

    }

    public static function actionLogin() {
        Admin::login();
        Admin::getUserIP();
        Admin::logTry();
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

    public function actionList() {
        $newsList = array();
        $newsList = News::getNewsList();

        require_once(ROOT.'/views/admin/get_list.php');
        return true;
    }

    public function actionEditNews() {
        $data = array();
        $data = Admin::editNewsData();

        require_once(ROOT.'/views/admin/edit_news.php');
        return true;
    }

    public function actionUpdate_data() {
        $data = array();
        Admin::updateNewsData();
    }

    public function actionDelete_news() {
        Admin::deleteNews();
        return true;
    }

}