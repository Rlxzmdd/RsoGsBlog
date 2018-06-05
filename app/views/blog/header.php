<!-- 菜单Start !-->
<?php

use app\models\UserModel;
use app\classes\userClass;
use app\utils\addressUtils;

$isLogin = 0;//0为无登陆，1为登陆；
$permission = 0;//0为游客，1为普通用户，2为管理员
$page = 'index';//当前页面
$page = $this->_action;
$userSession = (new UserModel(new userClass(addressUtils::getAdress())));
$isLogin = $userSession->isLoginInTime();

$needPrint = '';//需要打印的数据；
if (!$isLogin) {
    $needPrint = $needPrint . '<a class="rs-dropdown-toggle" href="/blog/login">登陆</a>';
} else {
    $userSession->updateInfoById();
    $permission = $userSession->getUser()->getPermission();
    $user = $userSession->getUser();
    switch ($permission) {
        case 1:
            $needPrint = $needPrint . '
                    <a class="rs-dropdown-toggle" href="javascript:;">
                        ' . $user->getUser() . ' <span class="am-icon-caret-down"></span>
                    </a>
                    <ul class="rs-dropdown-content">
                        <li class="rs-dropdown-header">个人中心</li>
                        <li onclick="window.location.href=\'/blog/login/logout\'">注销</li>
                    </ul>';
            break;
        case 2:
            $needPrint = $needPrint . '
                    <a class="rs-dropdown-toggle" href="javascript:;">
                        ' . $user->getUser() . ' <span class="am-icon-caret-down"></span>
                    </a>
                    <ul class="rs-dropdown-content">
                        <li class="rs-dropdown-header">个人中心</li>
                        <li onclick="window.location.href=\'/admin/article\'">管理文章</li>
                        <li onclick="window.location.href=\'/blog/login/logout\'">注销</li>
                    </ul>';
            break;
        default:
            $needPrint = $needPrint . '<a class="rs-dropdown-toggle" href="/blog/login">登陆</a>';
            break;
    }
}
$index = ($page == "index") ? '<li class="rs-active"><a href="/blog/index">首页</a></li>' : '<li><a href="/blog/index">首页</a></li>';
$pages = ($page == "article") ? '<li class="rs-active"><a>文章</a></li>' : '<li><a>文章</a></li>';
$tags = ($page == "tags") ? '<li class="rs-active"><a>标签</a></li>' : '<li><a>标签</a></li>';
?>
<header class="rs-menu">
    <div class="rs-menu-title"><a href="/blog/index/"><?php echo rsConfig::$config['HeaderTitle'] ?></a></div>
    <div class="rs-menu-collapse">
        <ul class="rs-menu-nav">
            <?php
            echo $index . $pages . $tags
            ?>
        </ul>
        <div class="rs-menu-nav rs-right">
            <ul class="rs-menu-nav">
                <li class="rs-dropdown">
                    <?php
                    echo $needPrint;
                    ?>
                </li>
            </ul>
        </div>
    </div>
</header>
<!-- 菜单Finish !-->
<!-- 导航栏End !-->