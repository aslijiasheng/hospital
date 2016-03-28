<form id="pagerForm" method="post" action="?action=plug&do=couponlist">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="20" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=plug&do=couponlist" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名&电话:<input type="text" name="b" size="12"/>
					</td>
					<td>
						优惠码:<input type="text" name="yhq" size="12"/>
					</td>
					<td>
						发放时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
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
				<li><a class="delete" href="?action=plug&do=coupondel&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
				<li><a class="edit" href="?action=plug&do=couponhandle&id={id}" target="ajaxTodo" title="确定要设为使用吗?"><span>使用</span></a></li>
			</ul>
		</div>
		<table class="list" layouth="91" style="width:95%;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">领取时间</th>
					<th align="center">到期时间</th>
					<th align="center">客户名称</th>
					<th align="center">手机号</th>
					<th align="center">发放人</th>
					<th align="center">优惠券码</th>
					<th align="center">分类备注</th>
					<th align="center">状态（操作人）</th>
					<th align="center">使用时间</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
					<td><?php echo $this->_var['row']['expire_at']; ?></td>
					<td><?php echo empty($this->_var['row']['name']) ? '无' : $this->_var['row']['name']; ?></td>
					<td ><?php echo $this->_var['row']['tel']; ?></a></td>
					<td><?php echo $this->_var['row']['ffr']; ?></td>
					<td><?php echo $this->_var['row']['yhq']; ?></td>
					<td><?php echo $this->_var['row']['lx']; ?></td>
					<td><?php echo $this->_var['row']['handle_cn']; ?>（<?php echo $this->_var['row']['czr']; ?>）</td>
					<td><?php echo $this->_var['row']['updated']; ?></td>
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