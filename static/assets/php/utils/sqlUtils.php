<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/7
 * Time: 12:57
 */

class sqlUtils
{
	/** @var mysqli */
	public $sql;

	public function __construct()
	{
		if (!array_key_exists('MYSQL_HOST', $_ENV)) {
			$_ENV['MYSQL_HOST'] = '127.0.0.1';
			$_ENV['MYSQL_USERNAME'] = 'root';
			$_ENV['MYSQL_PASSWORD'] = 'root';
			$_ENV['MYSQL_PORT'] = 3306;
			$_ENV['MYSQL_DBNAME'] = 'blog';
		} else {
			$_ENV['MYSQL_HOST'] = 'mysql.coding.io';
			$_ENV['MYSQL_USERNAME'] = 'user-ExpYn0pT0P';
			$_ENV['MYSQL_PASSWORD'] = 'b(lB;500?Y-%Z%4itB{T';
			$_ENV['MYSQL_PORT'] = 3306;
			$_ENV['MYSQL_DBNAME'] = 'db-AFzWYkodsX';
		}
		$this->sql = new mysqli();
	}

	/**
	 * @param $con
	 * @return bool
	 */
	public function connect()
	{
		$this->sql->connect($this->getHost(), $this->getUser(), $this->getPassword(), $_ENV['MYSQL_DBNAME'], $_ENV['MYSQL_PORT']);
		if (!$this->sql) {
			return false;
		} else {
			return true;
		}
	}

	public function close(){
		$this->sql->close();
	}
	/**
	 * @param $sql
	 * @return mysqli_result
	 */
	public function query($sql)
	{
		//$sql =  preg_replace($sql,'/<(.*)s(.*)c(.*)r(.*)I(.*)p(.*)t(.*)/I',"");
		return $this->sql->query($sql);
	}

	public function setDB($db)
	{
		$this->sql->select_db($db);
	}

	/**
	 * @return mysqli
	 */
	public function getSalli()
	{
		return $this->sql;
	}

	/**
	 * @return mixed
	 */
	private function getHost()
	{
		return $_ENV['MYSQL_HOST'];
	}

	/**
	 * @return mixed
	 */
	private function getPassword()
	{
		return $_ENV['MYSQL_PASSWORD'];
	}

	/**
	 * @return mixed
	 */
	private function getUser()
	{
		return $_ENV['MYSQL_USERNAME'];
	}

	public function getDBName(){
		return $_ENV['MYSQL_DBNAME'];
	}
}