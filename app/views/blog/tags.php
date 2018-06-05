<!-- 主页文章简介区域Start !-->
<div class="rs-main">
    <!-- 文章简介Start !-->
    <div class="rs-articles">
        <div class="rs-search-tags"><?php echo $tag ?></div>
        <?php
        echo $articles;
        ?>
        <!-- 跳页Start !-->
        <div class="rs-pagination">
            <ul>
                <?php
                echo $skip;
                ?>
            </ul>
        </div>
        <!-- 跳页Finish !-->
    </div>
    <!-- 文章简介Finish !-->
    <!-- 侧边栏Start !-->
    <?php echo $sidebars ?>
    <!-- 侧边栏Finish !-->
</div>
<!-- 主页文章简介区域Finish !-->