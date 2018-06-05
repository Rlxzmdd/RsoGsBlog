<?php
return
    '<tr id="article_id_' . $id . '">
	<td>'.$id.'</td>
	<td><a href="/blog/article/' . $id . '">' . $title . '</a></td>
	<td>'.$tags.'</td>
	<td>'.$time.'</td>
	<td>'.$visits.' <span class="am-badge am-badge-success">+'.$addVisits.'</span></td>
	<td>' . $likes . ' <span class="am-badge am-badge-danger">+' . $addLikes . '</span></td>
	<td id="article_status_' . $id . '">' . $status . '</td>
	<td>
		<div class="am-dropdown" data-am-dropdown>
			<button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle>
			<span class="am-icon-cog"></span> 
			<span class="am-icon-caret-down"></span>
			</button>
			<ul class="am-dropdown-content">
				<li><a href="#">置顶</a></li>
				<li><a href="/admin/editArticle/' . $id . '">编辑</a></li>
				<li><a onclick="reArticle(' . $id . ')">恢复</a></li>
				<li><a onclick="hideArticle(' . $id . ')">隐藏</a></li>
				<li><a onclick="delArticle(' . $id . ')">删除</a></li>
			</ul>
		</div>
	</td>
</tr>';