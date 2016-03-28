<style type="text/css">
<!--

dd {width:542px;margin-bottom:10px;}
dd span	{line-height:22px;}
dd span b{}
-->
</style>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=smsmail&do=smslmdel" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
			<div class="pageFormContent" layoutH="56">
				
					<div class="divider d">divider</div>
					<dl style="width:95%;">
					<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?> 
					<dd style="width:100%;margin-left:30px;color:#f00;"><?php echo $this->_var['row']['MsgArrivedTime']; ?><span>：<b><?php echo empty($this->_var['row']['name']) ? '无' : $this->_var['row']['name']; ?></b><br/><?php echo $this->_var['row']['MsgTitle']; ?></span></dd>
					
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					
					<?php $_from = $this->_var['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row2');if (count($_from)):
    foreach ($_from AS $this->_var['row2']):
?> 
					<dd style="width:100%;"><?php echo $this->_var['row2']['SendTime']; ?><span>：<b><?php echo $this->_var['row2']['salesid2']; ?></b><br/><?php echo $this->_var['row2']['MsgTitle']; ?></span></dd>
					
					<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
					</dl>
				
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">删除</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>
<script type='text/javascript'>
var dl = document.getElementsByTagName('dl')[0];
var lis = dl.getElementsByTagName('dd');
var ux = [];
for (var i=0; i<lis.length; i++){
    var tmp = {};
    tmp.dom = lis[i];
    tmp.date = new Date(lis[i].firstChild.data.replace(/-/g,'/'));
    ux.push(tmp);
}
ux.sort(function(a,b){
    return a.date - b.date;
});
for (var i=0; i<ux.length; i++){
    dl.appendChild(ux[i].dom);
}
</script>