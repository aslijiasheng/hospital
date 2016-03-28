<form id="pagerForm" method="post" action="index.php?action=sell&ms=dy">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="numPerPage" value="10" />
	<input type="hidden" name="typeid"  value="<?php echo $this->_var['typeid'];?>"/>
	<input type="hidden" name="salesid"  value="<?php echo $this->_var['salesid'];?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start'];?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over'];?>"/>
	<input type="hidden" name="fz"  value="<?php echo $this->_var['fz'];?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return dialogSearch(this);" action="index.php?action=sell&ms=dy" method="post" class="tj">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名(或)电话:<input type="text" name="nt" size="12"/>
					</td>
					 <td>
						<input type="radio" name="fz"  value="1" />初诊
						<input type="radio" name="fz"  value="2" />复诊
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
				<li><a class="show" href="?action=sell&do=show&id={id}" target="dialog" width="800" height="302"><span>明细</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="94" style="width:95%;">
			<thead>
				<tr>
					<th align="center">来院ID</th>
					<th align="center">来访时间</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">性别</th>
					<th align="center">接待人</th>
					<th align="center">登记人</th>
					<th align="center">到诊情况</th>
					<th align="center">选择</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>,<?php echo $this->_var['row']['infoid']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created']; ?></td>
					<td class="<?php echo $this->_var['row']['vip']; ?>"><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['xb']; ?></td>
					<td><?php echo $this->_var['row']['salesid2_txt']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['fz_cn']; ?><?php echo $this->_var['row']['num7']; ?></td>
					<td><a class="btnSelect" href="javascript:$.bringBack({name:'<?php echo $this->_var['row']['name']; ?>', tel:'<?php echo $this->_var['row']['fz_cn']; ?>&#9758;电话：<?php echo $this->_var['row']['dh_txt']; ?>&#9758;<?php echo $this->_var['row']['xb']; ?>',nl:'<?php echo $this->_var['row']['nl']; ?>',infoid:'<?php echo $this->_var['row']['infoid']; ?>',sellid:'<?php echo $this->_var['row']['id']; ?>',pdxm:'<?php echo $this->_var['row']['pd_txt2']; ?>'})" title="查找带回">选择</a></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		</div>
		<div class="panelBar">
			<div class="pages">
				<span>共来访<?php echo $this->_var['total']; ?>次&#9786;来访<?php echo $this->_var['list2']['num']; ?>个,如果找不到客人，，让前台人员补登来访</span>
			</div>
			
			<div class="pagination" targetType="dialog" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="10" pageNumShown="6" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>