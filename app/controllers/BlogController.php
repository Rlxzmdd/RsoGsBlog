<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/6
 * Time: 9:44
 */
namespace app\controllers;

use app\classes\itemClass;
use app\classes\userClass;
use app\models\UserModel;
use app\utils\addressUtils;
use app\utils\printUtils;
use app\utils\sessionUtils;
use app\utils\textUtils;
use app\utils\timeUtils;
use rsogsphp\base\Controller;
use app\models\BlogModel;

class BlogController extends Controller
{
	// 首页方法，测试框架自定义DB查询
	public function index($id)
	{
		if(!isset($id[0])){
			$id[0] = 1;
		}
		sessionUtils::start();
		$shortArticle = "";

		$num = $id[0];
		if ((!is_numeric($num))|| $num < 0) {
			$num = 1;
		}
		$numbs = (new BlogModel())->getCount();
		if (($num - 1) * 5 > $numbs) {
			//printUtils::printError();
			//return;
			$num = 1;
		}
		(new BlogModel())->addPageVisits('index:'.$num);
		$arr = (new BlogModel())->where(['`index` = 1'])->order(['id desc LIMIT '.(($num - 1) * 5) .',5'])->fetchAll();
		$pages = "";
		$this->assign('title', 'Rlxzmdd\'s | Blog');
		$this->renderTop();
		$this->renderHeader();
		foreach ($arr as $key=>$value){
			$tags =  $value['tags'];
			$tagsarray = explode("、",$tags);
			$tagstxt ="";
			foreach ($tagsarray as $a){
				$tagstxt = $tagstxt. '<a href="/blog/tags/'.$a.'" class="am-badge am-badge-primary  am-round" style="color: #1E88E5;background-color: #FFFFFF;border: solid 1px #1E88E5 ;float: left;">' .$a.'</a>';
			}
			$p = new itemClass($value['id'], $value['title'], $value['content'], $value['time'], $value['author'],$value['tags'],$value['index']);
			$this->assign('id', $p->getId());
			$this->assign('title',$p->getTitle());
			$this->assign('content', textUtils::subChinaStr($p->getContent()) . '......');
			$this->assign('time', $p->getTime());
			$this->assign('author', $p->getAuthor());
			$this->assign('tagstxt',$tagstxt);
			$this->assign('visits', $p->getVisits());
			$this->assign('likes', $p->getLikes());
			$this->assign('index', $p->getVisits());
			$pages = $pages.$this->renderLayout("shortArticle");
			//$pages=$pages. printUtils::initItem($p);
		}
		$this->assign('title', 'Rlxzmdd\'s | Blog');
		$this->assign('pages', $pages);
		$this->assign('skip', printUtils::printSkip($num,$numbs));
		$this->renderView();
		$this->renderFooter();
	}
	public function article($id){
		sessionUtils::start();
		if (!isset($id[0])|| (!is_numeric($id[0]))|| $id[0] < 0) {
			printUtils::printError();
			exit;
		}
		$item = (new BlogModel())->getItem($id[0]);
		if(!($item instanceof itemClass)){
			printUtils::printError();
			exit;
		}
		if($item->getIndex() == -1){
			printUtils::printError();
			exit;
		}
		$tags = $item->getTags();
		$tagsarray = explode("、",$tags);
		$tagstxt ="";
		foreach ($tagsarray as $a){
			$tagstxt = $tagstxt.'<a href="/blog/tags/'.$a.'" class="am-badge am-badge-primary  am-round" style="color: #1E88E5;background-color: #FFFFFF;border: solid 1px #1E88E5 ;float: left">' .$a.'</a>';
		}
		(new BlogModel())->addPageVisits('article:'.$item->getId());
		$this->assign('title', $item->getTitle());
		$this->assign('author',$item->getAuthor() );
		$this->assign('time',$item->getTime() );
		$this->assign('visits', $item->getVisits());
		$this->assign('likes', $item->getLikes());
		$this->assign('tags',$tagstxt);
		$this->assign('content',$item->getContent() );
		$this->render();
	}

	public function login($id){
		sessionUtils::start();
		$ip = addressUtils::getAdress();
		$username = "";
		$password = "";
		$needAlert=false;
		if(!isset($id[0])){
			$id[0] = "login";
		}
		if($id[0] == 'logout'){
			(new BlogModel())->addPageVisits('logout:');
			sessionUtils::remove($ip);
			header("Location: /blog/index");
			exit;
		}
		(new BlogModel())->addPageVisits('login:');
		if(array_key_exists('user',$_POST) && array_key_exists('password',$_POST)){
			$username = ($_POST['user']);
			$password = ($_POST['password']);
			$user = new userClass($ip,-1,$username,$password);
			if((new UserModel($user))->canLogin()){
				header("Location:  /blog/index");
				exit;
			}else{
				$needAlert=true;
				$this->assign('title','登陆失败' );
				$this->assign('needAlert',$needAlert);
				$this->render();
			}
		}else{
			$user = new userClass($ip);
			if(!(new UserModel($user))->isLoginInTime()){
				//不能自动登陆，无任何操作。
				$this->assign('title','请登陆' );
				$this->assign('needAlert',$needAlert);
				$this->render();
			}else{
				if($user->getId()!== -1){
					header("Location: /blog/index");
					exit;
				}
			}
		}
	}
	public function tags($id){
		sessionUtils::start();
		if(!isset($id[0])){
			$tag = "笔记";
		}else{
			$tag = textUtils::filterPageText(urldecode($id[0]));
		}
		if(!isset($id[1])){
			$num = 1;
		}else{
			$num = $id[1];
		}
		if ((!is_numeric($num))|| $num < 0) {
			$num = 1;
		}
		$numbs = (new BlogModel())->getTagsCount($tag);
		if($numbs == 0){
			printUtils::printError();
			exit;
		}
		if (($num - 1) * 5 > $numbs) {
			//printUtils::printError();
			//return;
			$num = 1;
		}
		(new BlogModel())->addPageVisits('tags:'.$tag.':'.$num);
		$arr = (new BlogModel())->where(['tags like \'%'.$tag.'%\' ','AND `index` != -1'])->order(['id desc LIMIT '.(($num - 1) * 5) .',5'])->fetchAll();
		$pages = "";
		$this->assign('title', 'Rlxzmdd\'s | Blog');
		$this->renderTop();
		$this->renderHeader();
		foreach ($arr as $key=>$value){
			$tags =  $value['tags'];
			$tagsarray = explode("、",$tags);
			$tagstxt ="";
			foreach ($tagsarray as $a){
				$tagstxt = $tagstxt. '<a href="/blog/tags/'.$a.'" class="am-badge am-badge-primary  am-round" style="color: #1E88E5;background-color: #FFFFFF;border: solid 1px #1E88E5 ;float: left;">' .$a.'</a>';
			}
			$p = new itemClass($value['id'], $value['title'], $value['content'], $value['time'], $value['author'],$value['tags'],$value['index']);
			$this->assign('id', $p->getId());
			$this->assign('title',$p->getTitle());
			$this->assign('content', textUtils::subChinaStr($p->getContent()) . '......');
			$this->assign('time', $p->getTime());
			$this->assign('author', $p->getAuthor());
			$this->assign('tagstxt',$tagstxt);
			$this->assign('visits', $p->getVisits());
			$this->assign('likes', $p->getLikes());
			$this->assign('index', $p->getVisits());
			$pages = $pages.$this->renderLayout("shortArticle");
			//$pages=$pages. printUtils::initItem($p);
		}
		$this->assign('title', 'Rlxzmdd\'s | Blog');
		$this->assign('pages', $pages);
		$this->assign('skip', printUtils::printTagsSkip($num,$numbs,$tag));
		$this->renderView();
		$this->renderFooter();
	}


	public function elses($param = array())
	{
		print_r($param);
		printUtils::printError();
		//print_r(sessionUtils::get(addressUtils::getAdress()));
	}
}