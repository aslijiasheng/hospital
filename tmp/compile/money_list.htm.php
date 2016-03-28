<form id="pagerForm" method="post" action="index.php?action=money">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="20" />
</form>
<style type="text/css">
<!--
 form.tj{float:left;}
 td.sm{width: 500px;}
 td.sm li{text-align:left;width: 480px;list-style:none;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;}
-->
</style>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=money" method="post" class="tj">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						客户名称:<input type="text" name="name" size="12"/>
					</td>
					<td>
						客户电话:<input type="text" name="tel" size="12"/>
					</td>
					<td>
						操作时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
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
				<li><a class="delete" href="?action=money&do=zuofei&id={id}" target="dialog"><span>作废</span></a></li>
				<li class="line">line</li>
				<li ><span style="color:#f00">红色为已作废单子</span></li>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:1200px;">
			<thead>
				<tr >
					<th align="center" >ID</th>
					<th align="center">时间</th>
					<th align="center">客户名称</th>
					<th align="center">操作人</th>
					<th align="center">充值</th>
					<th align="center">定金</th>
					<th align="center">普通消费</th>
					<th align="center">账户消费</th>
					<th align="center">欠费</th>
					<th align="center">还款</th>
					<th align="center">退款</th>
					<th align="center">账户退款</th>
					<th align="center">积分消费</th>
					<th align="center">消费ID</th>
					<th align="center">操作备注</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" style="color:#<?php echo $this->_var['row']['zuofei_cn']; ?>">
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><?php echo $this->_var['row']['name']; ?>(<?php echo $this->_var['row']['infoid']; ?>)</td>
					<td><?php echo $this->_var['row']['salesid3_txt']; ?></td>
					<td><?php echo $this->_var['row']['money_ad']; ?></td>
					<td><?php echo $this->_var['row']['money_dj']; ?></td>
					<td><?php echo $this->_var['row']['money_ss']; ?></td>
					<td><?php echo $this->_var['row']['yepay']; ?></td>
					<td><?php echo $this->_var['row']['money_qf']; ?></td>
					<td><?php echo $this->_var['row']['money_hk']; ?></td>
					<td><?php echo $this->_var['row']['money_tk']; ?></td>
					<td><?php echo $this->_var['row']['money_tk2']; ?></td>
					<td><?php echo $this->_var['row']['integ']; ?></td>
					<td><?php echo $this->_var['row']['sellid']; ?></td> 
					<td class="sm"><li><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></li></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="30" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>