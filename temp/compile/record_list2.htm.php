<form id="pagerForm" method="post" action="?action=data&do=record">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="5" />
</form>


				
		<table class="list" layouth="52" style="width:500px">
			<thead>
			<tr>
				<th width="22"><input type="checkbox" group="rz[]" class="checkboxCtrl"></th>
				<th >日志文件</th>
				<th >操作</th>
			</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']; ?>">
					<td><input name="rz[]" value="<?php echo $this->_var['dir']; ?>/<?php echo $this->_var['row']; ?>" type="checkbox"></td>
					<td><?php echo $this->_var['row']; ?></td>
					<td><a href="?action=plug&do=publicshow&src=<?php echo $this->_var['dir']; ?>/<?php echo $this->_var['row']; ?>" title="查看" class="btnView" target="dialog" rel="publicshow" max="true"><span>查看</span></a><a href="javascript:" onclick="savetxt('<?php echo $this->_var['dir']; ?>/<?php echo $this->_var['row']; ?>')" class="btnAttach" title="下载-右键-目标另存为下载" ><span>下载</span></a><a class="btnDel" href="?action=config&do=recorddel&id=<?php echo $this->_var['dir']; ?>/<?php echo $this->_var['row']; ?>"  target="ajaxTodo" title="确定要删除吗?" ><span>删除</span></a>
					</td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar" >
			<div class="pages" >
				<span>共<?php echo $this->_var['total']; ?>个:日志文件</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="10" pageNumShown="8" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>		

<script type="text/javascript">
    function savetxt(url){ 
        var a = window.open(url,"_blank","height=0,width=0,toolbar=no,menubar=no,scrollbars=no,resizable=on,location=no,status=no");
        a.document.execCommand("SaveAs");   
        a.window.close(); 
        a.close();   
    }
</script>