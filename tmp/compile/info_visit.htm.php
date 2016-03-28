
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=info&do=visitadd" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />	
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
			<div class="pageFormContent" layoutH="56">
			<?php echo $this->_var['row']['ts']; ?>
				<div class="unit">
					<label>客户名称：</label>
					<input name="name" class="required" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" alt=""/>
					<span class="inputInfo">这里修改客户名称</span> 
				</div>
				<div class="unit">
					<label class="required">到诊详细：</label>
                    <input type="radio" name="fz"  value="1" onclick="htmer.style.display=''" />初诊
                    <input type="radio" name="fz"  value="2" onclick="htmer.style.display='none'"/>复诊
					<input type="radio" name="fz"  value="0" onclick="htmer.style.display='none'"/>不详
				</div>
				<div class="unit" id="htmer" style="display:none">
					<label>来院渠道：</label>
					<?php echo $this->_var['typeid_cn']; ?>	<span class="inputInfo">如果不清楚(如其他)，请在备注里写明</span> 
				</div>
				<p>
					<label>来访备注：</label>
					<textarea rows="5" cols="60" class="textInput" name="intro" ></textarea>	
				</p>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit" >保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>