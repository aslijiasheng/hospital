<style type="text/css">
<!--
a.an{background:#555;display:inline;padding:2px 4px;color:#fff;cursor:pointer;}
-->
</style>
<script type="text/javascript">
	function qq(p)
	{
		document.getElementById("i1").value=document.getElementById("e4").value;
	}
</script>
<div class="page">

	<div class="pageContent">
		<form method="post" action="?action=smsmail&do=smsyhq_fs" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="yyq"  id="e4" value="<?php echo $this->_var['row']['yyq']; ?>"/>
		<div class="pageFormContent" layoutH="56">
				<div>
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?><?php echo $this->_var['row']['sj']; ?>
				</div>
				<div class="unit">
					<label>客户电话：</label>
					<input name="tel" type="text" size="30" value="<?php echo $this->_var['row']['tel']; ?>" class="required"/>
					<span class="inputInfo">多号码只发第一个号码；</span>
				</div>
				<div class="unit">
					<label>优惠券号：</label>
					<input name="yhq" class="required" type="text" size="30" id="i1" readonly="true" />
					<span class="inputInfo"><a class="an" onclick="qq()" ><span>生成优惠券</span></a></span>
				</div>
				<div>
					<label>其他信息：</label>
					<input name="sms.id" value="" type="hidden"/>
					<textarea name="sms.intro" rows="6" cols="40" ></textarea>
					<span class="inputInfo"><a class="an" href="?action=smsmail&do=smsmb&id=" lookupGroup="sms" ><span>短信库</span></a></span>
				</div>
				<div class="unit">
					<label>有效期：</label>
					<input name="day" type="text" size="10" class="digits" />
					<span class="inputInfo">从发放时间起，至多少天后到期</span>
				</div>
				<div class="unit">
					<label>分类备注：</label>
					<input name="lx" type="text" size="30"  />
					<span class="inputInfo">本信息不随短信发送，方便优惠券分类</span>
				</div>
			</div>
			
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">发送</button></div></div></li>
				</ul>
			</div>
		</form>
		
	</div>
</div>
 