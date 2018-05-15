<div class="am-g am-g-fixed blog-g-fixed am-u-lg-6 am-u-md-8 am-u-sm-centered ">
    <h3 style="padding-top: 20px">登录</h3>
    <hr />
    <form action="/blog/login" method="post" class="am-form">
        <label for="user">用户名:</label>
        <input type="text" name="user" id="user" value="" />
        <br />
        <label for="password">密码:</label>
        <input type="password" name="password" id="password" value="" />
        <br />
        <div class="am-cf">
            <input type="submit" name="" value="登 录" class="am-btn am-btn-primary am-btn-sm am-fl" />
        </div>
    </form>
    <hr/>
    <div class="am-modal am-modal-alert" tabindex="-1" id="my_alert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">RsoGs</div>
            <div class="am-modal-bd">
                密码错误，请重新填写。
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
</div>
<script src="/static/assets/js/jquery-3.2.1.min.js"></script>
<script src="/static/assets/js/amazeui.min.js"></script>
<?php
if($needAlert){
	echo '
<script type="text/javascript">  $("#my_alert").modal(); </script>
';
}
?>