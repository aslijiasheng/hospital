
<form id="pagerForm" method="post" action="index.php?action=smsmail&do=messlist">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="index.php?action=smsmail&do=messlist" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						信息内容:<input type="text" name="intro" size="30"/>
					</td>
					<td>
						类型:<?php echo $this->_var['messtype_cn']; ?>
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
	<div class="panelBar" >
			<ul class="toolBar" style="overflow:visible;">
				<li><a class="add" href="?action=smsmail&do=messlist" target="navTab" rel="messlist" ><span>全部消息</span></a></li>
			    <li><a class="add" href="?action=smsmail&do=messlist&list=2" target="navTab" rel="messlist" ><span>私人消息</span></a></li>
				<li><a class="add" href="?action=smsmail&do=messlist&list=1" target="navTab" rel="messlist" ><span>公共消息</span></a></li>
				<li><a class="add" href="?action=smsmail&do=messnew" target="dialog" rel="messnew" title="信息发送"><span>发送</span></a></li>
				<li><a class="add" href="?action=smsmail&do=messreply&id={id}" target="dialog" ><span>回复</span></a></li>
				<li><a class="delete" href="?action=smsmail&do=messdel&id={id}" target="ajaxTodo" title="确定要删除吗?" ><span>删除</span></a></li>
				<li><a class="add" href="?action=smsmail&do=messlist&me=1" target="navTab" rel="messlist" ><span>发件箱</span></a></li>
				<li class="line">line</li>
				
			</ul>
		</div>
		<table class="table" layouth="90" style="width:95%">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">类型</th>
					<th align="center" class="">发件人</th>
					<th align="center">收件人</th>
					<th align="center">消息内容</th>
					<th align="center">状态</th>
					<th align="center">发件时间</th>
				</tr>
			</thead>
			<tbody>
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['type_cn']; ?></td>
					<td><?php echo $this->_var['row']['sender_txt']; ?></td>
					<td style="width:100px;overflow:hidden;" title="<?php echo $this->_var['row']['address_txt']; ?>"><?php echo $this->_var['row']['address_txt']; ?></td>
					<td style="width:400px;overflow:hidden;" title="<?php echo $this->_var['row']['intro']; ?>"><a href="?action=smsmail&do=messshow&id=<?php echo $this->_var['row']['id']; ?>" target="dialog" title="查看信息" style="font-size:12px"><?php echo $this->_var['row']['intro']; ?></a></td>
					<td><?php echo $this->_var['row']['isread_cn']; ?></td>
					<td><?php echo $this->_var['row']['created_at']; ?></td>
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


	

