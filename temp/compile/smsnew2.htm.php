<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=smsmail&do=smsnew2add" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
			<div class="pageFormContent" >
				<div class="unit">
					<label>短信内容：</label>
					<textarea name="intro" class="required" rows="6" cols="50" ></textarea>
				</div>
				<div class="unit">
					<label>栏目选择：</label>
					<?php echo $this->_var['smslm_cn']; ?>
					</select><span class="inputInfo"><a href="tpl/sms_lm_new.htm" target="ajax" rel="jbsxBox">+增加栏目</a></span>
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