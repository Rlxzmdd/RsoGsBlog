<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/4/23
 * Time: 13:15
 */
/*
 * 如何用PHP制作一个账户系统？
 * 我们在不考虑各种安全的情况下，在session，在服务端存储数据
 * 在session，当用户在1440秒中无任何操作时，就会注销掉数据
 * 我们利用这个特点，以用户的ip为key，在session中储存value，为user的id
 * 在每个用户访问每个页面时，都查询下session有没有
 *  session_start();
 */
class userSession{
    static function start(){
        session_start();
    }
    static function exits($ip){
        return array_key_exists($ip,$_SESSION);
    }
	static function remove($ip){
		unset($_SESSION[$ip]);
	}
    static function get($ip){
        return $_SESSION[$ip];
    }
    static function set($ip,$id){
        $_SESSION[$ip]=$id;
    }
    static function loginUser(userClass $class){
    	self::set($class->getIp(),$class->getId());
	}

	static function haveLogin(){
    	$ip = addressUtils::getAdress();
    	if(self::exits($ip)){
    		return (new userClass($ip,self::get($ip)));
		}else{
    		return false;
		}
	}
}