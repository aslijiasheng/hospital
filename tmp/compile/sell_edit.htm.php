<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sell&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?>
					<a href="?action=info&do=show&id=<?php echo $this->_var['row']['infoid']; ?>" style="float:right;color:#f00;" target="dialog">查看预约资料</a>
				</div>
				 <p>
					<label >到诊情况：</label>
                    <input type="radio" name="fz"  value="1" <?php echo $this->_var['row']['checked1']; ?>/>初诊
                    <input type="radio" name="fz"  value="2" <?php echo $this->_var['row']['checked2']; ?>/>复诊
					<input type="radio" name="fz"  value="0" <?php echo $this->_var['row']['checked0']; ?>/>不详
				</p>
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


