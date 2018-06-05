<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/6
 * Time: 9:45
 */
namespace app\models;

use app\classes\articleClass;
use app\utils\addressUtils;
use app\utils\printUtils;
use rsogsphp\base\Model;
use rsogsphp\db\Db;

class BlogModel extends Model
{
    protected $table = 'blogats';

    public function getCount()
    {
        $sql = 'select count(id) from `' . $this->table . '` where `index` != -1';
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        return $sth->fetchAll()[0]['count(id)'];
    }
    public function getTagsCount($tags)
    {
        $sql = 'select count(id) from `' . $this->table . '` where tags like \'%' . $tags . '%\' AND `index` != -1';
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        return $sth->fetchAll()[0]['count(id)'];
    }

    /**
     * 返回一个文章的实例
     * @param int $id
     * @return articleClass
     */
    function getArticle($id = 1)
    {
        $sql = 'SELECT * FROM `' . $this->table . '` where id=' . $id;
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        $value = $sth->fetchAll();
        if (isset($value[0])) {
            $value = $value[0];
            $p = new articleClass($value['id'], $value['title'], $value['content'], $value['time'], $value['author'], $value['tags'], $value['index'], (new BlogModel())->getArticleLikes($value['id']), (new BlogModel())->getArticleVisits($value['id']));
        } else {
            $p = new articleClass(-1, 'error', 'error', 'error', 'error', 'error', 'error', 'error', 'error');
        }
        return $p;
    }

    public function addArticle(articleClass $i)
    {
        return $this->add(['id' => NULL, 'title' => $i->getTitle(), 'content' => $i->getContent(), 'time' => $i->getTime(), 'author' => $i->getAuthor(), 'tags' => $i->getTags(), 'index' => $i->getIndex()]);
    }

    public function updateArticle(articleClass $a)
    {
        return $this->where(['id' => $a->getId()])->update(['title' => $a->getTitle(), 'content' => $a->getContent(), 'time' => $a->getTime(), 'tags' => $a->getTags()]);
    }

    function getArticleVisits($id)
    {
        $sql = "select count(distinct address, dateDay) from visits WHERE `visit` LIKE 'article:" . $id . "'";
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        return ($sth->fetchAll()[0]['count(distinct address, dateDay)']);
    }
    function getArticleTodayVisits($id)
    {
        $sql = "SELECT ((
SELECT COUNT( DISTINCT address, dateDay ) 
FROM visits
WHERE  `visit` LIKE  'article:" . $id . "'
AND  `dateDay`
) - ( 
SELECT COUNT( DISTINCT address, dateDay ) 
FROM visits
WHERE  `visit` LIKE  'article:" . $id . "'
AND  `dateDay` != CURDATE( ) )
)";
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        $arr = $sth->fetchAll();
        if (!isset($arr[0])) {
            return [0];
        }
        return ($arr[0]);
    }
    function addArticleVisits($id)
    {
        $sql = "INSERT INTO `visits` 
(`id`, `address`, `visit`, `dateDay`, `dateTime`)
 VALUES 
(NULL, '" . addressUtils::getAdress() . "','" . $id . "',CURDATE(),CURTIME());";
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        $sth->fetchAll();
    }

    function getArticleLikes($id)
    {
        $sql = "select count(distinct address, dateDay) from likes WHERE `like` LIKE 'article:" . $id . "'";
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();

        $arr = $sth->fetchAll();
        if (!isset($arr[0]['count(distinct address, dateDay)'])) {
            return 0;
        }
        return ($arr[0]['count(distinct address, dateDay)']);
    }
    function getArticleTodayLikes($id)
    {
        $sql = "SELECT ((
SELECT COUNT( DISTINCT address, dateDay ) 
FROM likes
WHERE  `like` LIKE  'article:" . $id . "'
AND  `dateDay`
) - ( 
SELECT COUNT( DISTINCT address, dateDay ) 
FROM likes
WHERE  `like` LIKE  'article:" . $id . "'
AND  `dateDay` != CURDATE( ) )
)";$sth = Db::pdo()->prepare($sql);
        $sth->execute();

        $arr = $sth->fetchAll();
        if (!isset($arr[0])) {
            return [0];
        }
        return ($arr[0]);
    }
    function addArticleLikes($id)
    {
        $sql = "INSERT INTO `likes` 
(`id`, `address`, `like`, `dateDay`, `dateTime`)
 VALUES 
(NULL, '" . addressUtils::getAdress() . "','" . $id . "',CURDATE(),CURTIME());";
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        return $sth->fetchAll();
    }

    /**
     * 检测能否likes
     * 检测逻辑：
     *  直接判断表里今天内是否点击过
     *
     * true 可以添加，false不可以
     * @param $id int
     * @return bool
     */
    function canAddArticleLikes($id)
    {
        $sql = "
SELECT COUNT( DISTINCT address, dateDay ) FROM likes WHERE (`like` LIKE 'article:$id') AND (`dateDay` like CURDATE()) And (`address` like '" . addressUtils::getAdress() . "')";
        $sth = Db::pdo()->prepare($sql);
        $sth->execute();
        $arr = $sth->fetchAll();
        $count = ($arr[0]['COUNT( DISTINCT address, dateDay )']);
        return ($count != 1);
    }
}