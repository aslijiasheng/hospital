<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=config&do=new" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>名称：</label>
					<input type="text" name="title" class="required" size="30" value=""/>
				</p>
				<p>
					<label>类型：</label>
					<?php echo $this->_var['select_type_cn']; ?>
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