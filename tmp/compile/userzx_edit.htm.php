<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=user&do=updatazx" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
			<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>用户名：</label>
					<input type="text" name="zxname" class="required" size="30" value="<?php echo $this->_var['row']['zxname']; ?>" />
				</p>
				<p>
					<label>所属科室：</label>
					<?php echo $this->_var['type_ks_cn']; ?>
				</p>
				<p>
					<label class="required">状态：</label>
                    <input type="radio" name="free"  value="0" <?php echo $this->_var['row']['checked0']; ?> />解冻
                    <input type="radio" name="free"  value="1" <?php echo $this->_var['row']['checked1']; ?> />冻结
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