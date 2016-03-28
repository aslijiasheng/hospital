<form id="pagerForm" method="post" action="?action=data&do=record">
	<input type="hidden" name="pageNum" value="1" />
</form>

<div class="page">

<div class="pageContent">
<div class="panelBar">
		<ul class="toolBar">
			<li><a title="确实要删除这些日志吗?" target="selectedTodo" rel="rz[]" href="?action=data&do=recorddel2" class="delete"><span>批量删除日志</span></a></li>
		</ul>
	</div>
			<div  style="float:left;  overflow:auto; width:170px; line-height:21px; background:#fff; ">
			<ul class="tree treeFolder" layouth="0">
				<li><a href="javascript">日志分类</a>
						<ul>		
							<li><a href="?action=data&do=record&tid=khtp" target="ajax" rel="recordBox">客户图片日志</a></li>
							<li><a href="?action=data&do=record&tid=tlz" target="ajax" rel="recordBox">讨论组聊天记录</a></li>
							<li><a href="?action=data&do=record&tid=ewm" target="ajax" rel="recordBox">二维码临时文件</a></li>
						</ul>
				</li>
			</ul>
			</div>

			<div id="recordBox" class="unitBox" style="float:left; width:81%; border:solid 1px #b8d0d6;border-top:none;borter-bottom:none; line-height:21px; background:#fff;">
				
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
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="10" pageNumShown="6" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>		
	 </div>
</div>

<script type="text/javascript">
    function savetxt(url){ 
        var a = window.open(url,"_blank","height=0,width=0,toolbar=no,menubar=no,scrollbars=no,resizable=on,location=no,status=no");
        a.document.execCommand("SaveAs");   
        a.window.close(); 
        a.close();   
    }
</script>