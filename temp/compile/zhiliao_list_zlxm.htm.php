<div class="pageContent">
		<table class="list"  style="width:80%">
			<thead>
				<tr>
					<th align="center">项目名称</th>
					<th align="center">疗程次数</th>
					<th align="center">已治疗</th>
					<th align="center">派单人</th>
					<th align="center">派单时间</th>
					<th align="center">选择</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['title']; ?></td>
					<td><?php echo $this->_var['row']['num']; ?></td>
					<td><?php echo $this->_var['row']['num_z']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><input name="zlxm[]" value="<?php echo $this->_var['row']['id']; ?>" type="checkbox"></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
</div>
