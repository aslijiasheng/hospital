<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
include(CORE."mail/class.phpmailer.php");		  //配置类
//邮件写入	
if($do=="yjxr"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();

	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"发送短信");
	$smt->display('mail_add.htm');
	exit;
}
if($do=="add"){
$smt = new smarty();smarty_cfg($smt);	
$subject=$_POST['bt'];
$body=$_POST['zw'];
$altbody=$_POST['ts'];
$sendto_email=$_POST['mail'];
$fromname=$_POST['fj'];
function smtp_mail ($sendto_email,$subject,$fromname,$body,$altbody) { 
$mail = new PHPMailer();
$mail->IsSMTP(); // 通过SMTP发送
$bei=$_POST['sm'];
$cfe=explode(",",$bei);
$smtps = ($cfe[0]);
$names = ($cfe[1]);
$pwds = ($cfe[2]); 
$mailadd = ($cfe[3]);
$mail->Host = ($smtps); // SMTP 服务器
$mail->SMTPAuth = true; // 启用SMTP认证 true：真　False：假
$mail->Username = ($names); // SMTP username 注意：普通邮件认证不需要加 @域名
$mail->Password = ($pwds); // SMTP password
$mail->From = ($mailadd); // 发件人邮箱
$mail->CharSet = "utf-8"; // 这里指定字符集！
$mail->FromName = ($fromname); // 发件人名称
$mail->IsHTML(true); // 发送HTML页面
$mail->Subject = ($subject);// 邮件主题
$mail->Body = ($body);//html邮件正文
$mail->AltBody =($altbody);//当不支持html显示时正文提示
$mail->AddAddress($sendto_email); // 收件人邮箱和姓名
if(!$mail->Send())      
{      
echo "邮件发送有误 <p>";      
echo "邮件错误信息: " . $mail->ErrorInfo;      
exit;      
}      
else {      
echo "{\"statusCode\":\"200\",\"message\":\"$sendto_email 邮件发送成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=info\"}";     
}
}
$sendarray=explode(",",$sendto_email);
foreach($sendarray as $emaildododo)
{
$smtpemailto = $emaildododo;
smtp_mail($smtpemailto,$subject,$fromname,$body,$altbody);
}
}
//二维码生成
if($do=="ewmsc"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	include "chajian/ewm/phpqrcode.php";

	$c =''.$row[id].','.$row[name].','.$row[tel].'';
	$len = strlen($c);
	   if ($len <= 360){
	   QRcode::png($c, 'chajian/ewm/images/'.$row[id].'.gif');	
	   $sc = urlencode($c);
	   echo '<img src="chajian/ewm/images/'.$row[id].'.gif" />'; 
	   }
	   else {
	     echo '亲！信息量过大。';
	   }	
}	
else {
  echo '还没生成二维码';
}
?>