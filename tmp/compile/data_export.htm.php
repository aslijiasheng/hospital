
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=data&do=export" >
		<input type="hidden" name="mt" value="1" />
			<div class="pageFormContent" layoutH="56">
			<font style="color:#f00">说明：本功能只能导出电话数据，方便短信群发用。请按要求选择</font>
			<div class="divider">divider</div>
				<div class="unit">
					<label>登记时间：</label><input type="text" name="time_start" size="9" class="date" readonly="true" />
						<span style="float:left;width:12px;text-align:center;"> - </span><input type="text" name="time_over" size="9" class="date" readonly="true" />
				</div>
				<div class="unit">
				<label>来院情况：</label>
					<input type="radio" name="visitnum"  value=">=" />已到院
						<input type="radio" name="visitnum"  value="<" />未到院
				</div>
				<div class="unit">
				<label>预约选项：</label>
					<?php echo $this->_var['salesid_cn']; ?><span style="float:left;width:12px;text-align:center;"> - </span><?php echo $this->_var['typeid_cn']; ?><span style="float:left;width:12px;text-align:center;"> - </span><?php echo $this->_var['levelid_cn']; ?><span style="float:left;width:12px;text-align:center;"> - </span><?php echo $this->_var['areaid_cn']; ?>	
				</div>
				<div class="unit">
				<label>号码选项：</label>
					<input type="checkbox" name="tel"  value="1" checked/>去除空值号码
					<input type="checkbox" name="tel2"  value="1" checked/>去除重复号码
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit" >导出</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>