<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=info&do=giveup" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />	
		<input type="hidden" name="salesid" value="<?php echo $this->_var['row']['salesid']; ?>"/>
		<input type="hidden" name="salesid_txt" value="<?php echo $this->_var['row']['salesid_txt']; ?>"/>
		<input type="hidden" name="add" value="add"/>
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?>
				</div>
				<div class="unit" id="fqyy">
					<label >放弃原因：</label>
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