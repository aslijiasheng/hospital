<style type="text/css">
	<!--
	.accordionContent{font-size:12px;}
	.accordionContent .nr{line-height:24px;width:96%;height: 92%;overflow:hidden;}
	a.an{background:#555;display:inline;padding:2px 4px;color:#fff;cursor:pointer;}
	-->
</style>


<div class="accordion" >
		<div class="accordionHeader">
			<h2>更多信息</h2>
		</div>
		<div class="accordionContent" layouth="146">
		<div class="nr">姓名：<?php echo $this->_var['row']['name']; ?>&<?php echo $this->_var['row']['tel']; ?><br/>
		&#9758;<?php echo $this->_var['row']['intro']; ?>
		
		<div class="divider">divider</div>
		<span style="color:#f00;">来院记录》</span>
		<div class="nr"><iframe
src="?action=sell&do=chaxun1&id=<?php echo $this->_var['row']['id']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
		</div>
		
		<div class="accordionHeader">
			<h2>回访记录</h2>
		</div>
		<div class="accordionContent" layouth="146">
			<div class="nr"><iframe
src="?action=visits&do=chaxun1&id=<?php echo $this->_var['row']['id']; ?>" width="95%" height="95%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe></div>
		</div>
	</div>