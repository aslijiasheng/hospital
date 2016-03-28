<style type="text/css">
<!--
.smslist div{clear:both;padding-top:5px;}
a.an{background:#555;display:inline;padding:2px 4px;color:#fff;cursor:pointer;}
.ewm{background: url(<?php echo $this->_var['row']['cxdt']; ?>) center center no-repeat;}
.cxdt{background: url(<?php echo $this->_var['row']['ewmsrc']; ?>) center center no-repeat;}
-->
</style>
<script language="javascript">
function g(o){return document.getElementById(o);}
function aa(){
g('area').className='ewm';
}
function bb(){
g('area').className='cxdt';
}
</script>
<script type="text/javascript">
	
	function xx(p)
	{
		document.getElementById("i1").value=document.getElementById("e1").value;
	}
	function yy(p)
	{
		document.getElementById("i1").value=document.getElementById("e2").value;
	}
</script>
<div class="page">

	<div class="pageContent">
		<form method="post" action="?action=smsmail&do=sms_fs" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">		
		<input type="hidden" name="infoid" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="hyh"  id="e1" value="<?php echo $this->_var['row']['hyh']; ?>"/>
		<input type="hidden" name="yyh"  id="e2" value="<?php echo $this->_var['row']['yyh']; ?>"/>
		<input type="hidden" name="cxdt"  id="e3" value="<?php echo $this->_var['row']['cxdt']; ?>"/>
		
		<input type="hidden" name="clfs" value="<?php echo $this->_var['row']['clfs']; ?>" />
			<div class="pageFormContent" layoutH="56">
			<div class="tabs" currentIndex="0" eventType="click">
		<div class="tabsHeader">
			<div class="tabsHeaderContent">
				<ul>
					<li><a href="javascript:;"><span>发送短信</span></a></li>
					<li><a href="javascript:;"><span>发送彩信</span></a></li>
				</ul>
			</div>
		</div>
		<div class="tabsContent" style="height:100%;background:#fff;">
			<div class="smslist">
				<div>
					<label>客户名称：</label>
					<?php echo $this->_var['row']['name']; ?>
				</div>
				<div>
					<label>客户电话：</label>
					<input name="tel" type="text" size="30" value="<?php echo $this->_var['row']['tel']; ?>" class="required"/>
					<span class="inputInfo">多号码只发第一个号码；</span>
				</div>
				<div>
					<label>短信内容：</label>
					<input name="sms.id" value="" type="hidden"/>
					<textarea name="sms.intro" rows="6" cols="50" id="i1"><?php echo $this->_var['row']['idjf']; ?></textarea>
				</div>
				<div class="unit">
				<label></label>
				<a class="an" href="?action=smsmail&do=smsmb&id=" lookupGroup="sms" ><span>短信库</span></a>&#9786;
				<a class="an" onclick="yy()" ><span>发送预约号</span></a>&#9786;
				<a class="an" onclick="xx()" ><span>发送会员号</span></a>
				</div>
				<div class="unit"><label></label>
				<input type="radio" name="MsgType"  value="0" checked/>普通短信
				<input type="radio" name="MsgType"  value="3" />快闪短信
				</div>
			</div>
			<div>
			<style type="text/css">
			<!--
			.cxtp img{max-width:280px;height:auto;}
			-->
			</style>
				<div>
					<label>彩信内容：</label>
					<div id="area"  style="width:260px;height:160px;" ></div>
				</div>
				<div class="unit">
				<label></label>
				<input type="radio" name="MsgType" value="1,<?php echo $this->_var['row']['cxdt']; ?>" onclick="aa()" >彩信地图
				<input type="radio" name="MsgType" value="1,<?php echo $this->_var['row']['ewmsrc']; ?>" onclick="bb()">二维码
				<p><label></label>
				<input name="file2" type="file" />
				</p>
				</div>
			
			</div>
			</div>
			<div class="tabsFooter">
				<div class="tabsFooterContent"></div>
			</div>
			</div></div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">发送</button></div></div></li>
				</ul>
			</div>
		</form>
		
	</div>
</div>
 