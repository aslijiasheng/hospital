<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=smsmail&do=smslmdel" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
			<div class="pageFormContent" >
				<div class="unit">
					<label>选择要删除的栏目：</label>
				<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
					<input type="radio" name="typeid" value="<?php echo $this->_var['row']['id']; ?>"/><?php echo $this->_var['row']['title']; ?>
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">删除</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>