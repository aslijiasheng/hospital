<?php 
header("Content-type: text/html; charset=utf-8");
$con = mysql_connect("192.168.1.130","root","35612615");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("kskf", $con);
mysql_query("set names utf8");
$created_at=date("y-m-d", time());

mysql_query("INSERT INTO msg_outbox (`Sender`,`Receiver`,`MsgType`,`MsgTitle`,`MMSContentLocation`,`SendTime`)   VALUES('2461,19','$_POST[phone]','0','$_POST[intro]','$MMSContentLocation','$created_at')",$con);
header("refresh:3;url=http://192.168.1.130/biaod/sms.php");
print("短信已加入发送列表---正在返回，请稍等…<br>三秒后自动跳转~~~");
mysql_close($con);
?> 