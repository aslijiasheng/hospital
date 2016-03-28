<form id="pagerForm" method="post" action="index.php?action=doc">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=doc" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						文档标题:<input type="text" name="title" size="12"/>
					</td>
					<td>
						发布时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['doctid_cn']; ?>
					</td>
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<div class="panelBar">
			<ul class="toolBar">				
				<li><a class="show" href="?action=doc&do=show&id={id}" target="navTab" rel="公告"><span>明细</span></a></li>
				<li class="line">line</li>
				<li><a class="add" href="?action=doc&do=new" target="navTab"><span>添加</span></a></li>
				<li><a class="edit" href="?action=doc&do=edit&id={id}" target="navTab"><span>修改</span></a></li>
				<li><a class="delete" href="?action=doc&do=del&id={id}" target="ajaxTodo" title="确定要删除吗?删除会删除该文档相关回复，及相关文件"><span>删除</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:90%;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">类型</th>
					<th align="center">标题</th>
					<th align="center">发布时间</th>
					<th align="center">发布人</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['doctid_txt']; ?></td>
					<td style="text-align:left;width:450px;text-indent:12px;"><a style="font-size:12px;" href="?action=doc&do=show&id=<?php echo $this->_var['row']['id']; ?>" target="navTab" rel="docsee"><?php echo $this->_var['row']['title']; ?></a></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					
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
</div>