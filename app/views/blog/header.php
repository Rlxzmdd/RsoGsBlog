<!-- 导航栏Begin !-->
<div class="blog-header">
    <header class="am-topbar am-topbar-fixed-top">
	<h1 class="am-topbar-brand"> <a href="/blog/index/">Rlxzmdd</a> </h1>
	<button class="am-topbar-btn am-topbar-toggle am-btn am-btn-sm am-show-sm-only" data-am-collapse="{target: '#doc-topbar-collapse'}"><span class="am-sr-only">导航切换</span> <span class="am-icon-bars"></span></button>
	<div class="am-collapse am-topbar-collapse " id="doc-topbar-collapse">
		<?php
		use app\models\UserModel;
		use app\classes\userClass;
		use app\utils\addressUtils;
		$page = $this->_action;
		$userSession = (new UserModel(new userClass(addressUtils::getAdress())));
		$isLogin = $userSession->isLoginInTime();
		if(!$isLogin){
			$user = '
      <div class="am-topbar-left am-form-inline am-topbar-right">
          <ul class="am-nav am-nav-pills am-topbar-nav">
              <li class="am-dropdown" data-am-dropdown>
                  <a href="/blog/login">
                      登录
                  </a>
              </li>
          </ul>
      </div>
';
		}else{
			$userSession->updateInfoById();
			if($userSession->getUser()->getPermission() == "2"){
				$user = '
      <div class="am-topbar-left am-form-inline am-topbar-right">
          <ul class="am-nav am-nav-pills am-topbar-nav">
              <li class="am-dropdown" data-am-dropdown>
                  <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                      '.$userSession->getUser()->getUser().' <span class="am-icon-caret-down"></span>
                  </a>
                  <ul class="am-dropdown-content">
                      <li class="am-dropdown-header">个人中心</li>
                      <li><a href="/admin/article">管理文章</a></li>
                      <li><a href="/blog/login/logout">注销</a></li>
                  </ul>
              </li>
          </ul>
      </div>
';
			}else {
				$user = '
      <div class="am-topbar-left am-form-inline am-topbar-right">
          <ul class="am-nav am-nav-pills am-topbar-nav">
              <li class="am-dropdown" data-am-dropdown>
                  <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
                      '.$userSession->getUser()->getUser().' <span class="am-icon-caret-down"></span>
                  </a>
                  <ul class="am-dropdown-content">   
                      <li class="am-dropdown-header">个人中心</li>
                      <li><a href="/blog/login/logout">注销</a></li>
                  </ul>
              </li>
          </ul>
      </div>
';
			}
		}
		$index = ($page == "index") ? '<li class="am-active"><a href="/blog/index">首页</a></li>' : '<li><a href="/blog/index">首页</a></li>';
		$pages = ($page == "article") ? '<li class="am-active"><a>文章</a></li>' : '<li><a>文章</a></li>';
		$tags = ($page == "tags") ? '<li class="am-active"><a>标签</a></li>' : '<li><a>标签</a></li>';
		print_r('
    <ul class="am-nav am-nav-pills am-topbar-nav">
    ' . $index . $pages . $tags.'
      <li class="am-dropdown" data-am-dropdown>
        <a class="am-dropdown-toggle" data-am-dropdown-toggle href="javascript:;">
          菜单 <span class="am-icon-caret-down"></span>
        </a>
        <ul class="am-dropdown-content">
          <li class="am-dropdown-header">瞧瞧你发现了什么</li>
          <li><a href="#">关于我们</a></li>
          <li><a href="#">关于网页</a></li>
            <li class="am-divider"></li>
            <li><a href="#">你说这是什么按钮</a></li>
        </ul>
      </li>
    </ul>
      ' . $user
		);
		?>
	    </div>
    </header>
</div>
<!-- 导航栏End !-->