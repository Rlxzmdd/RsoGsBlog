<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/6
 * Time: 9:44
 */
namespace app\controllers;

use app\classes\articleClass;
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
        $user = new userClass($ip);
        if (!(new UserModel($user))->isLoginInTime()) {
            header("Location: /blog/index");
            (new BlogModel())->addArticleVisits('admin:article:');
        } else {
            if ($user->getPermission() != 2) {
                header("Location: /blog/index");
                (new BlogModel())->addArticleVisits('admin:article:');
            }
        }
        if (!isset($id[0])) {
            $id[0] = 1;
        }
        $num = $id[0];
        if ((!is_numeric($num)) || $num < 0) {
            $num = 1;
        }
        $numbs = (new BlogModel())->getCount();
        if (($num - 1) * 15 > $numbs) {
            $num = 1;
        }
        (new BlogModel())->addArticleVisits('admin:article:' . $num);
        $arr = (new BlogModel())->where(['`index` != -1'])->order(['id desc LIMIT ' . (($num - 1) * 15) . ',15'])->fetchAll();
        $pages = "";
        $this->assign('title', 'Rlxzmdd\'s | Blog');
        $this->renderTop();
        $this->renderHeader();
        foreach ($arr as $key => $value) {
            $tags = $value['tags'];
            $tagsarray = explode("、", $tags);
            $tagstxt = "";
            foreach ($tagsarray as $a) {
                $tagstxt = $tagstxt . '<a href="/blog/tags/' . $a . '" class="am-badge am-badge-primary  am-round" style="color: #1E88E5;background-color: #FFFFFF;border: solid 1px #1E88E5 ;float: left;">' . $a . '</a>';
            }
            $p = new articleClass($value['id'], $value['title'], $value['content'], $value['time'], $value['author'], $value['tags'], $value['index'], (new BlogModel())->getArticleLikes($value['id']), (new BlogModel())->getArticleVisits($value['id']));
            $this->assign('id', $p->getId());
            $this->assign('title', $p->getTitle());
            $this->assign('time', $p->getTime());
            $this->assign('author', $p->getAuthor());
            $this->assign('tags', $tagstxt);
            $this->assign('visits', $p->getVisits());
            $this->assign('likes', $p->getLikes());
            $this->assign('addVisits', current((new BlogModel())->getArticleTodayVisits($p->getId())));
            $this->assign('addLikes', current((new BlogModel())->getArticleTodayLikes($p->getId())));
            $this->assign('status', textUtils::getStatusWithIndex($p->getIndex()));
            $pages = $pages . $this->renderLayout("shortArticle");
            //$pages=$pages. printUtils::initItem($p);
        }
        $this->assign('pages', $pages);
        $this->assign('skip', printUtils::printAdminArticleSkip($num, $numbs));
        $this->assign('title', 'Rlxzmdd\'s | Blog');
        $this->renderView();
        $this->renderFooter();
    }

    public function addArticle()
    {
        sessionUtils::start();
        $ip = addressUtils::getAdress();
        $needAlert = false;
        $user = new userClass($ip);
        (new BlogModel())->addArticleVisits('admin:addArticle');
        if (!(new UserModel($user))->isLoginInTime()) {
            header("Location: /blog/index");
        } else {
            if ($user->getPermission() != 2) {
                header("Location: /blog/index");
            }
        }
        if (isset($_POST['editor_title']) && isset($_POST['editor_text']) && isset($_POST['editor_tags'])) {
            (new BlogModel())->addArticle(new articleClass("", textUtils::filterPageText($_POST['editor_title']), ($_POST['editor_text']), timeUtils::getTime(), $user->getUser(), textUtils::filterPageText($_POST['editor_tags']), 1));
            $needAlert = true;
        }
        $this->assign('title', "编写文章");
        $this->assign('needAlert', $needAlert);
        $this->render();
    }
    public function editArticle($id)
    {
        sessionUtils::start();
        $ip = addressUtils::getAdress();
        $needAlert = false;
        $user = new userClass($ip);
        (new BlogModel())->addArticleVisits('admin:editArticle');
        if (!(new UserModel($user))->isLoginInTime()) {
            header("Location: /blog/index");
        } else {
            if ($user->getPermission() != 2) {
                header("Location: /blog/index");
            }
        }
        if (!(isset($id[0]) && is_numeric($id[0]))) {
            header("Location: /admin/article");
        }
        if (isset($_POST['editor_title']) && isset($_POST['editor_text']) && isset($_POST['editor_tags'])) {
            print_r((new BlogModel())->updateArticle(new articleClass($id['id'], textUtils::filterPageText($_POST['editor_title']), ($_POST['editor_text']), timeUtils::getTime(), $user->getUser(), textUtils::filterPageText($_POST['editor_tags']))));
            $needAlert = true;
        }
        $article = (new BlogModel())->getArticle($id[0]);
        $this->assign('title', $article->getTitle());
        $this->assign('content', $article->getContent());
        $this->assign('id', $article->getId());
        $this->assign('tags', $article->getTags());
        $this->assign('needAlert', $needAlert);
        $this->render();
    }

    public function delArticle($keys)
    {
        if (!isset($keys[0])) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        if ((!is_numeric($keys[0])) || $keys[0] <= 0) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        $id = $keys[0];
        sessionUtils::start();
        $ip = addressUtils::getAdress();
        $user = new userClass($ip);
        (new BlogModel())->addArticleVisits('admin:delArticle:' . $id);
        if (!(new UserModel($user))->isLoginInTime()) {
            echo '{"id":"' . $id . '","status": -1,"message": "无权限"}';
            return false;
        } else {
            if ($user->getPermission() != 2) {
                echo '{"id":"' . $id . '",{"status": -1,"message": "无权限"}';
                return false;
            }
        }
        $arr = (new BlogModel())->where(['id = ' . $id]);
        if ($arr->update(['index' => '-1']) == 1) {
            echo '{"id":"' . $id . '","status": 1,"message": "操作成功"}';
            return true;
        } else {
            echo '{"id":"' . $id . '","status": 0,"message": "操作失败"}';
            return false;
        }
    }

    public function hideArticle($keys)
    {
        if (!isset($keys[0])) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        if ((!is_numeric($keys[0])) || $keys[0] <= 0) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        $id = $keys[0];
        sessionUtils::start();
        $ip = addressUtils::getAdress();
        $user = new userClass($ip);
        (new BlogModel())->addArticleVisits('admin:hideArticle:' . $id);
        if (!(new UserModel($user))->isLoginInTime()) {
            echo '{"id":"' . $id . '","status": -1,"message": "无权限"}';
            return false;
        } else {
            if ($user->getPermission() != 2) {
                echo '{"id":"' . $id . '","tatus": -1},"message": "无权限"';
                return false;
            }
        }
        $arr = (new BlogModel())->where(['id = ' . $id]);
        if ($arr->update(['index' => '0']) == 1) {
            echo '{"id":"' . $id . '","status": 1,"message": "操作成功"}';
            return true;
        } else {
            echo '{"id":"' . $id . '","status": 0,"message": "操作失败"}';
            return false;
        }
    }

    public function reArticle($keys)
    {
        if (!isset($keys[0])) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        if ((!is_numeric($keys[0])) || $keys[0] <= 0) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        $id = $keys[0];
        sessionUtils::start();
        $ip = addressUtils::getAdress();
        $user = new userClass($ip);
        (new BlogModel())->addArticleVisits('admin:reArticle:' . $id);
        if (!(new UserModel($user))->isLoginInTime()) {
            echo '{"id":"' . $id . '","status": -1,"message": "无权限"}';
            return false;
        } else {
            if ($user->getPermission() != 2) {
                echo '{"id":"' . $id . '","tatus": -1},"message": "无权限"';
                return false;
            }
        }
        $arr = (new BlogModel())->where(['id = ' . $id]);
        if ($arr->update(['index' => '1']) == 1) {
            echo '{"id":"' . $id . '","status": 1,"message": "操作成功"}';
            return true;
        } else {
            echo '{"id":"' . $id . '","status": 0,"message": "操作失败"}';
            return false;
        }
    }

    public function likeArticle($keys)
    {
        if (!isset($keys[0])) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        if ((!is_numeric($keys[0])) || $keys[0] <= 0) {
            echo '{"id":"-1","status": -1,"message": "无权限"}';
            return false;
        }
        $id = $keys[0];
        sessionUtils::start();
        if (!(new BlogModel())->canAddArticleLikes($id)) {
            echo '{"id":"' . $id . '","status": 2,"message": "今天已点过了"}';
            return false;
        }
        $sth = (new BlogModel())->addArticleLikes('article:' . $id);
        echo '{"id":"' . $id . '","status": 1,"message": "操作成功"}';
        return true;
    }
    public function elses($param = array())
    {
        print_r($param);
        printUtils::printError();
        //print_r(sessionUtils::get(addressUtils::getAdress()));
    }
}