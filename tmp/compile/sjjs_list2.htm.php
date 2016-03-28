<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form id="pagerForm" method="post" action="?action=zhtj&do=sjjs2">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">
				<li><a class="edit" href="?action=info&do=edit&id={id}" target="dialog"><span>修改</span></a></li>
				<?php if ($_SESSION['roleid'] == "1"): ?>
				<li><a class="delete" href="?action=info&do=del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
				<?php endif; ?>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:750px;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">登记时间</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">登记人</th>
					<th align="center">到院次数</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td ><?php echo $this->_var['row']['tel']; ?></td>
					<td ><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['visitnum']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条<a href="http://127.0.0.1/index.php?action=zhtj&do=sjjs2&name=%E7%8E%8B%E5%85%88%E7%94%9F" target="navTab" rel="重复详细">详细</a></span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="50" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>