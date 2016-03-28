<div class="page">
	<div class="pageContent">
		<form  action="?action=config&do=sysupdata" method="post" onsubmit="return validateCallback(this, dialogAjaxDone);" class="pageForm required-validate">	
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="varname" value="<?php echo $this->_var['row']['varname']; ?>" />
			<div class="pageFormContent" >
				<p>
					<label>参数名称：</label>
					<?php echo $this->_var['row']['title']; ?>
				</p>
				<div class="unit">
					<label>参数值：</label>
					<textarea name="value" class="required" rows="3" cols="40" ><?php echo $this->_var['row']['value']; ?></textarea>
				</div>
				<div class="unit">
					<label>说明：</label>
					<div style="line-height:1.8em;"><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></div>
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div>
					
				</ul>
			</div>
		</form>
	</div>
</div>