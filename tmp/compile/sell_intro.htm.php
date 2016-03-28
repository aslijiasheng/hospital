<style type="text/css">
	<!--
	.accordionContent{font-size:12px;}
	.accordionContent .nr{padding:3px;line-height:24px;width:95%;height: 92%;overflow:hidden;}
	-->
</style>


<div class="accordion" >
		<div class="accordionHeader">
			<h2>更多信息</h2>
		</div>
		<div class="accordionContent" layouth="146">
		<div class="nr">
		来访备注：<?php echo $this->_var['row']['intro']; ?></br>
		预约信息：</br>
		<iframe
src="?action=info&do=chaxun1&id=<?php echo $this->_var['row']['infoid']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
		<div class="accordionHeader">
			<h2>回访记录</h2>
		</div>
		<div class="accordionContent" layouth="146">
			<div class="nr"><iframe
src="?action=visits&do=chaxun1&id=<?php echo $this->_var['row']['infoid']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
	</div>