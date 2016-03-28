<form id="pagerForm" method="post" action="?action=smsmail&do=s_list">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=smsmail&do=s_list" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						客户名称:<input type="text" name="name" size="12"/>
					</td>
					<td >
						客户电话:<input type="text" name="tel" size="12" />
					</td>


					<td>
						发件时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
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
				<li><a class="add" href="?action=smsmail&do=s_list" target="navTab"><span>短信发送记录</span></a></li>
				<li><a class="add" href="?action=smsmail&do=smshf" target="navTab"><span>短信回复记录</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:1100px;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">发送时间</th>
					<th align="center">到达时间</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">发送人</th>
					<th align="center">短信内容</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['ID']; ?>" >
					<td><?php echo $this->_var['row']['ID']; ?></td>
					<td><?php echo $this->_var['row']['SendTime']; ?></td>
					<td><?php echo $this->_var['row']['ActualSendTime']; ?></td>
					<td><?php echo $this->_var['row']['name1']; ?></td>
					<td><?php echo $this->_var['row']['dh_txt']; ?></td>
					<td><?php echo $this->_var['row']['salesid9']; ?></td>
					<td style="width:550px;"><?php echo $this->_var['row']['MsgTitle']; ?></td>
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