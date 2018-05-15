<div class="blog-body am-g am-g-fixed">
    <!-- 文章简介区域 !-->
    <div class="blog-body-article am-u-md-8  blog-shadow-box">
        <article>
            <h3 class="am-article-title blog-article-title">
                <a><?php echo $title ?></a>
            </h3>
            <small class="am-article-meta blog-article-meta">
                由 <a href="" style="color: #43A047;"><?php echo $author ?></a> 于 <?php echo $time ?>
            </small>
            <div class="blog-article-content">
                <?php echo $content ?>
            </div>
            <div class="blog-article-tags">
				<?php echo $tags ?>
                <span class="am-badge am-badge-danger am-round blog-article-likes"
                      style="color: #D32F2F;background-color: #FFFFFF;border: solid 1px #D32F2F ;float: right;">
                    <span class="am-icon-thumbs-up am-icon-fw"></span> <?php echo $likes ?></span>
                <span class="am-badge am-round blog-article-visits"
                      style="color: #43A047;background-color: #FFFFFF;border: solid 1px #43A047 ;float: right;">
                    <span class="am-icon-users am-icon-fw"></span><?php echo $visits ?></span>
            </div>
        </article>
        <!-- 评论区 !-->
        <div class="blog-comments-list">
            <ul class="am-comments-list" style="padding: 12px;">
                <li class="am-comment">
                    <a>
                        <img src="/static/assets/i/user.png" alt="" class="am-comment-avatar" width="48" height="48">
                    </a>
                    <div class="am-comment-main" style="background-color: white;">
                        <header class="am-comment-hd">
                            <div class="am-comment-meta">
                                <a class="am-comment-author"><?php echo $author ?></a> 评论于 <?php echo $time ?>
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
    <div class="am-u-md-4 blog-body-sidebar">
        <div class="am-panel-group">
            <section class="blog-panel am-panel am-panel-default  blog-shadow-box">
                <div class="am-panel-hd">
                    关于我
                </div>
                <div class="am-panel-bd">
                    一个爬行在学习道路的人，碌碌而无为。
                </div>
            </section>
            <section class=" blog-panel am-panel am-panel-default  blog-shadow-box">
                <div class="am-panel-hd">
                    友链列表
                </div>
                <div class="am-panel-bd">
                    <a href="http://xuqing.xyz/">Xu's Blog</a>
                </div>
            </section>
        </div>
    </div>
</div>

