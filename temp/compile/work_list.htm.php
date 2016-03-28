<form id="pagerForm" method="post" action="?action=doc&do=work">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="view" value="<?php echo $this->_var['view']; ?>" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=doc&do=work" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						汇报标题:<input type="text" name="title" size="12"/>
					</td>
					<td>
						汇报时间:<input type="text" name="time_start" size="9" class="date" readonly="true" />
						-<input type="text" name="time_over" size="9" class="date" readonly="true" />
					</td>
					<td>
					<?php echo $this->_var['salesid_cn']; ?>
					</td>
					<td>
					<?php echo $this->_var['doctid_cn']; ?>
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
				<li><a class="show" href="?action=doc&do=work_new" target="dialog" height="400" width="650"><span>新建报告</span></a></li>
				<li><a class="show" href="?action=doc&do=work&view=manage" target="navTab" rel="work"><span>管辖组报告</span></a></li>
				<li class="line">line</li>
				<?php if ($_SESSION['roleid'] == "1"): ?>
				<li><a class="edit" href="?action=doc&do=work&view=admin" target="navTab" rel="work"><span>全部报告</span></a></li><?php endif; ?>
				<li><a class="edit" href="?action=doc&do=work_edit&id={id}" target="dialog" height="400" width="650" ><span>修改</span></a></li>
				<li><a class="delete" href="?action=doc&do=work_del&id={id}" target="ajaxTodo" title="确定要删除吗?"><span>删除</span></a></li>
				
			</ul>
		</div>
		<table class="list" layouth="91" style="width:90%;">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">报告人</th>
					<th align="center">报告内容</th>
					<th align="center">报告时间</th>
					<th align="center">得分</th>
					<th align="center">状态</th>
					<th align="center">操作</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['Id']; ?>" >
					<td><?php echo $this->_var['row']['Id']; ?></td>
					<td><?php echo $this->_var['row']['salesid_txt']; ?></td>
					<td ><a  href="?action=doc&do=work_show&id=<?php echo $this->_var['row']['Id']; ?>" target="dialog" style="font-size:12px;" height="450" width="750">[<?php echo $this->_var['row']['stlye_cn']; ?>]--<?php echo $this->_var['row']['Subject']; ?></a></td>
					<td><?php echo $this->_var['row']['StartTime']; ?></td>
					<td><?php echo $this->_var['row']['score']; ?></td>
					<td><?php echo $this->_var['row']['state_cn']; ?></td>
					<td><a href="?action=doc&do=work_audit&id=<?php echo $this->_var['row']['Id']; ?>" target="dialog" style="font-size:12px;"  height="450" width="750">审核</a></td>
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