<style type="text/css">
<!--
li{line-height:24px;list-style:none;}
-->
</style>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=config&do=sms_sz" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />	
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
			<div class="pageFormContent" layoutH="56">
			<li >1,彩信猫模式：发送快，可以单发，可以发彩信，二维码等（需要购买设备和卡），不能群发短信</li>
			<li >2,短信平台通道模式：发送偏慢，可以单发，群发短信，不能发彩信，二维码等（注册充值后便可使用）。</li>
				<div class="unit">
					<label class="required">当前模式：</label>
                    <input name="dqms"  type="text" size="30" value="<?php echo $this->_var['row']['dqms']; ?>" readonly/>
				</div>
				<div class="unit">
					<label class="required">更改模式：</label>
                    <input type="radio" name="ms"  value="1" onclick="htmer.style.display='',htmer2.style.display='none'" />彩信猫模式
                    <input type="radio" name="ms"  value="2" onclick="htmer2.style.display='',htmer.style.display='none'" />短信平台通道模式
				</div>
				<div class="unit" id="htmer" style="display:none">
					<label>模式说明：</label>
					发送快，可以单发，可以发彩信，二维码等（需要购买设备和卡）<br/>
					联系模式：
				</div>
				<div class="unit" id="htmer2" style="display:none">
				 <div>
					<label>用户名：</label>
					<input type="text" name="username" class="required" size="30" value="<?php echo $this->_var['row']['username']; ?>"/>
				 </div>
				 <div>
					<label>密码：</label>
					<input type="text" name="password" class="required" size="30" value="<?php echo $this->_var['row']['password']; ?>"/>
				 </div>
				 <div class="unit">
				<div class="divider">divider</div>
				<h2>账户余额：</h2>
				<div style="height:85x;overflow:hidden;">
				
				</div></div>
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit" >保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>