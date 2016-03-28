<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=smsmail&do=smslmxgu" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
			<div class="pageFormContent" >
				<div class="unit">
					<label>栏目名称：</label>
					<input type="text" name="title" class="required" size="30" value=""/>
				</div>
				<div class="unit">
					<label>选择要修改栏目：</label>
				<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<input type="radio" name="typeid" value="<?php echo $this->_var['row']['id']; ?>"/><?php echo $this->_var['row']['title']; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
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