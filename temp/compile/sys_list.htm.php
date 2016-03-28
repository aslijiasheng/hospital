<form id="pagerForm" method="post" action="?action=config&do=sys">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=config&do=sys" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						配置名称:<input type="text" name="title" size="10"/>
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
			<div  style="float:left;  overflow:auto; width:170px; line-height:21px; background:#fff; ">
			<div class="panelBar">
			<ul class="toolBar">
				<li></li>
			</ul></div>
			<ul class="tree treeFolder" layouth="75">
				<li><a >配置分类</a>

				</li>
			</ul>
			</div>

			<div id="sysBox" class="unitBox" style="float:left; width:81%; border:solid 1px #b8d0d6;border-top:none;borter-bottom:none; line-height:21px; background:#fff;">
				
				
			<div class="panelBar">
			<!--<ul class="toolBar">
				<li><a class="edit" href="?action=config&do=sysupdata&id={id}" target="dialog" height="450" width="650"><span>修改</span></a></li>
			</ul>-->
			</div>
		<table class="list" layouth="90" style="width:90%;">
			<thead>
				<tr>
					<th align="center">参数说明</th>
					<th align="center">参数值</th>
					<th align="center">变量名称</th>
					<th align="center">操作</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['title']; ?></td>
					<td style="width:60%;"><?php echo $this->_var['row']['value']; ?></td>
					<td><?php echo $this->_var['row']['varname']; ?></td>
					<td><a href="?action=config&do=sysupdata&id=<?php echo $this->_var['row']['id']; ?>" target="dialog" <?php echo $this->_var['row']['canshu']; ?> >设置</a></td>
				</tr>			
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</tbody>
		</table>
		
		<div class="panelBar" >
			<div class="pages" >
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>	
	 </div>
</div>
