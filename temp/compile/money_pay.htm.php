<script type="text/javascript">
	function getResult(){
		document.getElementById("money_ys").value= Number(document.getElementById('money_ss').value) + Number(document.getElementById('yepay').value)+ Number(document.getElementById('money_qf').value);
		}
</script>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=money&do=payadd" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="sellid" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['infoid']; ?>" />
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
		<div class="pageFormContent" layoutH="56">
		 <div>客户名称：<?php echo $this->_var['row']['name']; ?> 账户余额：￥<?php echo empty($this->_var['row']['money']) ? '0' : $this->_var['row']['money']; ?>|欠费：￥<?php echo empty($this->_var['row']['moneyqf']) ? '0' : $this->_var['row']['moneyqf']; ?></div>
		<div class="tabs" currentIndex="0" eventType="click">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					<li><a href="javascript:;"><span>普通消费</span></a></li>
					<li><a href="javascript:;"><span>定金&充值</span></a></li>
					<li><a href="javascript:;"><span>还款&退款</span></a></li>
					<li><a href="javascript:;"><span>积分消费</span></a></li>
					<li><a href="javascript:;"><span>消费记录</span></a></li>
				</ul>
			</div>
		</div>
		<div class="tabsContent" style="height:auto;background:#fff;overflow:hidden;">
			<div>
				<div class="unit">
					<label>实收金额：</label>
					<span ><input name="money_ss" type="text" size="10" alt="现收" class="number" id="money_ss" onChange="getResult()"/></span>  
					<span><input name="yepay" type="text" size="10" alt="账户支付" class="number" id="yepay" onChange="getResult()"/></span>
				 </div>
				<div class="divider">divider</div>
				 <div class="unit">
					<label>本次欠费：</label>
					<input name="money_qf"  type="text" size="10" class="number" onChange="getResult()" id="money_qf"/>
				</div>
				<div class="divider">divider</div>
				 <div class="unit">
					<label>本次应收金额：</label>
					<input name="money_ys" id="money_ys" type="text" size="10" class="number" readonly="true"/>
					<span class="inputInfo">供参考用：不能修改</span>
				</div>
			</div>
			<div>
				<div class="unit">
					<label>预交定金：</label>
					<input name="money_dj" type="text" size="15" class="number" /><span class="inputInfo">数字只能是整数</span>
				</div>
				<div class="unit">
					<label>充值金额：</label>
					<input name="money_ad" type="text" size="15" class="number" /><span class="inputInfo">数字只能是整数</span>
				</div>
			</div>
			<div>
				<div class="unit">
					<label>还款金额：</label>
					<input name="money_hk"  type="text" size="10" class="number"/><span class="inputInfo">数字只能是整数</span> 
				</div>
				<div class="unit">
					<label>退款金额：</label>
					<span><input name="money_tk"  type="text" size="10" alt="退款" class="number" /></span>
					<span><input name="money_tk2" type="text" size="10" alt="账号金额退款" class="number" /></span> 
				</div>
			</div>
			<div>
				<div class="unit">
					<label>消费积分：</label>
					<input name="integ"  type="text" size="10" class="number"/> 
				</div>
			</div>
			<div>
				<iframe
src="?action=money&do=chaxun1&id=<?php echo $this->_var['row']['infoid']; ?>" width="100%" height="100%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
			</div>
		</div>
		<div class="tabsFooter">
			<div class="tabsFooterContent"></div>
		</div>
	</div>
		<div >
			<label>消费备注：</label>
			<textarea name="intro2"  cols="62" rows="5"></textarea>
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


