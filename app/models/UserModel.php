<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/6
 * Time: 9:45
 */
namespace app\models;
use app\classes\itemClass;
use app\classes\userClass;
use app\utils\addressUtils;
use app\utils\printUtils;
use app\utils\sessionUtils;
use app\utils\timeUtils;
use rsogsphp\base\Model;
use rsogsphp\db\Db;

class UserModel extends Model
{
	protected $table = 'users';
	/**
	 * @var userClass
	 */
	protected $user ;
	public function __construct($user ){
		$this->user = $user;
	}
	/**
	 * @return userClass
	 */
	public function getUser()
	{
		return $this->user;
	}
	/**
	 * false即为不能自动登陆。返回id，并进行登陆；
	 * @return boolean
	 */
	public function isLoginInTime(){
		if(sessionUtils::exits($this->getUser()->getIp())){
			$this->getUser()->setId(sessionUtils::get($this->getUser()->getIp())) ;
			if(!is_numeric($this->getUser()->getId())){
				return false;
			}
			$this->successAutoLogin();
			return $this->getUser()->getId();
		}else{
			return false;
		}
	}
	/**
	 * 根据已有条件查看是否满足条件
	 * @return bool
	 */
	public function canLogin(){
		return $this->samePassword();
	}
	/**
	 * 通过ID更新ip地址
	 * @return mixed
	 */
	public function updateAddressTimeById(){
		return (new UserModel($this->getUser()))->updateById('ip',addressUtils::getAdress());
	}
	/**
	 * 通过ID更新登陆时间
	 */
	public function updateLoginTimeById(){
		return (new UserModel($this->getUser()))->updateById('time',timeUtils::getTime());
	}
	/**
	 * 通过id修改数据
	 * @param $key String 键
	 * @param $value String 值
	 * @return int the number of rows.
	 */
	public function updateById($key,$value){
		return (new UserModel($this->getUser()))->where(['id = '.$this->getUser()->getId()])->update([$key=>$value]);
	}
	/**
	 * 通过用户名更新信息
	 * @return boolean
	 */
	public function updateInfo(){
		//(new UserModel($this->getUser()))
		$row = (new UserModel($this->getUser()))->where(['user LIKE \''.$this->getUser()->getUser()."'"])->fetch();
		if(!is_array($row)){
			return false;
		}
		$this->getUser()->setPermission( $row['permission']);
		$this->getUser()->setId($row['id']);
		return true;
	}
	/**
	 * 通过ID更新信息
	 * @return bool/
	 */
	public function updateInfoById(){
		$row =  (new UserModel($this->getUser()))->where(['id = '.$this->getUser()->getId()])->fetch();
		if(!is_array($row)){
			return false;
		}
		$this->getUser()->setPermission( $row['permission']);
		$this->getUser()->setUser($row['user']);
		return true;
	}
	/*
	 * 通过username查询password等信息
	 * 必须为private
	 */
	/**
	 * false或数组，false代表无数据
	 */
	private function selectByUserName(){
		$row =  (new UserModel($this->getUser()))->where(['user LIKE \''.$this->getUser()->getUser()."'"])->fetch();
		if(!$row){
			return false;
		}
		if(!isset($row['id'])){
			$row=false;
		}
		return $row;
	}
	/**
	 * 检查密码是否正确
	 * @return bool
	 */
	private function samePassword(){
		$select = $this->selectByUserName();
		if(!$select){
			return false;
		}else{
			if(md5($this->getUser()->getPassword())==$select['password']){
				$this->successLogin();
				return true;
			}else{
				return false;
			}

		}
	}
	/**
	 * 成功登陆时需要的操作
	 */
	private function successLogin(){
		$this->updateInfo();
		$this->updateLoginTimeById();
		$this->updateAddressTimeById();
		sessionUtils::loginUser($this->getUser());
	}
	/**
	 * 自动登陆时需要的操作
	 */
	private function successAutoLogin(){
		$this->updateInfoById();
		$this->updateLoginTimeById();
		$this->updateAddressTimeById();
		sessionUtils::loginUser($this->getUser());
	}
}