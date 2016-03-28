<form id="pagerForm" method="post" action="?action=config&do=pricelist">
	<input type="hidden" name="pageNum" value="1" />
</form>
<div class="page">
	<div class="pageHeader">
		<form onsubmit="return dialogSearch(this);" action="?action=config&do=pricelistmb" method="post">
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
		<table class="table" layouth="132" style="width:90%">
			<thead>
				<tr>
					<th align="center">名称</th>
					<th align="center">价格</th>
				</tr>
			</thead>
			<tbody>			
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				<tr class="edit" target="id" rel="<?php echo $this->_var['row']['id']; ?>" >
					<td><?php echo $this->_var['row']['item']; ?></td>
					<td><?php echo $this->_var['row']['price']; ?></td>
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