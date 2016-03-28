
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=report&do=t5" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						选择时间:<input type="text" name="time_start" size="10" class="date" value="<?php echo $this->_var['postdate_start']; ?>" readonly="true" />
						-<input type="text" name="time_over" size="10" class="date" value="<?php echo $this->_var['postdate_over']; ?>" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['typeid_cn']; ?>
					</td>
					<td>
					<div class="buttonActive"><div class="buttonContent"><button type="submit">检索</button></div></div>
					</td>
				</tr>
			</table>
		</div>
		</form>
	</div>
	<div class="pageContent" >
		<div class="panelBar">
			<ul class="toolBar">
				
				
			</ul>
		</div>
		<table class="list" layouth="65" style="width:550px">
			<thead>
				  <tr>
					<th rowspan="4">登记人</th>
					<th rowspan="4">登记数量</th>
					<th rowspan="4">到院客人</th>
					<th rowspan="4">派单数</th>
					<th rowspan="4">销售金额</th>
				  </tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr>
					<td><?php echo $this->_var['row']['username']; ?></td>
					<td><?php echo $this->_var['row']['num']; ?></td>
					<td><?php echo $this->_var['row']['num2']; ?></td>
					<td><?php echo $this->_var['row']['num3']; ?></td>
					<td><?php echo $this->_var['row']['num4']; ?></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				<tr class="count_hh">
					<td>合计</td>
					<td><?php echo $this->_var['list2']['num']; ?></td>
				</tr>
				<tr>
				<style type="text/css">
				<!--
				li{list-style:none;line-height:22px;font-size:12px;color:#f00;}
				-->
				</style>
				<div><li >1.如果你按时间统计-</li>
				<li >本表数据反应的是该段时间内登记的客户的情况，不包括之前登记的客人在该段时间的行为</li>
					</div>	
				</tr>
			</tbody>
		</table> 
	</div>
</div>