<form id="pagerForm" method="post" action="?action=zhtj&do=list5">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=zhtj&do=list5" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名&电话:<input type="text" name="nt" size="12"/>
					</td>
					<td>
						客户级别:<?php echo $this->_var['levelid_cn']; ?>
					</td>
					<td>
						登记时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
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
			    <li><a class="huifang" href="?action=visits&do=new&id={id}" target="dialog"><span>回访</span></a></li>
				<li><a class="duanxin" href="?action=smsmail&do=smsyhq&id={id}" target="dialog" rel="sms"><span>优惠券</span></a></li>
				<li><a class="show" href="?action=zhtj&do=list5show&id={id}" target="dialog"><span>查看旗下会员</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:1100px;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">性别</th>
					<th align="center">登记人</th>
					<th align="center">来院次数</th>
					<th align="center">旗下会员</th>
					<th align="center">消费积分</th>
					<th align="center">下线积分</th>
					<th align="center">已消费积分</th>
					<th align="center">剩余积分</th>
					<th align="center">查看</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['name']; ?></td>
					<td ><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['xb']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td><?php echo $this->_var['row']['visitnum']; ?></td>
					<td><?php echo $this->_var['row']['num2']; ?></td>
					<td><?php echo $this->_var['row']['integral1']; ?></td>
					<td><?php echo $this->_var['row']['integral3']; ?></td>
					<td><?php echo $this->_var['row']['integral4']; ?></td>
					<td><?php echo $this->_var['row']['integral5']; ?></td>
					<td><a class="add" href="?action=smsmail&do=sms&id={id}&idjf=<?php echo $this->_var['row']['sms']; ?>" target="navTab">短信</a>|<a href="?action=info&do=show&id=<?php echo $this->_var['row']['id']; ?>" target="dialog" width="800" height="302">明细</a></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>