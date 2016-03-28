<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=user&do=updatapass" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
			<input type="text" name="id" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>用户名：</label>
					<input type="text" name="username" class="required" size="30" value="<?php echo $_SESSION['username']; ?>" readonly/>
				</p>
				<p>
					<label>密 码：</label>
					<input name="password" class="required" type="password" size="30"/>
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