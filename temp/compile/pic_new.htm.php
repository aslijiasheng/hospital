<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<link href="uploadify/css/uploadify.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.tp{position:relative;overflow:hidden;}
.tp dd{border:1px solid #b8d0d6;float:left;width: 120px;height:100%;padding:8px 0;text-align:center;overflow:hidden;margin-right:10px;position:relative;}
.tp dd img{ 
max-width:100px;height:auto; }
.tp dd i{display:block;font-style:normal;}
 .tp .list{line-height:22px;padding-bottom:5px;color:#444;}
.tp .list span{color:#000;}
 h2 a{color:#f00;font-weight:300;}
 .tp dd .deltp{position:absolute;top:0;right:0;}
 .cl{clear:both;}
-->
</style>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=sell&do=updata2" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">		
		<input type="text" name="salesid" value="<?php echo $_SESSION['userid']; ?>" class="input" style="display:none;"/>
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
		<input type="hidden" name="tp" value="<?php echo $this->_var['row']['tp']; ?>" />
			<div class="pageFormContent" layoutH="56">
			<div class="panel collapse" minH="100" defH="120" style="display:<?php echo $this->_var['row']['kj']; ?>;width:95%;">
		<h1>已上传过图片了</h1>
		<div class="tp"><?php echo $this->_var['row']['tp1']; ?><div class="cl"></div></div>
		</div>
			 <div><span> &#9758;客户：</span><?php echo $this->_var['row']['name']; ?></div>
			<div class="divider d">divider</div>
<script type="text/javascript">
function toDecimal(x) {  
            var f = parseFloat(x);  
            if (isNaN(f)) {  
                return;  
            }  
            f = Math.round(x*100)/100;  
            return f;  
        }//小数点控制

$(document).ready(function() {
	$("#uploadify").uploadify({
		'uploader'       : 'uploadify/scripts/uploadify.swf?var='+(new Date()).getTime(),
		'script'         : 'uploadify/scripts/uploadify.php',
		'cancelImg'      : 'uploadify/cancel.png',
		'buttonText'     : 'Select pic',
		'folder'         : 'uploads/<?php echo $this->_var['row']['infoid']; ?>/',//上传路径
		'method'   : 'post',//方法，服务端可以用$_POST数组获取数据
		'queueID'        : 'fileQueue',
		'fileExt'        : '*.jpg;*.gif;*.png;*.bmp', //允许文件上传类型,和fileDesc一起使用.
		'fileDesc'       : '*.jpg;*.gif;*.png;*.bmp',  //将不允许文件类型,不在浏览对话框的出现.
		'sizeLimit'      : 10485760,//10M图片
		'auto'           : false,
		'multi'          : true,
		'onSelectOnce': function(event, date) { 
$('#sc').html($('#sc').html() + "<span style=color:#f00;>文件选择完成：</span>本次选择文件" + date.filesSelected + "个！--总大小" + toDecimal(date.allBytesTotal/1024) + "kb!\r\n" ); },
		 'onError' : function (event, ID, fileObj, errorObj) {
    if (errorObj.type === "File Size"){
     alert('文件'+fileObj.name+'超过上传大小限制10M！');
     return;
    }
    alert(errorObj.type + ', Error: ' + errorObj.info);
   },
		'onOpen': function(event,queueId,fileObj) { 
$('#scz').html($('#scz').html() +'<li>&#9758;'+ fileObj.name + "开始上传！——"+toDecimal(fileObj.size/1024)+"kb</li>\r" ); },
		'onComplete':function(event,queueId,fileObj,response,data){
			$('#info').text($('#info').text() +'|'+response+'|'+fileObj.type+'|'+toDecimal(fileObj.size/1024)+'kb\n');//在页面上显示文件相对路径
		},
		'onAllComplete': function(event, date) { 
$('#scg').html($('#scg').html() + "本次成功上传文件：" + date.filesUploaded + "个！\r\n" + "失败：" + date.errors + "个！\r\n" + "平均上传速度：" + toDecimal(date.speed)+"kb/s,上传成功后请点击右下方保存按钮！"); }	
	});
});
</script>
<style type="text/css">
<!--
#c1{width:100%;text-align:left;}
#fileQueue {width:380px;height:230px;overflow: auto;border: 1px solid #999;margin-left:5px;margin-right:10px;float:left;}
.btn-group{width:120px;float:left;}
.btn{text-decoration:none;width:110px;height:30px;display:block;background:#515151;margin:10px 0;text-align:center;font:14px/2em '微软雅黑';color:#fff;}
.btn:hover{background:#333;font-weight:bold;}

.info{border:2px solid #999;width:400px;min-height:30px;float:left;}
Li,dd,dl,dt{list-style:none;}

-->
</style>
			<div id="c1">
	<div id="fileQueue"></div>
	<div class="btn-group">
	<input type="file" name="uploadify" id="uploadify" />
	<a href="javascript:jQuery('#uploadify').uploadifyUpload()"  class="btn">上传图片</a>
	<a href="javascript:jQuery('#uploadify').uploadifyClearQueue()"class="btn">取消上传</a>
	</div>

	<div id="2info" style="display:none;"><textarea  name="tp2" id="info" tabindex="4" rows="15" cols="33" readonly="true"></textarea></div>

<div style="float:left;width: 300px;height:230px;border: 1px solid #999;">
<div id="sc"></div>
<div id="scz" ></div>
<div id="scg" style="color:#f00;"></div>
</div>
</div>
</div>
			
			<div class="formBar">
			<span style="float:left;">操作步骤：选择图片-上传-保存 >>可上传.jpg.gif.png图像，单张大小不得超过10M</span>
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button  type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
		
	</div>
</div>
