<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=info&do=zyy" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="salesid" value="<?php echo $this->_var['row']['salesid']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?>
				</div>
				<div class="unit">
					<label>预约时间：</label>
					<input name="yy_at"  type="text" size="15" class="date" value="<?php echo $this->_var['row']['yy_at']; ?>" readonly="true"/>
					<a class="inputDateButton" href="javascript:;">选择</a>
				</div>
				<div class="unit" id="fqyy">
					<label >预约备注：</label>
					<textarea name="intro" rows="5" cols="50" ></textarea>
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit" >提交</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>