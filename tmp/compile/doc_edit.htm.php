
 <script type="text/javascript" src="chajian/farbtastic/farbtastic.js"></script>
 <link rel="stylesheet" href="chajian/farbtastic/farbtastic.css" type="text/css" />
 <script type="text/javascript" charset="utf-8">
  $(document).ready(function() {
    $('#demo').hide();
    $('#picker').farbtastic('#color');
  });
 </script>
 <style type="text/css">
<!--
p{clear:both;}
#color{width: 50px;}
#picker1{position:absolute;top:40%;left:40%;z-index:50;}
#picker1 a{display:block;width: 30px;height: 30px;position:absolute;top:0;right:0;z-index:20;}
.colorwell {
     width: 6em;
     text-align: center;
     cursor: pointer;
   }
-->
</style>
<div class="page">
	<div class="pageContent">
		<form method="post" action="?action=doc&do=edit" class="pageForm required-validate" onsubmit="return validateCallback(this, navTabAjaxDone);">
		<input type="hidden" name="id" value="<?php echo $this->_var['row']['id']; ?>" />
			<div class="pageFormContent" layoutH="56">
				<div >
					<label>标题：</label>
					<input name="title" class="required" type="text" size=70% value="<?php echo $this->_var['row']['title']; ?>" alt=""/>
					<?php echo $this->_var['zhid_cn']; ?>
					<input type="text" id="color" name="color" class="colorwell" value="<?php echo empty($this->_var['row']['color']) ? '无' : $this->_var['row']['color']; ?>" onclick="picker1.style.display='block'"/>
					<div id="picker1" style="display:none;"><div id="picker" ></div><a href="#" onclick="picker1.style.display='none'">X</a></div>
				</div>
				<p>
					<label>类型：</label>					
					<?php echo $this->_var['doctid_cn']; ?><input type="checkbox" name="sx1"  value="1" <?php echo $this->_var['row']['checked1']; ?> />主页显示<input type="checkbox" name="sx2"  value="1" <?php echo $this->_var['row']['checked2']; ?> />加粗显示
				</p> 
				<div class="unit">
				<label>内容：</label>
							<textarea class="xheditor" name="intro" style="width:70%;height:500px;" 
							    upLinkUrl="upload.php" upLinkExt="zip,rar,txt,doc,xls" 
								upImgUrl="upload.php" upImgExt="jpg,jpeg,gif,png" 
								upFlashUrl="upload.php" upFlashExt="swf"
								upMediaUrl="upload.php" upMediaExt="wmv,avi,wma,mp3,mid,mp4"><?php echo $this->_var['row']['intro']; ?></textarea>
				</div>
			</div>
			<div class="formBar">
				<ul>
					<li><div class="buttonActive"><div class="buttonContent"><button type="submit">保存</button></div></div></li>
				</ul>
			</div>
		</form>
	</div>
</div>