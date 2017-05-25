<?php


class News {

    public static function getNewsItemByLink($link)
    {

        if($link) {
            //request to Database
            $db = Db::getConnection();

            $result = $db->prepare('SELECT * from news WHERE link=?');
            $result->setFetchMode(PDO::FETCH_ASSOC);
            $result->execute(array($link));
            foreach ($result as $newsItem){
                return $newsItem;
            }
        }
    }

    public static function getNewsList()
    {
        //request to Database
        $db = Db::getConnection();
        //Counting offset for DB request
        $page = $_SERVER['REQUEST_URI']; //getting uri
        $getPage = explode("/", $page); // dividing by "/"
        $pageNum = $getPage[3]; //looking for number
        if($pageNum == 1) { $pageNum = 0; } //if we look for first page, $offset = 0
        $offset = $pageNum * 5; //if not, getting news for asked page

        $newsList = array();

        $result = $db->query('SELECT * '
            . 'FROM news '
            . 'ORDER BY timestamp DESC '
            . 'LIMIT 5 '
            . 'OFFSET '.$offset);

        $i = 0;
        while($row = $result->fetch()) {
            $newsList[$i]['id'] = $row['id'];
            $newsList[$i]['title'] = $row['title'];
            $newsList[$i]['link'] = $row['link'];
            $newsList[$i]['img'] = $row['img'];
            $newsList[$i]['s_descr'] = $row['s_descr'];
            $newsList[$i]['f_descr'] = $row['f_descr'];
            $newsList[$i]['timestamp'] = $row['timestamp'];
            $i++;
        }

        return $newsList;

    }

    public static function getNumPages() {
        $db = Db::getConnection();

        $newsCounterQuery = $db->query('SELECT * FROM news');
        $newsCounter = array();
        $ii = 0;
        while($row = $newsCounterQuery->fetch()){
            $newsCounter[$ii]['id'] = $row['id'];
            $ii++;
        }
        $total = ceil($ii/5);

        return $total;
    }

}