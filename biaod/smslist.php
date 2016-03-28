<?php 
header("Content-type: text/html; charset=utf-8");
$con = mysql_connect("192.168.1.130","root","35612615");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("kskf", $con);
mysql_query("set names utf8");
$result = mysql_query("SELECT * FROM `msg_sentbox` ORDER BY ID DESC LIMIT 30");

while($row = mysql_fetch_array($result))
  {$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	$replacement = "\$1&#9742;\$3";
	$row[dh_txt] = preg_replace($pattern, $replacement, $row['Receiver']);
	echo "<style type=text/css>body{font:normal normal 12px/1.5em Arial; padding:0; margin:0; }span{width:600px;overflow:hidden;white-space:nowrap;text-overflow:ellipsis;}</style>";
  echo "<p>接收人：".$row['dh_txt'] . " 内容：<span>" . $row['MsgTitle']. "</span><i> 发送时间" . $row['SendTime']. " 到达时间" . $row['ActualSendTime']."</i></p>";

  }
echo "<font style=color:#f00;>只显示前面30条</font>";
mysql_close($con);
?> 