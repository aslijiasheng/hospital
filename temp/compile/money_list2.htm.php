<form id="pagerForm" method="post" action="?action=money&do=list2">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="typeid"  value="<?php echo $this->_var['typeid'];?>"/>
	<input type="hidden" name="salesid"  value="<?php echo $this->_var['salesid'];?>"/>
	<input type="hidden" name="paidanid"  value="<?php echo $this->_var['paidanid'];?>"/>
	<input type="hidden" name="fz"  value="<?php echo $this->_var['fz'];?>"/>
	<input type="hidden" name="time_start"  value="<?php echo $this->_var['time_start'];?>"/>
	<input type="hidden" name="time_over"  value="<?php echo $this->_var['time_over'];?>"/>
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=money&do=list2" method="post">
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
						<input type="radio" name="fz"  value="1" />初诊
						<input type="radio" name="fz"  value="2" />复诊
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['paidan_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['typeid_cn']; ?>
					</td>
					<td>
					<input type="radio" name="money_qf"  value="1" />欠费
					</td>
					<td>
						消费时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
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
				<li><a class="show" href="?action=sell&do=show&id={id}" target="navTab" rel="sellshow"><span>明细</span></a></li>
				<li class="line">line</li>
				
			</ul>
		</div>
		<table class="list" layouth="91" style="width:1000px;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">来院时间</th>
					<th align="center">收取定金时间</th>
					<th align="center">客户名称</th>
					<th align="center">接待人</th>
					<th align="center">登记人</th>
					<th align="center">派单人</th>
					<th align="center">客户电话</th>
					<th align="center">到诊情况</th>
					<th align="center">定金</th>
					<th align="center">实收金额</th>
					<th align="center">本次欠费</th>
					<th align="center">账户消费</th>
					<th align="center">退款</th>
					<th align="center">短信</th>
				</tr>
			</thead>
			<tbody>			
<?php 
$_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" <?php if(in_array($this->_var['row']['infoid'], $this->_var['money_dj_arr']) && $this->_var['row']['money_dj'] == 0 && (strtotime(date('Y-m-d', $this->_var['row']['created_at'])) - strtotime($this->_var['row']['create_at_dj'])) <= 30) {echo "style='background-color:#99FF99'";} ?> >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td ><?php echo  $this->_var['row']['created_at']; ?></td>
					<td ><?php echo  ($this->_var['row']['money_dj'] == 0) ? '' : $this->_var['row']['create_at_dj']; ?></td>
					<td class="<?php echo $this->_var['row']['vip']; ?>"><a href="?action=sell&do=show&id=<?php echo $this->_var['row']['id']; ?>" target="dialog" width="800"><?php echo $this->_var['row']['name']; ?></a></td>
					<td><?php echo $this->_var['row']['salesid2_txt']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['paidan_txt']; ?></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['fz_cn']; ?></td>
					<td><?php echo $this->_var['row']['money_dj']; ?></td>
					<td ><?php echo  ($this->_var['row']['money_dj'] == 0) ? $this->_var['row']['money_ss'] : 0; ?></td>
					<td ><?php echo  ($this->_var['row']['money_dj'] == 0) ? $this->_var['row']['money_qf'] : 0; ?></td>
					<td ><?php echo  ($this->_var['row']['money_dj'] == 0) ? $this->_var['row']['yepay'] : 0; ?></td>
					<td ><?php echo  ($this->_var['row']['money_dj'] == 0) ? $this->_var['row']['money_tk'] : 0; ?></td>
					<td><a href="?action=smsmail&do=sms&id=<?php echo $this->_var['row']['infoid']; ?>" target="navTab" >短信</a></td>
				</tr>
				
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条<?php if (in_array('moneylist2PaidINAmount', $this->_var['role_action'])): ?>--共实收金额<?php echo $this->_var['list2']['num_t']; ?><?php endif; ?><?php if (in_array('moneylist2UnpaidaArrears', $this->_var['role_action'])): ?>--未收欠款<?php echo $this->_var['list2']['num2']; ?><?php endif; ?></span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="30" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>
