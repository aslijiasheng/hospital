<form id="pagerForm" method="post" action="?action=smsmail&do=smsmb">
	<input type="hidden" name="pageNum" value="1" />
</form>
<table class="table" width="99%" layoutH="110" rel="jbsxBox">
		<thead>
				<tr>
					<th  orderfield="id">id</th>
					<th orderfield="intro">短信内容</th>
					<th width="30">选择</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['intro']; ?></td>
					<td>
					<a class="btnSelect" href="javascript:$.bringBack({intro:'<?php echo $this->_var['row']['intro']; ?>'})" title="查找带回">选择</a>
				</td>
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