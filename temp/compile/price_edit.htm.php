<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=config&do=priceedit" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);" >
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<p>
					<label>名称：</label>
					<input type="text" name="item" class="required" size="30" value="<?php echo $this->_var['row']['item']; ?>"/>
				</p>
				<div class="unit">
					<label>价格：</label>
					<input type="text" name="price" size="30" value="<?php echo $this->_var['row']['price']; ?>"/>
					<span class="inputInfo">价格区间用英文"-"分开，如1000-2000</span>
				</div>
				<p><label>栏目：</label>
					<?php echo $this->_var['priceid_cn']; ?>
				</p>
				<dl>
					<dt>备注：</dt>
					<dd><textarea  name="intro" rows="6" cols="45" ><?php echo $this->_var['row']['intro']; ?></textarea></dd>
				</dl>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>