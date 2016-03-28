<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=config&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>名称：</label>
					<input type="text" name="title" class="required" size="30" value=""/>
				</p>
				<p>
					<label>类型：</label>
					<?php echo $this->_var['select_type_cn']; ?>
				</p>
				<p>
					<label>类型：</label>
					<?php echo $this->_var['row']['xs1']; ?>
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