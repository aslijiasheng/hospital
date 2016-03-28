 <div class="panelBar">
			<ul class="toolBar">
				<li class="line">line</li>
				<li><a class="add" href="?action=config&do=pricenew&lmid=<?php echo $this->_var['list2']['lmid']; ?>" target="dialog" ><span>添加</span></a></li>
				<li><a class="edit" href="?action=config&do=priceedit&id={id}" target="dialog"><span>修改</span></a></li>
				<li><a class="delete" href="?action=config&do=pricedel&id={id}" target="ajaxTodo" title="您确定要删除吗?"><span>删除</span></a></li>
				<li class="line">line</li>
			</ul>
			</div>
		<table class="table" layouth="112" style="width:90%">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">名称</th>
					<th align="center">价格</th>
					<th align="center" style="width:400px;">备注</th>
					<th align="center">创建时间</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr class="edit" target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td ><?php echo $this->_var['row']['item']; ?></td>
					<td><?php echo $this->_var['row']['price']; ?></td>
					<td><?php echo $this->_var['row']['intro']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		
		<div class="panelBar" borter-bottom:none;>
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>
		</div>