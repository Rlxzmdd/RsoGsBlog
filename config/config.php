<?php
/**
 * Created by PhpStorm.
 * User: Rlxzmdd
 * Date: 2018/5/5
 * Time: 21:50
 */
class rsConfig
{
    public static $config = [
        'WebTitle' => 'Rlxzmdd\'s Blog | ',
        'HeaderTitle' => 'Rlxzmdd',
        'AboutMe' => '爬行在巨人肩膀的人，兢兢业业的学习着前人们的成果。<br>
                正在学习PHP，Js，Css 以及 一些ACM经典算法。<br><br>
                如果你对这个Blog有什么意见，欢迎到我的GitHub项目添加issue。',
        'Friends' => ' <a href="http://xuqing.xyz/">Xu\'s Blog</a>'
    ];

    public function init()
    {
        $config['db']['host'] = isset($_ENV['MYSQL_HOST']) ? $_ENV['MYSQL_HOST'] : 'localhost';
        $config['db']['username'] = isset($_ENV['MYSQL_USERNAME']) ? $_ENV['MYSQL_USERNAME'] : 'root';
        $config['db']['password'] = isset($_ENV['MYSQL_PASSWORD']) ? $_ENV['MYSQL_PASSWORD'] : 'root';
        $config['db']['dbname'] = isset($_ENV['MYSQL_DBNAME']) ? $_ENV['MYSQL_DBNAME'] : 'blog';

        // 默认控制器和操作名
        $config['defaultController'] = 'Blog';
        $config['defaultAction'] = 'index';
        return $config;
    }
}