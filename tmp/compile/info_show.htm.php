<style type="text/css">
<!--
 .list{line-height:22px;padding-bottom:5px;color:#444;}
 .list span{color:#000;}
 h2 a{color:#f00;font-weight:300;}
-->
</style>
<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="56">
				<div>
					<h2>预约详情：<span style="color:#f00;"><?php echo $this->_var['row']['levelid_txt']; ?></span> 卡号：<?php echo $this->_var['row']['card']; ?> <?php echo $this->_var['row']['parentid_cn']; ?></h2>
					<div class="divider">divider</div>
					<div class="list"><?php echo $this->_var['row']['created_at']; ?><span> &#9758;客户：</span><?php echo $this->_var['row']['name']; ?><span> &#9758;客户电话：</span><?php echo $this->_var['row']['tel']; ?><span> &#9758;登记人：</span><?php echo $this->_var['row']['salesid_txt']; ?><span> &#9758;拜访次数：</span><?php echo $this->_var['row']['visitnum']; ?><span> &#9758;预约时间：</span><span style="color:#f00;"><?php echo $this->_var['row']['yy_at']; ?></span><span> &#9758;区域：</span><?php echo $this->_var['row']['areaid_txt']; ?><span> &#9758;预约方式：</span><?php echo $this->_var['row']['typeid_txt']; ?><span> &#9758;预约科室：</span><?php echo $this->_var['row']['productid_txt']; ?><span> &#9758;预约医生：</span><?php echo $this->_var['row']['doctorid_txt']; ?><span> &#9758;整形项目：</span><?php echo $this->_var['row']['zxxm']; ?><span> &#9758;客户邮箱--</span><?php echo $this->_var['row']['mail']; ?><span> &#9758;QQ号：</span><?php echo $this->_var['row']['qq']; ?><span> &#9758;客户地址--</span><?php echo $this->_var['row']['address']; ?><span> &#9758;关键字：</span><?php echo $this->_var['row']['keyword']; ?></div>
					
				</div>
				<div style="clear:both;line-height:22px;"><span> &#9758;预约备注：</span><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></div>
				<h2>来院情况：</h2>
				<div class="divider">divider</div>
				<div style="height:85x;overflow:hidden;">
				<iframe
src="?action=sell&do=chaxun1&id=<?php echo $this->_var['row']['id']; ?>" width="100%" height="100%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
				</div>
				<h2>派单情况：</h2>
				<div class="divider">divider</div>
				<div style="height:85x;overflow:hidden;">
				<iframe
src="?action=zhiliao&do=chaxun1&id=<?php echo $this->_var['row']['id']; ?>" width="100%" height="100%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
				</div>
				<h2>回访情况：<a href="?action=visits&do=new&id=<?php echo $this->_var['row']['id']; ?>" target="dialog">>>增加回访</a></h2>
				<div class="divider">divider</div>
				<div style="height:85x;overflow:hidden;">
				<iframe
src="?action=visits&do=chaxun1&id=<?php echo $this->_var['row']['id']; ?>" width="100%" height="100%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
				</div>
				<h2>消费情况</h2>
				<div class="divider">divider</div>
				<div style="height:85x;overflow:hidden;">
				<iframe
src="?action=money&do=chaxun1&id=<?php echo $this->_var['row']['id']; ?>" width="100%" height="100%" frameborder="no" background="translation" border="0" marginwidth="0" marginheight="0" scrolling="no"> </iframe>
				</div>
			</div>
	</div>
</div>
