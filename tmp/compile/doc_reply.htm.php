<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=doc&do=reply" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="hid" value="<?php echo $this->_var['row']['hid']; ?>" />	
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>回复内容：</label>
					<textarea class="xheditor" rows="10" cols="60" class="textInput" name="intro_r" tools="Bold,FontColor,Emot,Img"></textarea>
				</p>
				
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit" >发表</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>