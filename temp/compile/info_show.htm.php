<style type="text/css">
<!--
 .list{line-height:22px;padding-bottom:5px;color:#444;}
 .list span{color:#000;}
 h2 a{color:#f00;font-weight:300;}
 p,.unit{line-height:20px;}
 h2{margin-top:10px;}
 label,.unit span{color:#444;}
 .info{float:left;height: auto;}
  .info p{line-height:22px;width: 98%;height: 100%;clear:both;margin-bottom:8px;}
-->
</style>
<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="40">
				<div class="unit">
					<h2>预约详情：<span style="color:#f00;"><?php echo $this->_var['row']['levelid_txt']; ?></span> 卡号：<?php echo $this->_var['row']['card']; ?> <?php echo $this->_var['row']['parentid_cn']; ?></h2>
					<div class="divider">divider</div>
					<div class="unit">
						<label>姓名：</label>
						<?php echo $this->_var['row']['name']; ?> (<span>预约号：</span>mt<?php echo $this->_var['row']['id']; ?> | <span>登记时间：</span><?php echo $this->_var['row']['created_at']; ?> | <span>挂号次数</span>：<?php echo $this->_var['row']['visitnum']; ?>)
					</div>
					<div class="divider">divider</div>
					<p>
						<label>性别：</label>
						<?php echo $this->_var['row']['xb']; ?>
					</p>
					<p >
						<label>预约上门时间：</label>
						<span style="color:#f00;"><?php echo $this->_var['row']['yy_at']; ?></span>
					</p>
					<p>
						<label>年龄：</label>
						<?php echo $this->_var['row']['nl']; ?>
					</p>
					<p>
						<label>电话：</label>
						<?php echo $this->_var['row']['tel']; ?>
					</p>
					<p>
						<label>客服(登记人)：</label>
						<?php echo $this->_var['row']['salesid_txt']; ?>
					</p>
					<p>
						<label>来源：</label>
						<?php echo $this->_var['row']['typeid_txt']; ?>
					</p>
					<p>
						<label>地区：</label>
						<?php echo $this->_var['row']['areaid_txt']; ?>
					</p>
					<p>
						<label>预约科室：</label>
						<?php echo $this->_var['row']['productid_txt']; ?>
					</p>
					<p>
						<label>预约专家：</label>
						<?php echo $this->_var['row']['doctorid_txt']; ?>
					</p>
					<p>
						<label>预约项目：</label>
						<?php echo $this->_var['row']['zxxm']; ?>
					</p>
					<p>
						<label>来源关键词：</label>
						<?php echo $this->_var['row']['keyword']; ?>
					</p>
					<div class="divider">divider</div>
					<p>
						<label>客户邮箱：</label>
						<?php echo $this->_var['row']['mail']; ?>
					</p>
					<p>
						<label>Q Q  号：</label>
						<?php echo $this->_var['row']['qq']; ?>
					</p>
					<p>
						<label>客户地址：</label>
						<?php echo $this->_var['row']['address']; ?>
					</p>
					<div class="divider">divider</div>
					
				</div>
				<div class="unit">
					<label>预约备注：</label>
					<div class="info"><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></div>
				</div>
				<div class="divider">divider</div>
				<h2>挂号情况：</h2>
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
	
				</div>
			</div>
	</div>
</div>
