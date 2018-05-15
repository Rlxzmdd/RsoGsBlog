<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/5
 * Time: 21:50
 */
$config['db']['host'] = isset($_ENV['MYSQL_HOST'])?$_ENV['MYSQL_HOST']:'localhost';
$config['db']['username'] = isset($_ENV['MYSQL_USERNAME'])?$_ENV['MYSQL_USERNAME']:'root';
$config['db']['password'] = isset($_ENV['MYSQL_PASSWORD'])?$_ENV['MYSQL_PASSWORD']:'root';
$config['db']['dbname'] = isset($_ENV['MYSQL_DBNAME'])?$_ENV['MYSQL_DBNAME']:'blog';

// 默认控制器和操作名
$config['defaultController'] = 'Blog';
$config['defaultAction'] = 'index';

return $config;