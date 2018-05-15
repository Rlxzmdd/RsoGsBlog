<?php

/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/7
 * Time: 12:54
 */
class printUtils
{
	/**
	 *  打印首页全部item
	 */
	static function printIndexItems(sqlUtils $s)
	{
		$num = 1;
		/** @deprecated 总共博客数 */
		$numbs = 0;
		if (array_key_exists("num", $_GET)) {
			if ($_GET['num'] > 1 && is_numeric($_GET['num'])) {
				$num = $_GET['num'];
			}
		}
		$a = $s;
		$a->connect();
		$a->setDB($_ENV['MYSQL_DBNAME']);
		$numbs = $a->query("select count(id) from blogats")->fetch_array()[0];
		if (($num - 1) * 5 > $numbs) {
			printUtils::printError();
			return;
		}
		$result = $a->query('SELECT * FROM `blogats` order by id desc LIMIT ' . (($num - 1) * 5) . ',5 ');
		while ($row = $result->fetch_array()) {
			$p = new itemClass($row[0], $row[1], $row[2], $row[3], $row[4],$row[5]);
			printUtils::initItem($p);
		}
		printUtils::printPages($num, $numbs);
		$a->close();
	}

	/**
	 * 打印page页面
	 */
	static function printPage($id,sqlUtils $s)
	{
		/** @deprecated 当前页 */
		$num = 1;
		/** @deprecated 总共博客数 */
		$nums = 0;
		if (array_key_exists("num", $_GET)) {
			if ($_GET['num'] > 1 && is_numeric($_GET['num'])) {
				$num = $_GET['num'];
			}
		}
		$a = $s;
		$a->connect();
		$result = $a->query('SELECT * FROM `blogats` where id=' . $id);
		$row = $result->fetch_array();
		if ($row) {
			$p = new itemClass($row[0], $row[1], $row[2], $row[3], $row[4],$row[5]);
			printUtils::initAllItem($p);
		} else {
			printUtils::printError();
		}
		$a->close();
	}

	static function printError()
	{
		print_r('<script>window.location.href="404.html";</script>');
	}

	/**
	 * 打印全部item
	 * @param itemClass $item
	 */
	static function initAllItem(itemClass $item)
	{
		$tags = $item->getTags();
		$tagsarray = explode("、",$tags);
		$tagstxt ="";
		foreach ($tagsarray as $a){
			$tagstxt = $tagstxt.'<a class="am-badge am-badge-primary  am-round" style="color: #FFF;">'.$a.'</a>';
		}
		print_r(
			'
    <article class="blog-main">
      <h3 class="am-article-title">
        <a>' . $item->getTitle() . '</a>
      </h3>
      <h4 class="am-article-meta blog-meta">由 <a href="">' . $item->getAuthor() . '</a> 于 ' . $item->getTime() . '</a>
      '.$tagstxt.'
      </h4>
      <div class="am-g blog-content">
        <div class="am-u-lg-12">
        ' . $item->getText() . '
        </div>
      </div>
    </article>
'
		);
	}

	/**
	 * 打印首页单个item
	 * @param itemClass $item
	 */
	static function initItem(itemClass $item)
	{
		$tags = $item->getTags();
		$tagsarray = explode("、",$tags);
		$tagstxt ="";
		foreach ($tagsarray as $a){
			$tagstxt = $tagstxt.'<a class="am-badge am-badge-primary  am-round" style="color: #FFF;">'.$a.'</a>';
		}
		print_r(
			'
    <article class="blog-main" onclick=\'window.location.href="article.php?id=' . $item->getId() . '"\'>
      <h3 class="am-article-title">
        <a>' . $item->getTitle() . '</a>
      </h3>
      <h4 class="am-article-meta blog-meta">由 <a href="">' . $item->getAuthor() . '</a> 于 ' . $item->getTime() . '</a> 
       '.$tagstxt.'
      </h4>
      <div class="am-g blog-content">
        <div class="am-u-lg-12"">
        <pre>' . printUtils::subChinaStr($item->getText()) . '......</pre>
        </div>
      </div>
    </article>
    <hr class="am-article-divider blog-hr">
'
		);
	}

	static function printPages($pages, $nums)
	{
		print_r('<ul class="am-pagination blog-pagination">');
		if ($nums <= 5 && $nums >= 1) {
			print_r('</ul>');
			return;
		}
		if ($pages * 5 < $nums) {
			print_r('<li class="am-pagination-next"><a href="index.php?num=' . ($pages + 1) . '">下一页&raquo;</a></li>');
			print_r('</ul>');
			return;
		} elseif ($pages * 5 >= $nums) {
			print_r('<li class="am-pagination-prev"><a href="index.php?num=' . ($pages - 1) . '">&laquo; 上一页</a></li>');
			print_r('</ul>');
			return;
		} else {
		print_r('<li class="am-pagination-prev"><a href="index.php?num=' . ($pages - 1) . '">&laquo; 上一页</a></li>');
		print_r('<li class="am-pagination-next"><a href="index.php?num=' . ($pages + 1) . '">下一页&raquo;</a></li>');
		print_r('</ul>');
		return;
	}
	}

	/**
	 * 打印菜单
	 * @param string $page
	 * @param sqlUtils $s
	 */
	static function printMenu($page = "",sqlUtils $s)
	{
		$userSession = new userClass(addressUtils::getAdress());
		$userSession->cons($s);
		$isLogin = $userSession->isLoginInTime();
		if(!$isLogin){
			$user = '
      <div class="am-topbar-left am-form-inline am-topbar-right">
          <ul class="am-nav am-nav-pills am-topbar-nav">
              <li class="am-dropdown" data-am-dropdown>
                  <a href="login.php">
                      登录
                  </a>
              </li>
          </ul>
      </div>
';
		}else{
			$userSession->updateInfoById();
			if($userSession->getPermission() == "2"){
				$user = '
      <div class="am-topbar-left am-form-inline am-topbar-right">
          <ul class="am-nav am-nav-pills am-topbar-nav">
              <li class="am-dropdown" data-am-dropdown>
                  <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                      '.$userSession->getUser().' <span class="am-icon-caret-down"></span>
                  </a>
                  <ul class="am-dropdown-content">
                      <li class="am-dropdown-header">个人中心</li>
                      <li><a href="post.php">添加文章</a></li>
                      <li><a href="login.php?logout=0">注销</a></li>
                  </ul>
              </li>
          </ul>
      </div>
';
			}else {
				$user = '
      <div class="am-topbar-left am-form-inline am-topbar-right">
          <ul class="am-nav am-nav-pills am-topbar-nav">
              <li class="am-dropdown" data-am-dropdown>
                  <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                      '.$userSession->getUser().' <span class="am-icon-caret-down"></span>
                  </a>
                  <ul class="am-dropdown-content">
                      <li class="am-dropdown-header">个人中心</li>
                      <li><a href="login.php?logout=0">注销</a></li>
                  </ul>
              </li>
          </ul>
      </div>
';
			}
		}
		$index = ($page == "index") ? '<li class="am-active"><a href="index.php">首页</a></li>' : '<li><a href="index.php">首页</a></li>';
		$pages = ($page == "page") ? '<li class="am-active"><a href="index.php">博客</a></li>' : '<li><a href="index.php">博客</a></li>';
		print_r('
    <ul class="am-nav am-nav-pills am-topbar-nav">
    ' . $index . $pages . '
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          菜单 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li class="am-dropdown-header">瞧瞧你发现了什么</li>
          <li><a href="#">关于我们</a></li>
          <li><a href="#">关于网页</a></li>
            <li class="am-divider"></li>
            <li><a href="#">你说这是什么按钮</a></li>
        </ul>
      </li>
    </ul>
      ' . $user
		);
	}

	static function subChinaStr($str)
	{

		$value = substr($str, 0, 300);
		$value_length = strlen($value);
		$value_count = 0;//中文字数
		for ($i = 0; $i < $value_length; $i++) {
			if (ord($value{$i}) > 127) {
				$value_count++;
			}
		}
		if ($value_count % 3 != 0) {
			if (($value_count - 2) % 3 != 0) {
				$value = substr($str, 0, $value_length - 1);
				return $value;
			}
			$value = substr($str, 0, $value_length - 2);
		}
		return $value;
	}

	static function printNowTime(){
		list($msec, $sec) = explode(' ', microtime());
		$msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
		print_r('<p>'.$msectime.'<p>');
	}
}