<form id="pagerForm" method="post" action="?action=info&do=log&id=<?php echo $this->_var['row']['id']; ?>">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="20" />
	<input type="hidden" name="intro" value="<?php echo $this->_var['intro']; ?>" />
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return dialogSearch(this);" action="?action=info&do=log&id=<?php echo $this->_var['row']['id']; ?>" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						模糊摘要:<input type="text" name="intro" size="30"/>
					</td>
					<td>
						<div class="buttonActive"><div class="buttonContent"><button type="submit">搜索</button></div></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent">
		<!--<div class="panelBar">
			<ul class="toolBar">				
				
			</ul>
		</div>-->
		<table class="list" layouth="90" style="width:95%">
			<thead>
				<tr>
					<th align="center">时间</th>
					<th align="center">客户id</th>
					<th align="center">操作人</th>
					<th align="center">日志摘要</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_50374000_1398308871');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_50374000_1398308871']):
?>
				<tr target="id" rel="<?php echo $this->_var['row_0_50374000_1398308871']['id']; ?>" >
					<td><?php echo $this->_var['row_0_50374000_1398308871']['created_at']; ?></td>
					<td><?php echo $this->_var['row_0_50374000_1398308871']['infoid']; ?></td>
					<td><?php echo $this->_var['row_0_50374000_1398308871']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row_0_50374000_1398308871']['intro']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="dialog" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>