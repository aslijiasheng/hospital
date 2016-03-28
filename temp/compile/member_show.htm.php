<div class="page">
	<div class="pageContent">
			<table class="list" layouth="25" style="width:500px;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">查看</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['tel']; ?></td>
					<td><a href="?action=info&do=show&id=<?php echo $this->_var['row']['id']; ?>" target="dialog" >明细</a></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
	</div>
</div>