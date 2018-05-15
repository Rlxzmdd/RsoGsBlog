<header class="am-topbar am-topbar-inverse admin-header">
    <div class="am-topbar-brand">
        <a href="/blog/index" style="color: #000000;"><strong>RsoGs Blog</strong></a><small>文章管理</small>
    </div>
    <button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-btn-success am-show-sm-only" data-am-collapse="{target: '#topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
    <div class="am-collapse am-topbar-collapse" id="topbar-collapse">
        <ul class="am-nav am-nav-pills am-topbar-nav am-topbar-right admin-header-list">
            <li class="am-dropdown" data-am-dropdown>
                <a class="am-dropdown-toggle" style="color: #000000;">
                    <?php
					use app\models\UserModel;
					use app\classes\userClass;
					use app\utils\addressUtils;
					$userSession = (new UserModel(new userClass(addressUtils::getAdress())));
					$isLogin = $userSession->isLoginInTime();
					echo $userSession->getUser()->getUser();
                    ?>
                </a>
            </li>
        </ul>
    </div>
</header>

<div class="am-cf admin-main">
    <!-- sidebar start -->
    <div class="admin-sidebar am-offcanvas" id="admin-offcanvas">
        <div class="am-offcanvas-bar admin-offcanvas-bar">
            <ul class="am-list admin-sidebar-list">
                <!--首页，文章管理，评论管理，访问点赞管理
				!-->
                <!--<li><a href="/admin/index"><span class="am-icon-home"></span> 首页</a></li>!-->
                <li><a href="/admin/article"><span class="am-icon-file-text"></span> 文章管理</a></li>
                <li><a href="/admin/addArticle"><span class="am-icon-edit"></span> 添加文章</a></li>
                <!--<li><a href="/admin/index"><span class="am-icon-pencil-square-o"></span> 评论管理</a></li>!-->
                <!--<li><a href="#"><span class="am-icon-thumbs-up"></span> 访问点赞管理</a></li>!-->
                <li><a href="/blog/login/logout"><span class="am-icon-sign-out"></span> 注销</a></li>
            </ul>

            <div class="am-panel am-panel-default admin-sidebar-panel">
                <div class="am-panel-bd">
                    <p><span class="am-icon-bookmark"></span> 公告</p>
                    <p>一切以实物为准</p>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar end -->