<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=user&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>用户名：</label>
					<input type="text" name="username" class="required" size="30" value=""/>
				</p>
				<p>
					<label>密 码：</label>
					<input name="password" class="required" type="password" size="30"/>
				</p>
				<p>
					<label>联系电话：</label>
					<input name="tel" size="30" value="" />
				</p>
				<p>
					<label>用户组：</label>
					<?php echo $this->_var['select_role_cn']; ?>
				</p>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>