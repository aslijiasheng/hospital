<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=config&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
			<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>名称：</label>
					<input type="text" name="title" class="required" size="30" value="<?php echo $this->_var['row']['title']; ?>"/>
				</p>
				<p>
					<label>类型：</label>
					<?php echo $this->_var['select_type_cn']; ?>
				</p>
				<p>
					<label class="required">是否可用：</label>
                    <input type="radio" name="xs"  value="0" <?php echo $this->_var['row']['checked0']; ?> />可用
                    <input type="radio" name="xs"  value="1" <?php echo $this->_var['row']['checked1']; ?> />不可用
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