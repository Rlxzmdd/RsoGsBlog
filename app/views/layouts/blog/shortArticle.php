
<?php
$tagstxt = '';
foreach ($tags as $tag) {
    $tagstxt = $tagstxt . '<a class="rs-article-tag am-badge am-badge-primary am-round" href="/blog/tags/' . $tag . '">' . $tag . '</a>';
}
return '
        <!-- 文章Start !-->
        <div class="rs-article-shortArticle">
            <h3 class="rs-article-title">
                <a href="/blog/article/' . $id . '">
                ' . $title . '
                </a>
            </h3>
            <small class="rs-article-meta">
                由 <a href="" style="color: #43A047;">' . $author . '</a> 于 ' . $time . '
            </small>
            <div class="rs-article-content" onclick=\'window.location.href="/blog/article/' . $id . '"\'>
                <pre>' . $content . '......</pre>
            </div>
            <div class="rs-article-tags">
                ' . $tagstxt . '
                <span class="rs-article-tag-like am-badge am-badge-danger am-round" id="article_like_' . $id . '" onclick="addLike(' . $id . ')" >
                    <span class="am-icon-thumbs-up am-icon-fw"></span> ' . $likes . '
                </span>
                <span class="rs-article-tag-visit am-badge am-round am-badge-success">
                    <span class="am-icon-users am-icon-fw"></span> ' . $visits . '
                </span>
            </div>
        </div>
        <!-- 文章Finish !-->';

?>