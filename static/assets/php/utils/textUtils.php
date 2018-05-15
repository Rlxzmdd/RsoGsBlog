<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/24
 * Time: 19:48
 */
class textUtils{
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
}