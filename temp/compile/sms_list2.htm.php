<form id="pagerForm" method="post" action="?action=smsmail&do=smshf">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=smsmail&do=smshf" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td >
						客户电话:<input type="text" name="tel" size="12" />
					</td>


					<td>
						收件时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
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
			<li><a class="add" href="?action=smsmail&do=s_list" target="navTab"><span>短信发送记录</span></a></li>
			<li><a class="add" href="?action=smsmail&do=smshf" target="navTab"><span>短信回复记录</span></a></li>
			<?php if ($_SESSION['roleid'] == "1"): ?>
			<li><a class="delete" href="?action=smsmail&do=smsdel2&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除回复</span></a></li>
			<?php endif; ?>
			<li class="line">line</li>
			</ul>
		</div>
		<table class="table" layouth="116" style="width:1100px;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">回复时间</th>
					<th align="center">客户名称</th>
					<th align="center">客户电话</th>
					<th align="center">回复内容</th>
					<th align="center">状态</th>
					<th align="center">操作</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['ID']; ?>" >
					<td><?php echo $this->_var['row']['ID']; ?></td>
					<td><?php echo $this->_var['row']['MsgArrivedTime']; ?></td>
					<td><?php echo empty($this->_var['row']['name']) ? '无' : $this->_var['row']['name']; ?></td>
					<td><?php echo $this->_var['row']['Sender']; ?></td>
					<td ><div style="width:600px;overflow:hidden;"><?php echo $this->_var['row']['Message2']; ?><?php echo $this->_var['row']['MMSContentLocation']; ?></div></td>
					<td><a href="?action=smsmail&do=smshfmx&id=<?php echo $this->_var['row']['Sender']; ?>" target="dialog"><?php echo $this->_var['row']['handle_cn']; ?></a></td>
					<td><a  href="?action=visits&do=new&id=<?php echo $this->_var['row']['id']; ?>&clfs=<?php echo $this->_var['row']['ID']; ?>" target="dialog"><span>电话</span></a>|<a href="?action=smsmail&do=sms&id=<?php echo $this->_var['row']['id']; ?>&clfs=<?php echo $this->_var['row']['ID']; ?>" target="dialog" rel="sms" ><span>短信</span></a></td>
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
