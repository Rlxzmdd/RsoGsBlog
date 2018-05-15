<!-- content start -->
<div class="admin-content">
	<div class="admin-content-body">
		<div class="am-cf am-padding">
			<div class="am-fl am-cf"><strong class="am-text-primary am-text-lg">文章管理</strong> / <small>管理你的文章</small></div>
		</div>
		<div class="am-g">
			<div class="am-u-sm-12">
				<table class="am-table am-table-bd am-table-striped admin-content-table">
					<thead>
					<tr>
						<th>ID</th>
						<th>标题</th>
						<th>标签</th>
						<th>添加时间</th>
						<th>浏览数量</th>
						<th>点赞数量</th>
						<th>文章状态</th>
						<th>操作</th>
					</tr>
					</thead>
					<tbody>
					<?php echo $pages ?>
					</tbody>
				</table>
				<?php echo $skip ?>
			</div>
		</div>
	</div>
	<footer class="admin-content-footer">
		<hr>
		<p class="am-padding-left">© 2014 AllMobilize, Inc. Licensed under MIT license.</p>
	</footer>
</div>
<!-- content end -->
