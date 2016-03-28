<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sell&do=edit" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<input type="hidden" name="updata" value="updata" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?>
					<a href="?action=info&do=show&id=<?php echo $this->_var['row']['infoid']; ?>" style="float:right;color:#f00;" target="dialog">查看预约资料</a>
				</div>
				 <p>
					<label >到诊情况：</label>
                     <?php echo $this->_var['diagnosis_cn']; ?>
				</p>
				<div class="unit"  >
					<label>治疗项目：</label>
					<input name="item" type="text" size="30" value="<?php echo $this->_var['row']['item']; ?>" alt=""/>
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
					<label>来访备注：</label>
					<textarea name="intro"  cols="45" rows="3"><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></textarea>
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


