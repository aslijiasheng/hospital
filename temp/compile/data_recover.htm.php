<form id="pagerForm" method="post" action="index.php?action=data&do=recover">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="20" />
</form>

<div class="page">

	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">				
				<li style="display:none;"><a class="edit" href="?action=data&do=recoverupdata&id={id}" target="navTabTodo" title="确定要恢复吗?"><span>恢复</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="75" style="width:300px">
			<thead>
				<tr>
					<th align="center">名称</th>
					<th align="center">操作</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']; ?>" >
					<td><?php echo $this->_var['row']; ?></td>
					<td><a href="bak/<?php echo $this->_var['row']; ?>" class="btnEdit" title="下载-右键-目标另存为下载" ><span>下载</span></a><a class="btnDel" title="删除" href="?action=data&do=del&id=<?php echo $this->_var['row']; ?>"  target="ajaxTodo" title="确定要删除吗?" ><span>删除</span></a><a href="?action=data&do=recoverupdata&id=<?php echo $this->_var['row']; ?>" class="btnEdit" title="数据还原" ><span>下载</span></a></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
			<div style="color:#f00;">请勿直接点击下载--使用-右键-目标另存为下载</div>
		</table>
	</div>
</div>