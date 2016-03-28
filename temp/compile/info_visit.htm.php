
<div class="page" id="ddd">
	<div class="pageContent">
		<form method="post" action="?action=info&do=visit" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="add" value="add" />
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
                    <?php echo $this->_var['diagnosis_cn']; ?>
				</div>
				<div class="unit"  >
					<label>治疗项目：</label>
					<input name="item" type="text" size="30" value="<?php echo $this->_var['row']['zxxm']; ?>" alt=""/>
				</div>
				<div class="unit"  >
					<label>科室选择：</label>
					<?php echo $this->_var['product_cn']; ?>
				</div>
				<div class="unit"  >
					<label>医生选择：</label>
					<?php echo $this->_var['doctor_cn']; ?>
				</div>
				<p>
					<label>挂号备注：</label>
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