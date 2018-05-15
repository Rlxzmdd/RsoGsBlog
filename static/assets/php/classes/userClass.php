<?php

/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/23
 * Time: 14:05
 */

class userClass
{
	private $ip;
	private $user;
	private $password;
	private $id;
	private $permission;

	/**
	 * @var sqlUtils
	 */
	public $sqli;
	/**
	 * 类流程如下
	 * 若只输入ip（即每个页面的
	 * 即可通过方法isLoginInTime() 判断时候还可以继续登陆(该方法通过userSession查询
	 *
	 * 若输入ip，用户名，密码（即用户登陆的时候
	 * 即可通过方法canLogin()判断密码是否正确，若正确通过userSession中的set储存数据
	 *
	 */
	public function __construct($ip,$id=-1, $user = "", $password = "")
	{
		$this->id = $id;
		$this->ip = $ip;
		$this->user = textUtils::filterText($user);
		$this->password =textUtils::filterText( $password);
		$this->permission = 0;
	}
	public function cons(sqlUtils $a){
		$this->sqli = $a;
	}
	/**
	 * false即为不能自动登陆。返回id，并进行登陆；
	 * @return boolean
	 */
	public function isLoginInTime(){
		if(userSession::exits($this->ip)){
			$this->id = userSession::get($this->ip);
			if(!is_numeric($this->id)){
				return false;
			}
			$this->successAutoLogin();
			return $this->id;
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
		return $this->updateById('ip',addressUtils::getAdress());
	}
	/**
	 * 通过ID更新登陆时间
	 */
	public function updateLoginTimeById(){
		return $this->updateById('time',timeUtils::getTime());
	}
	/**
	 * 通过id修改数据
	 * @param $key String 键
	 * @param $value String 值
	 * @return mixed
	 */
	public function updateById($key,$value){
		$this->sqli->connect();
		$result = $this->sqli->query('UPDATE  `'.$this->sqli->getDBName().'`.`users` SET  `'.$key.'` =  \''.$value.'\' WHERE  `users`.`id` ='.$this->id.';');
		return $result;
	}
	/**
	 * 通过用户名更新信息
	 */
	public function updateInfo(){
		$this->sqli->connect();
		$result = $this->sqli->query('SELECT * FROM  `users` WHERE  `user` LIKE  \''.$this->user.'\';');
		$row = $result->fetch_array();
		if(!is_array($row)){
			$row=false;
		}
		$this->id = $row['id'];
		$this->permission = $row['permission'];
		return true;
	}
	/**
	 * 通过ID更新信息
	 * @return bool/
	 */
	public function updateInfoById(){
		$this->sqli->connect();
		$result = $this->sqli->query('SELECT * FROM  `users` WHERE  `id` LIKE '.$this->id.';');
		$row = $result->fetch_array();
		if(!is_array($row)){
			return false;
		}
		$this->permission = $row['permission'];
		$this->user = $row['user'];
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
		$this->sqli->connect();
		$result = $this->sqli->query('SELECT * FROM  `users` WHERE  `user` LIKE  \''.$this->user.'\';');
		if(!$result){
			return false;
		}
		$row = $result->fetch_array();
		if(!is_array($row)){
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
			if(md5($this->password)==$select['password']){
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
		userSession::loginUser($this);
	}
	/**
	 * 自动登陆时需要的操作
	 */
	private function successAutoLogin(){
		$this->updateInfoById();
		$this->updateLoginTimeById();
		$this->updateAddressTimeById();
		userSession::loginUser($this);
	}

	/**
	 * @return mixed
	 */
	public function getIp()
	{
		return $this->ip;
	}
	/**
	 * @return string
	 */
	public function getUser()
	{
		return $this->user;
	}
	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}
	/**
	 * @return int
	 */
	public function getPermission()
	{
		return $this->permission;
	}

}