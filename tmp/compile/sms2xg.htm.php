<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=smsmail&do=sms2xgu" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" >
				<div class="unit">
					<label>短信内容：</label>
					<textarea name="intro" class="required" rows="6" cols="50" ><?php echo $this->_var['row']['intro']; ?></textarea>
				</div>
				<div class="unit">
					<label>栏目选择：</label>
					<select name="typeid" class="input required">
					<option value="<?php echo $this->_var['row']['id']; ?>" selected="selected"><?php echo $this->_var['row']['title_mr']; ?></option>
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_50003600_1372225315');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_50003600_1372225315']):
?>
					<option value="<?php echo $this->_var['row_0_50003600_1372225315']['id']; ?>"><?php echo $this->_var['row_0_50003600_1372225315']['title']; ?></option>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</select><span class="inputInfo"><a href="tpl/sms_lm_new.htm" target="ajax" rel="jbsxBox">+增加栏目</a></span>
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>