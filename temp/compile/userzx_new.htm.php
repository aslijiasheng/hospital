<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=user&do=addzx" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>工作人：</label>
					<input type="text" name="zxname" class="required" size="30" value=""/>
				</p>
				<div class="unit">
					<label>所属科室：</label>
					<?php echo $this->_var['type_ks_cn']; ?>
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