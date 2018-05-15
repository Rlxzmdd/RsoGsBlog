<?php
return
'<tr>
	<td>'.$id.'</td>
	<td>'.$title.'</td>
	<td>'.$tags.'</td>
	<td>'.$time.'</td>
	<td>'.$visits.' <span class="am-badge am-badge-success">+'.$addVisits.'</span></td>
	<td>'.$likes.' <span class="am-badge am-badge-success">+'.$addLikes.'</span></td>
	<td>'.$status.'</td>
	<td>
		<div class="am-dropdown" data-am-dropdown>
			<button class="am-btn am-btn-default am-btn-xs am-dropdown-toggle" data-am-dropdown-toggle><span class="am-icon-cog"></span> <span class="am-icon-caret-down"></span></button>
			<ul class="am-dropdown-content">
				<li><a href="#">置顶</a></li>
				<li><a href="#">编辑</a></li>
				<li><a href="/admin/delArticle/'.$id.'">删除</a></li>
			</ul>
		</div>
	</td>
</tr>';