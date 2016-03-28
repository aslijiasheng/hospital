<form id="pagerForm" method="post" action="?action=zhtj&do=list3">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=zhtj&do=list3" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名(或)电话:<input type="text" name="nt" size="12"/>
					</td>
					<td>
						消费时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['typeid_cn']; ?>
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
				<li><a class="add" href="?action=visits&do=new&id={id}" target="navTab"><span>电话回访</span></a></li>
				<li><a class="add" href="?action=smsmail&do=sms&id={id}" target="navTab"><span>发送短信</span></a></li>
				<li><a class="add" href="?action=smsmail&do=send&id={id}" target="dialog"><span>发送邮件</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:1100px;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">消费时间</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">登记人</th>
					<th align="center">预约方式</th>
					<th align="center">整形项目</th>
					<th align="center">回访次数</th>
					<th align="center">查看</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['typeid_txt']; ?></td>
					<td><?php echo $this->_var['row']['zxxm']; ?></td>
					<td><?php echo $this->_var['row']['hfnum']; ?></td>
					<td><a href="?action=info&do=show&id=<?php echo $this->_var['row']['id']; ?>" target="dialog" width="800" height="302">明细</a></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>个客人</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="50" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>