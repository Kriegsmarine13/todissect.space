<?php
include_once (ROOT. '/models/News.php');

class NewsController
{

    public function actionIndex()
    {

        $newsList = array();
        $newsList = News::getNewsList();
        $total = News::getNumPages();

        require_once(ROOT.'/views/news/index.php');
        return true;
    }

    public function actionView($link)
    {
        $newsItem = News::getNewsItemByLink($link);
        if(!$newsItem) {
            header('HTTP/1.1 404 Not Found');
            require ROOT.'/404.html';
            exit;
        } else {
            require_once(ROOT . '/views/news/singlenews.php');
            return true;
        }
    }

}