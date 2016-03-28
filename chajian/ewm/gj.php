<?php
include "phpqrcode.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>二维码生成工具</title>
</head>

<body>
<style type="text/css">
<!--
#wrap{position:relative;width: 100%;}
#main{float:left;width: 260px;}
.xs{float:left;width:190px;}
-->
</style>
<div id="wrap">
<div id="main"><form id="form1" name="form1" method="post" action="" onsubmit="return makepic();">请输入要生成二维码的内容：<textarea name="content" id="content" cols="30" rows="5"><?php echo $_POST['content']; ?></textarea>
<p align="center"><input name="go" type="submit" id="go" onclick="" value=" 生成 " /></p>
</form>
</div>
<?php 
if($_POST['content']){
	$c = $_POST['content'];
	$dd=date("Ymd-His", time());
	QRcode::png($c, 'images/gg/cs'.$dd.'.gif');
	
	$sc = urlencode($c);
	echo '<div class="xs"><img src="images/gg/cs'.$dd.'.gif" /></div>'; 
	
}
?>
    
</div>
</body>
</html>
