<div class="page" >
	<div class="pageContent" >		
		<form method="post" action="?action=smsmail&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />
		<div class="pageFormContent" >
				<div class="unit">
					<label>客户名称：</label>
					<input type="text" id="name" name="name" value="<?php echo $this->_var['row']['name']; ?>"/>
					<span class="inputInfo"><?php echo $this->_var['row']['zt']; ?></span>
				</div>
				<div class="unit">
				<label>收件邮箱：</label>
				<input type="text" id="mail" name="mail" value="<?php echo $this->_var['row']['mail']; ?>"/>
				</div>
				<div class="unit">
				<label>发件人名称：</label>
				<input type="text" id="fj" name="fj" />
				<span class="inputInfo">例：百度网</span>
				</div>
				
				<div class="unit">
				<label>邮件标题：</label>
				<input type="text" id="title" name="title" style="width:280px;"/>
				</div>
				<div class="unit">
				<label>正文提示：</label>
				<input type="text" class="inputstyle" id="ts" name="ts" />
				<span class="inputInfo">可不填,</span>
				</div>
				<div class="unit">
				<label>邮件内容：</label>
				<textarea class="editor" name="zw" id="zw" rows="6" cols="40" tools="mini"></textarea>
				</div>
			</div>

			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">发送</button></div></div>
				</ul>
			</div>	  
		</form>
	</div>
</div>

