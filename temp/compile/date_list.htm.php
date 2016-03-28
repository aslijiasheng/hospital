<table border='1'>
<tr>
<td>电话</td>
<td>名称</td>
<td>Q Q</td>
<td>预约项目</td>
</tr>
<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
<tr>
<td><?php echo $this->_var['row']['dc_tel']; ?></td>
<td><?php echo $this->_var['row']['dc_name']; ?></td>
<td><?php echo $this->_var['row']['dc_qq']; ?></td>
<td><?php echo $this->_var['row']['dc_zxxm']; ?></td>
</tr>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>