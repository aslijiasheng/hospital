<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=money&do=zuofeixr" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>密码：</label>
					<input name="pw" size="30" value="" type="password" class="required alphanumeric" />
				</p>
				<p>请输入操作密码</p>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>