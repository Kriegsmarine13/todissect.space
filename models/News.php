<?php


class News {

    public static function getNewsItemByLink($link)
    {

        if($link) {
            //request to Database
            $db = Db::getConnection();

            $result = $db->prepare('SELECT * from news WHERE link= ?');
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

        $newsList = array();

        $result = $db->query('SELECT id, title, link, img, s_descr, f_descr, timestamp '
            . 'FROM news '
            . 'ORDER BY timestamp DESC '
            . 'LIMIT 5');

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

}