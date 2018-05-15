<?php

/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/23
 * Time: 14:05
 */
namespace app\classes;
use app\models\UserModel;
use app\utils\addressUtils;
use app\utils\sessionUtils;
use app\utils\textUtils;
use app\utils\timeUtils;

class userClass
{
	private $ip;
	private $user;
	private $password;
	private $id;
	private $permission;

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

	/**
	 * @return string
	 */
	public function getPassword()
	{
		return $this->password;
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

	/**
	 * @param int $id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}

	/**
	 * @param mixed $ip
	 */
	public function setIp($ip)
	{
		$this->ip = $ip;
	}

	/**
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	/**
	 * @param int $permission
	 */
	public function setPermission($permission)
	{
		$this->permission = $permission;
	}

	/**
	 * @param string $user
	 */
	public function setUser($user)
	{
		$this->user = $user;
	}

}