<form id="pagerForm" method="post" action="?action=zhtj&do=list6">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=zhtj&do=list6" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>

					<td>
						时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>

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
		<div class="panelBar">
			<ul class="toolBar">
			</ul>
		</div>
		<table class="list" layouth="91" style="width:1100px;">
			<thead>
				<tr>
					<th align="center">关键词</th>
					<th align="center">登记个数</th>
					<th align="center">来院个数</th>
					<th align="center">派单个数</th>
					<th align="center">销售金额</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['keyword']; ?></td>
					<td><?php echo $this->_var['row']['dj_n']; ?></td>
					<td><?php echo $this->_var['row']['ly_n']; ?></td>
					<td><?php echo $this->_var['row']['pd_n']; ?></td>
					<td><?php echo $this->_var['row']['je_n']; ?></td>

				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="50" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>