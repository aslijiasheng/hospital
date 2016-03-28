<?php 

$con = mysql_connect("192.168.1.130","root","35612615");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("kskf", $con);
mysql_query("set names utf8");
$created_at=date("y-m-d", time());
$yhq=mysql_query("select tel,lx from `cs_yhq` WHERE tel='$_POST[phone]' and lx='$_POST[lx]' limit 1",$con);
if(mysql_num_rows($yhq)>0)exit('该手机已领过此类优惠券');
$cx=mysql_query("select id,tel,name,salesid from `cs_info` WHERE tel='$_POST[phone]' limit 1",$con);
//$sql="INSERT INTO msg_outbox (`Sender`,`Receiver`,`MsgType`,`MsgTitle`,`MMSContentLocation`,`SendTime`)   VALUES('$Sender','$_POST[phone]','0','撒大声说短信zzz23','$MMSContentLocation','$created_at')";
//$sql2="INSERT INTO cs_info (name,xb,tel,mail,typeid,salesid,zxxm,created_at ) VALUES ('$_POST[user]','$_POST[sex]','$_POST[phone]','$_POST[email]','5','18','$_POST[zxxm]','$created_at')";
//$sql3="INSERT INTO cs_yhq (infoid,tel,yhq,lx,created_at ) VALUES ('$yid','$_POST[phone]','$_POST[yhq]','$_POST[lx]','$created_at')";
if (mysql_num_rows($cx)>0){
$row3=mysql_fetch_array($cx); 
$Sender=$row3[id].",18";
$yid=$row3[id];
$yhq="bdl".$_POST[lx]."#".rand(100,1000)."|有效期：领取当日起一个月后作废,百达丽整形美容";
$b=explode("|",$yhq);
mysql_query("INSERT INTO msg_outbox (`Sender`,`Receiver`,`MsgType`,`MsgTitle`,`MMSContentLocation`,`SendTime`)   VALUES('$Sender','$_POST[phone]','0','$yhq','$MMSContentLocation','$created_at')",$con);
mysql_query("INSERT INTO cs_yhq (infoid,tel,yhq,lx,created_at ) VALUES ('$yid','$_POST[phone]','$b[0]','$_POST[lx]','$created_at')",$con);echo "优惠券已发送，请注意查收";
}
else{
if (mysql_query("INSERT INTO cs_info (name,xb,tel,mail,typeid,salesid,zxxm,created_at ) VALUES ('$_POST[user]','$_POST[sex]','$_POST[phone]','$_POST[email]','5','18','领取优惠券','$created_at')",$con)){$row2=mysql_fetch_array($cx);
$Sender=$row2[id].",18";
$yid=$row2[id];
$yhq="bdl".$_POST[lx]."#".rand(100,1000)."|有效期：领取当日起一个月后作废,百达丽整形美容";
$b=explode("|",$yhq);
if (!mysql_query("INSERT INTO msg_outbox (`Sender`,`Receiver`,`MsgType`,`MsgTitle`,`MMSContentLocation`,`SendTime`)   VALUES('$Sender','$_POST[phone]','0','$yhq','$MMSContentLocation','$created_at')",$con)){die('Error: ' . mysql_error());}
mysql_query("INSERT INTO cs_yhq (infoid,tel,yhq,lx,created_at ) VALUES ('$yid','$_POST[phone]','$b[0]','$_POST[lx]','$created_at')",$con);echo "优惠券已发送2，请注意查收";
}
}

		
mysql_close($con); 
?> 