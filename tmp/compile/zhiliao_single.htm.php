
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=zhiliao&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="kh.infoid" value="<?php echo $this->_var['row']['infoid']; ?>" />
		<input type="hidden" name="kh.sellid" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div  >
					<label>客户名称：</label>
					<input name="kh.name"  type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" class="required" readonly/>	
					<a class="btnLook" href="index.php?action=sell&ms=dy"  lookupGroup="kh" <?php echo $this->_var['row']['xs2']; ?> >添加记录》》显示昨天和今天到院客人</a>
					<span class="inputInfo" <?php echo $this->_var['row']['xs2']; ?> >(通过查找回带当天到院客人)</span>
					</div>
					<div class="unit">
					<label>到诊详细：</label>
					 <input type="text" name="kh.tel"  size="30" value="&#9758;<?php echo $this->_var['row']['tel']; ?>&#9758;<?php echo $this->_var['row']['xb']; ?>"  readonly/>
				    </div>
					<div class="divider d">divider</div>
					<div class="unit">
					<label class="required">成交模式：</label>
                    <input type="radio" name="state"  value="1" onclick="htmer.style.display=''" checked="checked"/>已成交派单
                    <input type="radio" name="state"  value="2" onclick="htmer.style.display='none'" />未成交备注
				</div>
				<div id="htmer">
					<div class="unit">
					<label>治疗时间：</label>
					<input name="zhiliao_at"  type="text" size="30" class="date" dateFmt="yyyy-MM-dd HH:mm:ss" readonly="true"/>
					<span class="inputInfo">预约治疗大概时间.没有就不用填了</span>
				    </div>
			
				<div class="divider d">divider</div>
				<div class="unit">
				<label>科室选择：</label>
				<?php echo $this->_var['product_cn']; ?>
				</div>
				<div class="unit">
				  <label>选择医生：</label>
				<?php echo $this->_var['doctor_cn']; ?>
				</div>
				</div>
				<div class="unit">
					<label>备注：</label>
					<textarea name="intro"  cols="40" rows="4"></textarea>
				</div>
		</div>

			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">提交</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>

