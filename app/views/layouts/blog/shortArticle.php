<?php
return '
			<div class="blog-body-shortArticle  blog-shadow-box" onclick=\'window.location.href="/blog/article/'.$id.'"\'>
                <h3 class="am-article-title blog-article-title">
                    <a href="/blog/article/'.$id.'">'.$title.'</a>
                </h3>
                <small class="am-article-meta blog-article-meta" >
                    由 <a href="" style="color: #43A047;">'.$author.'</a> 于 '.$time.'
                </small>
                <div class="blog-article-content">
						<pre  style="margin-top: 8px">'.$content.'</pre>
                </div>
                <div class="blog-article-tags">'.$tagstxt.'
					<span class="am-badge am-badge-danger am-round blog-article-likes" style="color: #D32F2F;background-color: #FFFFFF;border: solid 1px #D32F2F ;float: right;"><span class="am-icon-thumbs-up am-icon-fw"></span> '.$likes.'</span>
					<span class="am-badge am-round blog-article-visits" style="color: #43A047;background-color: #FFFFFF;border: solid 1px #43A047 ;float: right;"><span class="am-icon-users am-icon-fw"></span> '.$visits. '</span>
                </div>
            </div>';
