<script type="text/javascript">
function ReImgSize(){ 
for (j=0;j<document.images.length;j++) 
{ 
document.images[j].width=(document.images[j].width>135)?"135":document.images[j].width; 
} 
} 
</script>

<style type="text/css">
<!--
.tp{width: 100%;}
.tp dd{border:1px solid #b8d0d6;float:left;width: 150px;height:100%;padding:8px 0;text-align:center;overflow:hidden;margin-right:10px;}
.tp dd img{ 
max-width:134px;height:auto; }
.tp dd i{display:block;font-style:normal;}
 .list{line-height:22px;padding-bottom:5px;color:#444;}
 .list span{color:#000;}
 h2 a{color:#f00;font-weight:300;}
-->
</style>
<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="56">
				<div><h2>预约详情：</h2>
					<div class="divider">divider</div>
					<div class="list"><?php echo $this->_var['row']['created_at']; ?><span> &#9758;客户：</span><?php echo $this->_var['row']['name']; ?>
					<span> &#9758;电话：</span><?php echo $this->_var['row']['tel']; ?>
					<span> &#9758;接待人：</span><?php echo $this->_var['row']['salesid2_txt']; ?><span> &#9758;登记人：</span><?php echo $this->_var['row']['salesid_txt']; ?>
				    <span> &#9758;到诊情况：</span><?php echo empty($this->_var['row']['fz']) ? '不详' : $this->_var['row']['fz']; ?><span> &#9758;共来院：</span><?php echo $this->_var['row']['visitnum']; ?>次
					<span> &#9758;备注：</span><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?> </div>
				</div>
				<h2>本次派单情况：操作：<a href="?action=zhiliao&do=single&id=<?php echo $this->_var['row']['id']; ?>" target="dialog">>>派单</a></h2>
				<div class="divider">divider</div>
				<div style="height:40x;overflow:hidden;">
				<iframe
src="?action=zhiliao&do=chaxun2&id=<?php echo $this->_var['row']['id']; ?>" width="100%" height="40px" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
				</div>
				<h2>本次消费情况：操作：<a href="?action=money&do=pay&id=<?php echo $this->_var['row']['id']; ?>" target="dialog">>>收费</a></h2>
				<div class="divider">divider</div>
				<div style="height:40x;overflow:hidden;">
		
				</div>
				<h2>本次治疗图片：操作：<a href="?action=sell&do=tpad&id=<?php echo $this->_var['row']['id']; ?>" target="dialog">>>上传图片</a></h2>
				<div class="divider">divider</div>
				<p>
					<div class="tp">
					<?php echo $this->_var['row']['tp1']; ?></div>
				</p>
				
			</div>
	</div>
</div>