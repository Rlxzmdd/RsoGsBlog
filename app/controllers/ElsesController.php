<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/8
 * Time: 18:24
 */
namespace app\controllers;

use app\utils\printUtils;
use rsogsphp\base\Controller;

class ElsesController extends Controller
{
	// 所有错误的controllers，active都会汇集到这里
	//$param 里必然会有actionName
	public function elses($param = array())
	{
		print_r($param);
		printUtils::printError();
		//print_r(sessionUtils::get(addressUtils::getAdress()));
	}
}