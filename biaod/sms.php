<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>百达丽手机公众平台</title>
<link rel="stylesheet" type="text/css" href="../css/main.css" />
<style type="text/css">
.demo{width:850px; margin:10px auto; padding:20px; background:#fff; color:#333}
.input{width:220px; height:18px; padding:2px 2px 0 2px; border:1px solid #ccc}
.btn{width:68px; height:22px; border:none; background:url(images/btn.gif) no-repeat; cursor:pointer}
.mytable{width:760px; margin:20px auto; border:2px solid #ccc}
.mytable td{padding:4px 6px; border-bottom:1px dotted #d3d3d3; color:#333}
.mytable td p{line-height:16px; color:#999}
.table_title{height:30px; line-height:30px; background:#f7f7f7; font-weight:bold; font-size:14px}

label.error{color:#ea5200; margin-left:4px; padding:0px 20px; background:url(images/unchecked.gif) no-repeat 2px 0 }
label.right{margin-left:4px; padding-left:20px; background:url(images/checked.gif) no-repeat 2px 0}
</style>

</head>

<body>
<div id="main">
   <div class="demo">
<form id="myform" action="savesms.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mytable">
  <tr class="table_title">
    <td colspan="2">百达丽手机公众平台>><a href="http://192.168.1.130/biaod/smslist.php" target="_blank">查看发送成功短信列表30条</a></td>
  </tr>
  <tr>
    <td align="right">手机号码：</td>
    <td><input type="text" name="phone" class="input required" /></td>
  </tr>
  <tr>
    <td align="right">短信内容：</td>
    <td><textarea  name="intro" rows="6" cols="45" ></textarea></td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td><input type="submit" class="btn" value="发 送" /> &nbsp; <input type="reset" class="btn" value="重 置" /></td>
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>
