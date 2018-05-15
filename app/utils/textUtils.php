<?php
namespace app\utils;
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/24
 * Time: 19:48
 */
class textUtils{
	static $status = [-1=>'隐藏删除',0=>'主页隐藏',1=>'正常显示',2=>'置顶中'];
	static function getStatusWithIndex($index){
		return isset(textUtils::$status[$index])?textUtils::$status[$index]:"未知:".$index;
	}
	static function filterText($text){
		$a = htmlentities($text,ENT_QUOTES);
		$b = htmlspecialchars($a,ENT_QUOTES,"UTF-8");
		return $b;
	}
	static function filterPageText($text){
		$a = str_replace("'",'&quot;',$text);
		$a = str_replace('"','&#39;',$a);
		return $a;
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
}