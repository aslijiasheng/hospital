<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=info&do=updata2" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>客户信息：</label>
					<input name="name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>&<?php echo $this->_var['row']['tel']; ?>" alt=""/>	
				</p>
				<p>
					<label>身份证号：</label>
					<input name="Identity" class="" type="text" size="30" value="<?php echo $this->_var['row']['Identity']; ?>" alt=""/>
				</p>
				<p>
					<label>会员卡号：</label>
					<input name="card" class="" type="text" size="30" value="<?php echo $this->_var['row']['card']; ?>" alt=""/>
				</p>
				<div class="unit">
					<label>设置级别：</label>
					<?php echo $this->_var['levelid_cn']; ?>
					<span class="inputInfo">代理用户请设置为代理用户</span>
				</div>
				<p>
					<label>备注：</label>
					<textarea name="intro" rows="6" cols="50" ><?php echo $this->_var['row']['intro']; ?></textarea>
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