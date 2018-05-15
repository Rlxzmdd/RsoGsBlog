<div class="admin-content">
<div class="am-g blog-g-fixed am-u-lg-8 am-u-md-8 am-u-sm-centered ">
    <h3 style="padding-top: 20px">添加一篇文章:</h3>
    <hr />
    <form method="post" class="am-form" action="/admin/addArticle">
        <fieldset class="am-form-set">
            <input type="text" id="editor_title" name="editor_title" placeholder="请输入标题">
            <input type="text" id="editor_tags" name="editor_tags" placeholder="请输入标签。Ps：笔记、代码">
        </fieldset>
        <hr />
        <textarea id="editor_text" name="editor_text" placeholder="请输入文章" autofocus=""></textarea>
        <br />
        <div class="am-cf">
            <input type="submit" name="" value="提 交" class="am-btn a4m-btn-primary am-btn-sm am-fl" />
            <!--<input type="submit" name="" value="忘记密码 ^_^? " class="am-btn am-btn-default am-btn-sm am-fr">!-->
        </div>
    </form>
    <hr />
    <div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
        <div class="am-modal-dialog">
            <div class="am-modal-hd">RsoGs</div>
            <div class="am-modal-bd">
                成功添加了文章。
            </div>
            <div class="am-modal-footer">
                <span class="am-modal-btn">确定</span>
            </div>
        </div>
    </div>
</div>
</div>
<script src="/static/assets/js/jquery-3.2.1.min.js"></script>
<!--<![endif]-->
<script src="/static/assets/js/amazeui.min.js"></script>
<link rel="stylesheet" type="text/css" href="/static/assets/css/simditor.css" />
<script type="text/javascript" src="/static/assets/js/module.js"></script>
<script type="text/javascript" src="/static/assets/js/hotkeys.js"></script>
<script type="text/javascript" src="/static/assets/js/uploader.js"></script>
<script type="text/javascript" src="/static/assets/js/simditor.js"></script>
<script type="text/javascript">
var editor = new Simditor({
        textarea: $('#editor_text'),  //textarea的id
        toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'], //工具条都包含哪些内容
        pasteImage: true,//允许粘贴图片
        upload: {
            url: 'richtext_img_upload.do', //文件上传的接口地址
            params: null, //键值对,指定文件上传接口的额外参数,上传的时候随文件一起提交
            fileKey: 'upload_file', //服务器端获取文件数据的参数名
            connectionCount: 3,
            leaveConfirm: '正在上传文件'
        },
        codeLanguages: [
            {name: 'Bash', value: 'bash'},
            {name: 'C++', value: 'c++'},
            {name: 'C#', value: 'cs'},
            {name: 'CSS', value: 'css'},
            {name: 'Erlang', value: 'erlang'},
            {name: 'Less', value: 'less'},
            {name: 'Sass', value: 'sass'},
            {name: 'Diff', value: 'diff'},
            {name: 'CoffeeScript', value: 'coffeescript'},
            {name: 'HTML,XML', value: 'html'},
            {name: 'JSON', value: 'json'},
            {name: 'Java', value: 'java'},
            {name: 'JavaScript', value: 'js'},
            {name: 'Markdown', value: 'markdown'},
            {name: 'Objective C', value: 'oc'},
            {name: 'PHP', value: 'php'},
            {name: 'Perl', value: 'parl'},
            {name: 'Python', value: 'python'},
            {name: 'Ruby', value: 'ruby'},
            {name: 'SQL', value: 'sql'}
        ]
    });
    document.getElementsByClassName("simditor-toolbar")[0].style="top: 52px";
</script>
<?php
if($needAlert){
	echo '
<script type="text/javascript">
    $("#my-alert").modal();
</script>
';
}
?>