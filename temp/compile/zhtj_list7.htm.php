<form id="pagerForm" method="post" action="?action=zhtj&do=list7">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="orderField" value="<?php echo $this->_var['orderField']; ?>" />
	<input type="hidden" name="numPerPage" value="<?php echo $this->_var['numPerPage']; ?>" />
	<input type="hidden" name="zxxm"  value="<?php echo $this->_var['zxxm']; ?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start']; ?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over']; ?>"/>
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=zhtj&do=list7" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						项目名称:<input type="text" name="zxxm" size="30" x-webkit-speech lang="zh-CN" />
					</td>
					<td>
						时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
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
		<table class="table" layouth="115" style="width:95%;" >
			<thead>
				<tr>
					<th align="center">治疗项目</th>
					<th align="center" orderField="x_num" class="desc">预约个数</th>
					<th align="center" orderField="dy" class="desc">已到院</th>
					<th align="center" orderField="wdy" class="desc">未到院</th>
					<th align="center" orderField="dyl" class="desc">到院率</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['zxxm']; ?></td>
					<td><?php echo $this->_var['row']['x_num']; ?></td>
					<td><?php echo $this->_var['row']['dy']; ?></td>
					<td><?php echo $this->_var['row']['wdy']; ?></td>
					<td><?php echo $this->_var['row']['dyl2']; ?>%</td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
			<span>每页显示：</span><select class="combox" name="numPerPage" onchange="navTabPageBreak({numPerPage:this.value})">
				<option value="20">20</option>
				<option value="50">50</option>
				<option value="100">100</option>
				<option value="200">200</option>
			</select>
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>