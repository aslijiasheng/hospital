<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=visits&do=updata" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="created_at" value="<?php echo $this->_var['row']['created_at']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?>
				</div>
				<div class="unit">
					<label class="required">评价：</label>
                    <input type="radio" name="pingjia"  value="很满意" <?php echo $this->_var['row']['checked0']; ?> />很满意
                    <input type="radio" name="pingjia"  value="一般" <?php echo $this->_var['row']['checked1']; ?> />一般
					<input type="radio" name="pingjia"  value="较差" <?php echo $this->_var['row']['checked2']; ?> />较差
				</div>
				<div class="unit">
					<label>回访备注：</label>
					<textarea class="editor" name="intro" rows="7" cols="50" tools="mini"><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></textarea>
				</div>
				<div class="unit">
					<label>下次回访：</label>
					<input name="visits_at"  type="text" size="9" class="date" value="<?php echo $this->_var['row']['visits_at']; ?>" readonly="true" /><span class="inputInfo">下次回访时间提醒，系统会在那天提醒你</span>
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


