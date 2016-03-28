<link href="uploadify/css/uploadify.css" rel="stylesheet" type="text/css" />
<div class="page">
	<div class="pageContent">
		<form  action="" method="post" onsubmit="return iframeCallback(this, dialogAjaxDone);" class="pageForm required-validate">	
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="varname" value="<?php echo $this->_var['row']['varname']; ?>" />
			<div class="pageFormContent" style="overflow-y:auto;">
				<p>
					<label>参数名称：</label>
					<?php echo $this->_var['row']['title']; ?>
				</p>
				<div class="unit">
				<label>上传文件：</label>
				<!--<input name="value" type="file" />-->
				<script type="text/javascript">
					$("#pic").uploadify({
					'uploader'       : 'uploadify/scripts/uploadify.swf?var='+(new Date()).getTime(),
					'script'         : 'uploadify/scripts/uploadlogo.php',
					'cancelImg'      : 'uploadify/cancel.png',
					'folder'         : 'upload/images/<?php echo $this->_var['row']['id']; ?>/',//上传路径
					'fileExt'        : '*.gif;*.png', //允许文件上传类型,和fileDesc一起使用.
					'fileDesc'       : '*.gif;*.png',  //将不允许文件类型,不在浏览对话框的出现.
					'buttonText'     : 'Select Pic',
					'auto'           : true,
					'sizeLimit'      : 1048576,
					
					'onError' : function (event, ID, fileObj, errorObj) {
				if (errorObj.type === "File Size"){
				 alert('文件'+fileObj.name+'超过上传大小限制1M！');
				return;
					}alert(errorObj.type + ', Error: ' + errorObj.info);
   },
					'onAllComplete' : function (event, date) {
					alert('图片大小'+date.allBytesLoaded+'字节,上传完毕');
					}
					});
				</script>
				<input type="file" name="value" id="pic" />
				<div id="pic" class="fileQueue"></div>
			    </div>
				
				<div class="unit">
					<label>说明：</label>
					<div style="line-height:1.8em;"><?php echo empty($this->_var['row']['intro']) ? '无' : $this->_var['row']['intro']; ?></div>
				</div>
			</div>
			<div class="formBar">
				<ul>
					
					
				</ul>
			</div>
		</form>
	</div>
</div>