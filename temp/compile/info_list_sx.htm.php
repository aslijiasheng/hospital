<style type="text/css">
<!--
.list{float:left;width:100%;}
.list li{width: 200px;float:left;margin-top:8px;}
.pageContent{}
a.an{background:#555;display:block;width: 90%;padding:2px 4px;color:#fff;cursor:pointer;color:#fff;line-height:20px;}
-->
</style>
<form id="pagerForm" method="post" action="?action=info&do=listsx">
	<input type="hidden" name="pageNum" value="1" />
	<input type="hidden" name="levelid"  value="<?php echo $this->_var['levelid'];?>"/>
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return dwzSearch(this, 'dialog');" action="?action=info&do=listsx" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名#电话#ID:<input type="text" name="nt" size="10"/>
					</td>
					<td>
						单位#地址:<input type="text" name="address" size="20"/>
					</td>
					<td>
						客户级别:<?php echo $this->_var['levelid_cn']; ?>
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
		<div class="table" layoutH="70">
		<div class="list">
		<ul>
		<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
		 <li><a class="an" href="#" onclick="$.bringBack({id:'<?php echo $this->_var['row']['id']; ?>', name:'<?php echo $this->_var['row']['name']; ?>(<?php echo $this->_var['row']['address']; ?>)'})"><?php echo $this->_var['row']['name']; ?>|<?php echo $this->_var['row']['id']; ?>(<?php echo $this->_var['row']['tel']; ?>)<br/><?php echo $this->_var['row']['address']; ?></a></li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		</ul>

		</div>

		</div>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="dialog" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="50" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
</div>