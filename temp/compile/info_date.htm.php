<table border='1px' bordercolor='#b8d0d6'>
			<thead>
				<tr style="height:25px;">
					<th align="center">ID</th>
					<th align="center">登记时间</th>
					<th align="center" >客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">性别</th>
					<th align="center">年龄</th>
					<th align="center">登记人</th>
					<th align="center">来院</th>
					<th align="center">回访</th>
					<th align="center">区域</th>
					<th align="center">预约方式</th>
					<th align="center">预约时间</th>
					<th align="center">预约科室</th>
					<th align="center">预约医生</th>
					<th align="center">预约项目</th>
					<th align="center">备注</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr  target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td ><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['xb']; ?></td>
					<td><?php echo $this->_var['row']['nl']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['visitnum']; ?></td>
					<td><?php echo $this->_var['row']['hfnum']; ?></td>
					<td><?php echo $this->_var['row']['areaid_txt']; ?></td>
					<td><?php echo $this->_var['row']['typeid_txt']; ?></td>
					<td style="color:#f00;"><?php echo $this->_var['row']['yy_at']; ?></td>
					<td><?php echo $this->_var['row']['productid_txt']; ?></td>
					<td><?php echo $this->_var['row']['doctorid_txt']; ?></td>
					<td><?php echo $this->_var['row']['zxxm']; ?></td>
					<td><?php echo $this->_var['row']['intro']; ?></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>