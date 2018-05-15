<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/6
 * Time: 9:45
 */
namespace app\models;
use app\classes\itemClass;
use app\utils\addressUtils;
use app\utils\printUtils;
use rsogsphp\base\Model;
use rsogsphp\db\Db;

class BlogModel extends Model
{
	protected $table = 'blogats';

	public function getCount()
	{
		$sql = 'select count(id) from `'.$this->table.'` where `index` != -1';
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();
		return $sth->fetchAll()[0]['count(id)'];
	}
	public function getTagsCount($tags)
	{
		$sql = 'select count(id) from `'.$this->table.'` where tags like \'%'.$tags.'%\' AND `index` != -1';
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();
		return $sth->fetchAll()[0]['count(id)'];
	}
	/**
	 * @param int $id
	 * @return itemClass
	 */
	function getItem($id = 1)
	{
		$sql = 'SELECT * FROM `'.$this->table.'` where id=' . $id;
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();
		$value = $sth->fetchAll();
		if (isset($value[0])) {
			$value = $value[0];
			$p = new itemClass($value['id'], $value['title'], $value['content'], $value['time'], $value['author'],$value['tags'],$value['index']);
			return $p;
		} else {
			printUtils::printError();
		}
	}
	function getPageVisits($page){
		$sql = "select count(distinct address, dateDay) from visits WHERE `visit` LIKE '".$page."'";
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();
		return($sth->fetchAll()[0]['count(distinct address, dateDay)']);
	}
	function getPageTodayVisits($page){
		$sql = "SELECT ((
SELECT COUNT( DISTINCT address, dateDay ) 
FROM visits
WHERE  `visit` LIKE  '".$page."'
AND  `dateDay`
) - ( 
SELECT COUNT( DISTINCT address, dateDay ) 
FROM visits
WHERE  `visit` LIKE  '".$page."'
AND  `dateDay` != CURDATE( ) )
)";
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();
		$arr = $sth->fetchAll();
		if(!isset($arr[0])){
			return [0];
		}
		return($arr[0]);
	}
	function getPageLikes($page){
		$sql = "select count(distinct address, dateDay) from likes WHERE `like` LIKE '".$page."'";
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();

		$arr = $sth->fetchAll();
		if(!isset($arr[0]['count(distinct address, dateDay)'])){
			return 0;
		}
		return($arr[0]['count(distinct address, dateDay)']);
	}
	function getPageTodayLikes($page){
		$sql = "SELECT ((
SELECT COUNT( DISTINCT address, dateDay ) 
FROM likes
WHERE  `like` LIKE  '".$page."'
AND  `dateDay`
) - ( 
SELECT COUNT( DISTINCT address, dateDay ) 
FROM likes
WHERE  `like` LIKE  '".$page."'
AND  `dateDay` != CURDATE( ) )
)";$sth = Db::pdo()->prepare($sql);
		$sth->execute();

		$arr = $sth->fetchAll();
		if(!isset($arr[0])){
			return [0];
		}
		return($arr[0]);
	}
	function addPageVisits($page){
		$sql = "INSERT INTO `visits` 
(`id`, `address`, `visit`, `dateDay`, `dateTime`)
 VALUES 
(NULL, '".addressUtils::getAdress()."','".$page."',CURDATE(),CURTIME());";
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();
		$sth->fetchAll();
	}
	function addPageLikes($page){
		$sql = "INSERT INTO `likes` 
(`id`, `address`, `visit`, `dateDay`, `dateTime`)
 VALUES 
(NULL, '".addressUtils::getAdress()."','".$page."',CURDATE(),CURTIME());";
		$sth = Db::pdo()->prepare($sql);
		$sth->execute();
		$sth->fetchAll();
	}
	public function addOne(itemClass $i)
	{
		return $this->add(['id'=>NULL,'title'=>$i->getTitle(),'content'=>$i->getContent(),'time'=>$i->getTime(),'author'=>$i->getAuthor(),'tags'=>$i->getTags(),'index'=>$i->getIndex()]);
	}
}