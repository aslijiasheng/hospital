<style type="text/css">
<!--
label{width: 50px;border:1px solid #fff;}
-->
</style>

<link rel="stylesheet" type="text/css" href="themes/cs_slider.css">
	
	<script type="text/javascript" src="javascripts/cs.slider.js"></script>

<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=doc&do=work_new" class="pageForm required-validate" onsubmit="return validateCallback(this, dialogAjaxDone);">
			<div class="pageFormContent" layoutH="56">
			
				<div class="unit">
					<label style="width: 80px">汇报标题：</label>
					<input name="Subject" class="required" type="text" style="width:75%" value="<?php echo $_SESSION['username']; ?>的工作报告" alt=""/>
				</div>
				<div class="unit">
					<label style="width: 80px">汇报对象：</label>
					<?php echo $this->_var['salesid_cn']; ?>
					<label style="width: 80px">汇报类型：</label>
					<?php echo $this->_var['workstyle_cn']; ?>	
				</div>
				<div class="divider d">divider</div>
				<table class="list nowrap itemDetail" addButton="增加工作小结++" width="95%">
						<thead>
							<tr>
								<th type="text" name="work.id[]" defaultVal="#index#" size="3" fieldClass="digits">序号</th>
								<th type="text" name="work.title[]" size="60" fieldClass="required">工作小结项目</th>
								<th type="slider" name="work.progress[]" size="10" fieldClass="easyui-slider" >完成进度</th>
								<th type="del" width="30">操作</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				<div class="divider d">divider</div>
			<div class="unit" >
			<label style="width: 80px">详细：</label>
					<textarea class="xheditor"  name="Description" style="width:95%;height:230px;"  
							    upLinkUrl="upload.php" upLinkExt="zip,rar,txt,doc,xls" 
								upImgUrl="upload.php" upImgExt="jpg,jpeg,gif,png" 
								upFlashUrl="upload.php" upFlashExt="swf"
								upMediaUrl="upload.php" upMediaExt="wmv,avi,wma,mp3,mid,mp4"></textarea>
				</div>
			</div>
			<div class="formBar">
			<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button  type="submit">保 存</button></div></div></li></ul>
			</div>
		</form>
	</div>
</div>