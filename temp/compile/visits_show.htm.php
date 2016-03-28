<style type="text/css">
<!--
.wz{line-height:22px;}
-->
</style>
<div class="page">
	<div class="pageContent">
			<div class="pageFormContent" layoutH="56">
				<div class="unit">
					<label>客户名称：</label>
					<input name="name" type="text" size="30" value="<?php echo $this->_var['row']['name']; ?>" alt=""/>
				</div>
				<p>
					<label>客户电话：</label>
					<?php echo $this->_var['row']['tel']; ?>
				</p>
				<p>
					<label>回访人：</label>
					<?php echo $this->_var['row']['salesid_txt']; ?>
				</p>
				<p>
					<label>客人评价：</label>
					<?php echo $this->_var['row']['pingjia']; ?>
				</p>
				<p>
					<label>挂号次数：</label>
					<?php echo $this->_var['row']['visitnum']; ?>
				</p>
				<p>
					<label>备注：</label>
					<textarea class="editor" name="intro" rows="7" cols="50" tools="mini"><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></div>
				</p>
			</div>
	</div>
</div>