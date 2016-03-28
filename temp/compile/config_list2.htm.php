<form id="pagerForm" method="post" action="?action=config&do=list">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="20" />
</form>
<div class="panelBar">
			<ul class="toolBar">				
				<li><a class="add" href="?action=config&do=new&lmid=<?php echo $this->_var['row1']['lmid']; ?>" target="dialog"><span>添加</span></a></li>
				<li><a class="edit" href="?action=config&do=edit&id={id}" target="dialog"><span>修改</span></a></li>
				<li><a class="delete" href="?action=config&do=del&id={id}" target="ajaxTodo" title="配置关联项目很多,不建议删除!<br/>您针对确定要删除吗?"><span>删除</span></a></li>
				<li class="line">line</li>
				
			</ul>
		</div>
<div style="border-left:1px #B8D0D6 solid;">
		<table class="list" layouth="97" style="width:800px">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">名称</th>
					<th align="center">创建时间</th>
					<th align="center">更新时间</th>
					<th align="center">状态</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['title']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><?php echo $this->_var['row']['updated_at']; ?></td>
					<td><?php echo $this->_var['row']['xs_cn']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
