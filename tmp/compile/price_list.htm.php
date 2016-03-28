<style type="text/css">
<!--
.tree a.rt{float:right;width:50px;}
-->
</style>
<form id="pagerForm" method="post" action="?action=config&do=pricelist">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return navTabSearch(this);" action="?action=config&do=pricelist" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						项目名称:<input type="text" name="item" size="20"/>
					</td>
					<td>
						<?php echo $this->_var['priceid_cn']; ?>
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
				<li><a class="add" href="tpl/price/price_col_new.htm" target="dialog" rel="pricenew"><span>添加</span></a></li>
				<li><a class="add" href="?action=config&do=pricecoledit&id={id}" target="dialog" rel="pricenew"><span>修改</span></a></li>
			</ul></div>
			<ul class="tree treeFolder " layouth="63">
				<li><a href="javascript">价目分类</a>
						<ul>		
							<?php $_from = $this->_var['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
							<li><a href="?action=config&do=pricelist&tid=<?php echo $this->_var['row']['id']; ?>"  target="ajax" rel="priceBox"><?php echo $this->_var['row']['title']; ?></a></li>
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</li>
			</ul>
			</div>

			<div id="priceBox" class="unitBox" style="float:left; width:81%; border:solid 1px #b8d0d6;border-top:none;borter-bottom:none; line-height:21px; background:#fff;">
				
				
			<div class="panelBar">
			<ul class="toolBar">
				<li class="line">line</li>
				<li><a class="add" href="?action=config&do=pricenew" target="dialog" ><span>添加</span></a></li>
				<li><a class="edit" href="?action=config&do=priceedit&id={id}" target="dialog"><span>修改</span></a></li>
				<li><a class="delete" href="?action=config&do=pricedel&id={id}" target="ajaxTodo" title="您确定要删除吗?"><span>删除</span></a></li>
				<li class="line">line</li>
			</ul>
			</div>
		<table class="table" layouth="112" style="width:90%">
			<thead>
				<tr>
					<th align="center">ID</th>
					<th align="center">名称</th>
					<th align="center">价格</th>
					<th align="center" style="width:400px;">备注</th>
					<th align="center">创建时间</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr class="edit" target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td class="id"><?php echo $this->_var['row']['id']; ?></td>
					<td><?php echo $this->_var['row']['item']; ?></td>
					<td><?php echo $this->_var['row']['price']; ?></td>
					<td><?php echo $this->_var['row']['intro']; ?></td>
					<td class="id"><?php echo $this->_var['row']['created_at']; ?></td>
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