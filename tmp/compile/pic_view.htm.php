<style type="text/css">
<!--
.pageContent{position:relative;}
.sortDrag{float:left;}
.box{padding:10px;}
.tp{overflow:hidden;width:65%;clear:both;}
.tp h1{clear:both;line-height:30px;font-weight:bold;font-size:14px;}
.tp img{ 
max-width:100px;height:auto; border:1px solid #b8d0d6;padding:5px;margin-right:8px;margin-bottom:8px;float:left;}
 
 .sortDrag{}
 .tp2{height:260px;width:400px;overflow:hidden;top:80px;right:25px;position:fixed;background:url(themes/images/picbg.png) no-repeat;border:1px solid #ccc;}
 .tp2_1{height:260px;width:400px;overflow:hidden;top:341px;right:25px;position:fixed;background:url(themes/images/picbg2.png) no-repeat;border:1px solid #ccc;}
 .tp .tpbox{cursor:pointer;float:left;width: 120px;}
-->
</style>
<div class="pageContent" layoutH="25">
		<div class="panelBar">
			<ul class="toolBar">
			    <li><a class="edit" href="?action=sell&do=tpyl&wz={id}" target="dialog" max="true"><span>看大图</span></a><span>：图片加载慢，请稍等</span></li>
			</ul>
		</div>
		
		<div class="box">
		<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row');if (count($_from)):
    foreach ($_from AS $this->_var['row']):
?>
		
		<div class="sortDrag tp" style="display:<?php echo $this->_var['row']['kj']; ?>;">
		<h1 ><?php echo $this->_var['row']['created_at']; ?>：</h1>
		<?php echo $this->_var['row']['tp1']; ?>
		</div>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></div>

		<div class="sortDrag tp2" ></div>
		<div class="sortDrag tp2_1" ></div>
</div>