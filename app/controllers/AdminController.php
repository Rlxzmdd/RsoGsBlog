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

class AdminController extends Controller
{
	// 首页方法，测试框架自定义DB查询
	/*public function index($id)
	{
		$this->renderTop();
		$this->renderHeader();
		$this->renderView();
		$this->renderFooter();
	}*/
	public function article($id)
	{
		sessionUtils::start();
		$ip = addressUtils::getAdress();
		$needAlert=false;
		$user = new userClass($ip);
		if(!(new UserModel($user))->isLoginInTime()){
			header("Location: /blog/index");
			(new BlogModel())->addPageVisits('admin:article:');
		}else{
			if($user->getPermission() !=2){
				header("Location: /blog/index");
				(new BlogModel())->addPageVisits('admin:article:');
			}
		}
		if(!isset($id[0])){
			$id[0] = 1;
		}
		$num = $id[0];
		if ((!is_numeric($num))|| $num < 0) {
			$num = 1;
		}
		$numbs = (new BlogModel())->getCount();
		if (($num - 1) * 15 > $numbs) {
			$num = 1;
		}
		(new BlogModel())->addPageVisits('admin:article:'.$num);
		$arr = (new BlogModel())->order(['id desc LIMIT '.(($num - 1) * 15) .',15'])->fetchAll();
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
			$this->assign('time', $p->getTime());
			$this->assign('author', $p->getAuthor());
			$this->assign('tags',$tagstxt);
			$this->assign('visits', $p->getVisits());
			$this->assign('likes', $p->getLikes());
			$this->assign('addVisits', current((new BlogModel())->getPageTodayVisits('article:'.$p->getId())));
			$this->assign('addLikes', current((new BlogModel())->getPageTodayLikes('article:'.$p->getId())));
			$this->assign('status', textUtils::getStatusWithIndex($p->getIndex()));
			$pages = $pages.$this->renderLayout("shortArticle");
			//$pages=$pages. printUtils::initItem($p);
		}
		$this->assign('pages', $pages);
		$this->assign('skip', printUtils::printAdminArticleSkip($num,$numbs));
		$this->assign('title', 'Rlxzmdd\'s | Blog');
		$this->renderView();
		$this->renderFooter();
	}
	public function addArticle(){
		sessionUtils::start();
		$ip = addressUtils::getAdress();
		$needAlert=false;
		$user = new userClass($ip);
		(new BlogModel())->addPageVisits('admin:addArticle');
		if(!(new UserModel($user))->isLoginInTime()){
			header("Location: /blog/index");
		}else{
			if($user->getPermission() !=2){
				header("Location: /blog/index");
			}
		}
		if(isset($_POST['editor_title']) && isset($_POST['editor_text']) && isset($_POST['editor_tags'])){
			(new BlogModel())->addOne(new itemClass("",textUtils::filterPageText($_POST['editor_title']),textUtils::filterPageText($_POST['editor_text']),timeUtils::getTime(),$user->getUser(),textUtils::filterPageText($_POST['editor_tags']),1));
			$needAlert = true;
		}
		$this->assign('title',"编写文章");
		$this->assign('needAlert',$needAlert);
		$this->render();
	}
	public function delArticle($keys){
		sessionUtils::start();
		$ip = addressUtils::getAdress();
		$user = new userClass($ip);
		(new BlogModel())->addPageVisits('post:');
		if(!(new UserModel($user))->isLoginInTime()){
			echo '{status: 0}';
		}else{
			if($user->getPermission() !=2){
				echo '{status: 0}';
			}
		}
		$arr = (new BlogModel())->where(['id = '.$keys[0]]);
		if($arr->update(['index'=>'-1' ]) == 1){
			echo '{status: 1}';
		}else{
			echo '{status: 0}';
		}
	}
	public function elses($param = array())
	{
		print_r($param);
		printUtils::printError();
		//print_r(sessionUtils::get(addressUtils::getAdress()));
	}
}