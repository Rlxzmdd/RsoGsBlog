<?php
// 应用目录为当前目录
define('APP_PATH', __DIR__ . '/');

// 开启调试模式
define('APP_DEBUG', false);

// 加载框架文件
require(APP_PATH . 'rsogsphp/rsogsphp.php');

// 加载配置文件
require(APP_PATH . 'config/config.php');
$config = new rsConfig();
// 实例化框架类
(new rsogsphp\rsogsphp($config->init()))->run();