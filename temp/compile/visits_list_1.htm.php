<form id="pagerForm" method="post" action="index.php?action=visits&type=1">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="salesid5"  value="<?php echo $this->_var['salesid5']; ?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start']; ?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over']; ?>"/>
	<input type="hidden" name="pingjia"  value="<?php echo $this->_var['pingjia']; ?>"/>
	<input type="hidden" name="hfnum"  value="<?php echo $this->_var['hfnum']; ?>"/>
	<input type="hidden" name="type"  value="<?php echo $this->_var['type']; ?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=visits&type=1" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名(或)电话:<input type="text" name="nt" size="12"/>
					</td>
					<td>
						预约回访时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
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
				<li><a class="show" href="?action=visits&do=show&id={id}" target="dialog"><span>明细</span></a></li>
				<li><a class="huifang" href="?action=visits&do=new&id1={id}" target="dialog" height="340" width="600"><span>回访</span></a></li>
				<li class="line">line</li>
				<li><a class="edit" href="?action=visits&type=1" target="navTab" target="visits" ><span>回访提醒</span></a></li>
			</ul>
		</div>
		<table class="table" layouth="112" style="width:95%;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">预定回访时间</th>
					<th align="center">客户名称</th>
					<th align="center">来院次数</th>
					<th align="center">回访次数</th>
					<th align="center">操作人</th>
					<th align="center">客户电话</th>
					<th >再回访提醒</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>,<?php echo $this->_var['row']['infoid']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><a class="show" href="?action=info&do=show&id=<?php echo $this->_var['row']['infoid']; ?>" target="dialog"  width="800" height="302"><span><?php echo $this->_var['row']['name']; ?></span></a></td>
					<td><?php echo $this->_var['row']['visitnum']; ?></td>
					<td><?php echo $this->_var['row']['hfnum']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td style="width:40%;overflow:hidden;"><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条，每页显示30个</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="50" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>