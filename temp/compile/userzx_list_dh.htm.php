<style type="text/css">
<!--
.list{float:left;width:100%;}
.list li{width: 110px;float:left;margin-top:8px;}
.pageContent{}
-->
</style>
<form id="pagerForm" method="post" action="?action=user&do=listdh">
	<input type="hidden" name="pageNum" value="1" />
    <input type="hidden" name="numPerPage" value="20" />
</form>

<div class="page">
	<div class="pageHeader">
		<form onsubmit="return dwzSearch(this, 'dialog');" action="?action=user&do=listzxdh" method="post">
		<div class="searchBar">
			<table class="searchContent">
				<tr>
					<td>
						姓名:<input type="text" name="zxname" size="10"/>
					</td>
					<td>
						所属科室:<?php echo $this->_var['type_ks_cn']; ?>
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
		<div class="table" layoutH="118">
		<div class="list">
			<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
				
					<li ><input type="checkbox" name="orgId" value="{orgName:'<?php echo $this->_var['row']['zxname']; ?>', orgxh:'<?php echo $this->_var['row']['id']; ?>'}"/>
					<?php echo $this->_var['row']['zxname']; ?></li>
						
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</div>

		<input type="checkbox" class="checkboxCtrl" group="orgId" />全选
		</div>
		<div class="panelBar">
			<div class="pages">
				<span>共<?php echo $this->_var['total']; ?>条</span>
			</div>
			
			<div class="pagination" targetType="navTab" totalCount="<?php echo $this->_var['total']; ?>" numPerPage="20" pageNumShown="10" currentPage="<?php echo $this->_var['pageNum']; ?>"></div>

		</div>
	</div>
	<div class="formBar">
			<ul>
				<li><div class="button"><div class="buttonContent"><button type="button" multLookup="orgId" warn="请选择">选择带回</button></div></div></li>
			</ul>
		</div>
</div>