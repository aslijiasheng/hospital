<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=user&do=xlhad" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>机器码：</label>
					<?php echo $this->_var['row']['jqm']; ?>
				</p>
			    <p>
					<label>序列号：</label>
					<input name="xlh" class="required" type="text" size="30"  alt=""/>
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