<form id="pagerForm" method="post" action="index.php?action=visits">
	<input type="hidden" name="pageNum" value="1" />
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=visits" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名(或)电话:<input type="text" name="nt" size="12"/>
					</td>
					<td>
						回访时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					<td>
			        <select class="combox" name="pingjia" onchange="navTabPageBreak({numPerPage:this.value})">
						<option value="" selected="selected">满意度</option>
						<option value="很满意">很满意</option>
						<option value="一般">一般</option>
						<option value="较差">较差</option>
					</select>
					</td>
					 <td>
						回访次数 >= : <input type="text" name="hfnum" size="2"/>
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
				<li class="line">line</li>
				<li><a class="edit" href="?action=visits&do=edit&id={id}" target="dialog" title="只能修改1天以内的信息"><span>修改</span></a></li>
			</ul>
		</div>
		<table class="table" layouth="112" style="width:95%;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">时间</th>
					<th align="center">客户名称</th>
					<th align="center">来院次数</th>
					<th align="center">回访次数</th>
					<th align="center">回访人</th>
					<th align="center">客户电话</th>
					<th align="center">回访评价</th>
					<th >回访备注</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><a class="show" href="?action=info&do=show&id=<?php echo $this->_var['row']['infoid']; ?>" target="dialog"  width="800" height="302"><span><?php echo $this->_var['row']['name']; ?></span></a></td>
					<td><?php echo $this->_var['row']['visitnum']; ?></td>
					<td><?php echo $this->_var['row']['hfnum']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['pingjia']; ?></td>
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