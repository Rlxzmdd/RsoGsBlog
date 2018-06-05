<?php
$tagstxt = '';
foreach ($tags as $tag) {
    $tagstxt = $tagstxt . '<a class="rs-article-tag am-badge am-badge-primary am-round" href="/blog/tags/' . $tag . '">' . $tag . '</a>';
}
?>
<!-- 主页文章简介区域Start !-->
<div class="rs-main">
    <!-- 文章简介Start !-->
    <div class="rs-articles">
        <div class="rs-article">
            <div class="rs-article-title">
                <div><?php echo $title ?></div>
            </div>
            <small class="rs-article-meta">
                由 <a href="" style="color: #43A047;"><?php echo $author ?></a> 于 <?php echo $time ?>
            </small>
            <div class="rs-article-content">
                <?php echo $content ?>
            </div>
            <div class="rs-article-tags">
                <?php echo $tagstxt ?>
                <span class="rs-article-tag-like am-badge am-badge-danger am-round" id="article_like_18"
                      onclick="addLike(18)">
                    <span class="am-icon-thumbs-up am-icon-fw"></span> <?php echo $likes ?>
                </span>
                <span class="rs-article-tag-visit am-badge am-round am-badge-success">
                    <span class="am-icon-users am-icon-fw"></span> <?php echo $visits ?>
                </span>
            </div>
        </div>

        <!-- 评论区，采用倒序排列 !-->
        <div class="blog-comments-list">
            <ul class="am-comments-list" style="padding: 12px;">
                <li class="am-comment am-comment-flip">
                    <a>
                        <img src="/static/assets/i/user.png" alt="" class="am-comment-avatar" width="48" height="48">
                    </a>
                    <div class="am-comment-main" style="background-color: white;">
                        <header class="am-comment-hd">
                            <div class="am-comment-meta">
                                <a class="am-comment-author"><?php echo '#2'//楼层 ?><?php echo $author ?></a>
                                评论于 <?php echo $time ?>
                            </div>
                        </header>
                        <div class="am-comment-bd">
                            <p>测试你大爷，快上线</p>
                        </div>
                    </div>
                </li>
                <li class="am-comment">
                    <a>
                        <img src="/static/assets/i/user.png" alt="" class="am-comment-avatar" width="48" height="48">
                    </a>
                    <div class="am-comment-main" style="background-color: white;">
                        <header class="am-comment-hd">
                            <div class="am-comment-meta">
                                <a class="am-comment-author"><?php echo '#1'//楼层 ?><?php echo $author ?></a>
                                评论于 <?php echo $time ?>
                            </div>
                        </header>
                        <div class="am-comment-bd">
                            <p>静态测试中: <?php echo $title ?></p>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <!-- 评论区 !-->
    </div>
    <!-- 文章简介Finish !-->
    <!-- 侧边栏Start !-->
    <?php echo $sidebars ?>
    <!-- 侧边栏Finish !-->
</div>
