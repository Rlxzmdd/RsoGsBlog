<?php
namespace app\utils;
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/24
 * Time: 15:20
 */
class timeUtils{
	static function getTime(){
		date_default_timezone_set('Asia/Shanghai');
		return date('Y-m-d H:i:s');
	}
}