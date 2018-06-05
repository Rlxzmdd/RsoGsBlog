(function ($) {
    'use strict';

    $(function () {
        var $fullText = $('.admin-fullText');
        $('#admin-fullscreen').on('click', function () {
            $.AMUI.fullscreen.toggle();
        });

        $(document).on($.AMUI.fullscreen.raw.fullscreenchange, function () {
            $fullText.text($.AMUI.fullscreen.isFullscreen ? '退出全屏' : '开启全屏');
        });
    });
})(jQuery);

function delArticle($id) {
    $.ajax({
        type: 'GET',
        url: '/admin/delArticle/' + $id,
        dataType: 'json',
        data: {},
        success: function (data) {
            //1.清空这个下拉框的数据
            // $('#company option').remove();//也能成功实现
            console.log("asdasd");
            alert("回馈：" + data['status'] + "," + data['message']);
            $('#article_id_' + data['id']).remove();
        },
        error: function (XMLHttpRequest, textStatus, errorThown) {
            alert("网络错误！");
        }
    })
}

function hideArticle($id) {
    $.ajax({
        type: 'GET',
        url: '/admin/hideArticle/' + $id,
        dataType: 'json',
        data: {},
        success: function (data) {
            //1.清空这个下拉框的数据
            // $('#company option').remove();//也能成功实现
            alert("回馈：" + data['status'] + "," + data['message']);
            $('#article_status_' + data['id']).html("主页隐藏");
        },
        error: function (XMLHttpRequest, textStatus, errorThown) {
            alert("网络错误！");
        }
    })
}

function reArticle($id) {
    $.ajax({
        type: 'GET',
        url: '/admin/reArticle/' + $id,
        dataType: 'json',
        data: {},
        success: function (data) {
            //1.清空这个下拉框的数据
            // $('#company option').remove();//也能成功实现
            alert("回馈：" + data['status'] + "," + data['message']);
            $('#article_status_' + data['id']).html("正常");
        },
        error: function (XMLHttpRequest, textStatus, errorThown) {
            alert("网络错误！");
        }
    })
}

function addLike($articleId) {
    $.ajax({
        type: 'GET',
        url: '/admin/likeArticle/' + $articleId,
        dataType: 'json',
        data: {},
        success: function (data) {
            //1.清空这个下拉框的数据
            // $('#company option').remove();//也能成功实现
            //alert("回馈：" + data['status'] + "," + data['message']);
            if (data['status'] === 2) {
                return;
            }
            var box = $('#article_like_' + data['id']);
            box.html('<span class="am-icon-thumbs-up am-icon-fw"></span> ' + (box.html().stripHTML() * 1 + 1))
        },
        error: function (XMLHttpRequest, textStatus, errorThown) {
            alert("网络错误！");
        }
    })
}

String.prototype.stripHTML = function () {
    var reTag = /<(?:.|\s)*?>/g;
    return this.replace(reTag, "");
}