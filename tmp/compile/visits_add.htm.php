<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=visits&do=add" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />	
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
		
		<input type="hidden" name="clfs" value="<?php echo $this->_var['row']['clfs']; ?>" />
			<div class="pageFormContent" layoutH="56">
			<div class="tabs" currentIndex="0" eventType="click">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					<li><a href="javascript:;"><span>添加回访</span></a></li>
					<li><a href="javascript:;"><span>回访记录</span></a></li>
				</ul>
			</div>
		</div>
		<div class="tabsContent" style="height:100%;background:#fff;">
			<div>
				<div class="unit">
					<label>客户名称：</label>
					<input name="name" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>"  disabled="true"/>
				</div>
				<div class="unit">
					<label>客户电话：</label>
					<input name="tel" type="text" size="30" value="<?php echo $this->_var['row']['tel']; ?>"  disabled="true"/>
				</div>
				<div class="unit">
				<label>客户满意度：</label>
				<input name="pingjia" type="radio" value="很满意" />很满意<input name="pingjia" type="radio" value="一般" />一般<input name="pingjia" type="radio" value="较差" />较差
				</div>
				<div class="unit">
				<label>回访备注：</label>
					<dd><textarea name="intro" cols="50" rows="5"></textarea></dd>
				</div>
				<div class="unit">
					<label>下次回访：</label>
					<input name="visits_at"  type="text" size="9" class="date" readonly="true"/><span class="inputInfo">下次回访时间提醒，系统会在那天提醒你</span>
				</div>
			</div>
			<div>
				<div>
				<iframe
src="?action=visits&do=chaxun1&id=<?php echo $this->_var['row']['id']; ?>" width="100%" height="170px" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
				</div>
			</div>
				
			</div>
			<div class="tabsFooter">
				<div class="tabsFooterContent"></div>
			</div>
			</div></div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>