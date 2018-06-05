<?php

namespace app\utils;

/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/6
 * Time: 12:08
 */
use app\classes\userClass;
use app\models\UserModel;

class printUtils{
	static function printError()
	{
		include ('404.html');
		exit;
	}
	static function printSkip($pages, $nums)
	{
        $skip = '';
        if ($nums <= 5 && $nums >= 1) {
			return $skip;
		}
		if ($pages * 5 <= 5) {
            $skip = $skip . ('<li class="rs-pagination-next"><a href="/blog/index/' . ($pages + 1) . '">下一页&raquo;</a></li>');
			return $skip;
		} elseif ($pages * 5 >= $nums) {
            $skip = $skip . ('<li class="rs-pagination-prev"><a href="/blog/index/' . ($pages - 1) . '">&laquo; 上一页</a></li>');
			return $skip;
		} else {
            $skip = $skip . ('<li class="rs-pagination-prev"><a href="/blog/index/' . ($pages - 1) . '">&laquo; 上一页</a></li>');
            $skip = $skip . ('<li class="rs-pagination-next"><a href="/blog/index/' . ($pages + 1) . '">下一页&raquo;</a></li>');
			return $skip;
		}
	}
	static function printTagsSkip($pages, $nums,$tag)
	{
        $skip = '';
		if ($nums <= 5 && $nums >= 1) {
			return $skip;
		}
		if ($pages * 5 <= 5) {
            $skip = $skip . ('<li class="rs-pagination-next"><a href="/blog/tags/' . $tag . '/' . ($pages + 1) . '">下一页&raquo;</a></li>');
			return $skip;
		} elseif ($pages * 5 >= $nums) {
            $skip = $skip . ('<li class="rs-pagination-prev"><a href="/blog/tags/' . $tag . '/' . ($pages - 1) . '">&laquo; 上一页</a></li>');
			return $skip;
		} else {
            $skip = $skip . ('<li class="rs-pagination-prev"><a href="/blog/tags/' . $tag . '/' . ($pages - 1) . '">&laquo; 上一页</a></li>');
            $skip = $skip . ('<li class="rs-pagination-next"><a href="/blog/tags/' . $tag . '/' . ($pages + 1) . '">下一页&raquo;</a></li>');
			return $skip;
		}
	}
	static function printAdminArticleSkip($pages, $nums)
	{

		$skip = ('<div class="blog-body-skip"><ul class="am-pagination blog-article-pagination">');
		if ($nums <= 15 && $nums >= 1) {
			$skip = $skip.('</ul></div>');
			return $skip;
		}
		if ($pages * 15 <= 15) {
			$skip = $skip.('<li class="am-pagination-next"><a href="/admin/article/' . ($pages + 1) . '">下一页&raquo;</a></li>');
			$skip = $skip.('</ul></div>');
			return $skip;
		} elseif ($pages * 15 >= $nums) {
			$skip = $skip.('<li class="am-pagination-prev"><a href="/admin/article/' . ($pages - 1) . '">&laquo; 上一页</a></li>');
			$skip = $skip.('</ul></div>');
			return $skip;
		} else {
			$skip = $skip.('<li class="am-pagination-prev"><a href="/admin/article/' . ($pages - 1) . '">&laquo; 上一页</a></li>');
			$skip = $skip.('<li class="am-pagination-next"><a href="/admin/article/' . ($pages + 1) . '">下一页&raquo;</a></li>');
			$skip = $skip.('</ul></div>');
			return $skip;
		}
	}
	/**
	 * 打印菜单
	 * @param string $page
	 */
	static function printMenu($page = "")
	{
	}
}