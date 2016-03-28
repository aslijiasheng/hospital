<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
include(CORE."include/cfg.php");		  //配置类
include(CORE."include/cfgqt.php");		  //配置类 
include(CORE."chajian/mail/class.phpmailer.php");		  //配置类
include(CORE."chajian/ewm/phpqrcode.php");

//发送短信
if($do=="sms"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	if($id1){$idx=explode(",",$id1);//判断多值id传值
    $id=$idx[1];}
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[levelid]==0){$row[hyh]="该客人不是会员,请先设置为会员";}
	else{$row[hyh]="V".$row[levelid]."#".$row[card];} //会员号
	$row[smsyy] = $config['sms_yy'];//系统短信预约读取
	$row[smsewm] = $config['sms_ewm'];//系统短信二维码读取
	$szth = array('[mz]'=>$row[name],'[yyh]'=>$row[id],'[tel]'=>md5($row[tel]));//
	$row[yyh]=strtr($row[smsyy],$szth);//预约号

	//二维码
	$c =strtr($row[smsewm],$szth);//二维码
	$len = strlen($c);
	   QRcode::png($c, 'chajian/ewm/images/'.$row[id].'.gif');	
	   $sc = urlencode($c);
	   $row[ewmsrc] = 'chajian/ewm/images/'.$row[id].'.gif';
	//会员积分
	if($idjf!=''){$jf=explode(",",$idjf);
	if($jf[1]>'0'){$jfqt="已消费积分".$jf[1]."剩余积分".$jf[2];}
	$row[idjf]="尊敬的会员：".$row[name].";你好！截止：".date("Y年m月d日 H:i", time())."你的总积分为".$jf[0].$jfqt;}
	//短信回复处理
	if($clfs!=''){$row[clfs]=$clfs;}
	//彩信地图图片
	$row[cxdt] = 'upload/sms/cxdt.gif';//获取路径
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"发送短信");
	$smt->display('sms/sms_fs.htm');
	exit;
}
//短信写入
if($do=="sms_fs"){
	$tel=explode("/",$_POST[tel]);
	$intro = $_POST[sms_intro];
	$type=explode(",",$_POST[MsgType]);
	$src=dirname(dirname(__FILE__)).'\\'.str_replace('/', '\\',$type[1]);//彩信图片路径
	$Sender=$_POST[infoid].','.$_SESSION[userid];
	
	if($type[0]==0){$MMSContentLocation="";}else{$MMSContentLocation=addslashes($src);}
	$created_at=date("y-m-d H:i:s", time());
	//短信回复处理
	$handle="2,".$_SESSION[userid];
	if($_POST[clfs]!=''){$sql="UPDATE `msg_inbox` SET `handle` = '$handle' WHERE `msg_inbox`.`id` ='$_POST[clfs]' LIMIT 1 ;";
		$db->query($sql);}
	 $sql2="INSERT INTO MSG_Outbox (`Sender`,`Receiver`,`MsgType`,`MsgTitle`,`MMSContentLocation`,`SendTime`)   VALUES('$Sender','$tel[0]','$type[0]','$intro','$MMSContentLocation','$created_at');";
	if($db->query($sql2)){
		echo "{\"statusCode\":\"200\",\"message\":\"短信已加入发送列表!\",\"callbackType\":\"closeCurrent\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}
	exit;
}
//优惠券短信发送
if($do=="smsyhq"){
	$smt = new smarty();smarty_cfg($smt);
	if($id1){$idx=explode(",",$id1);//判断多值id传值
    $id=$idx[1];}
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//优惠券
	function MakeStr($length) 
{ 
$possible = "0123456789"."abcdefghijklmnopqrstuvwxyz"."ABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
$str = ""; 
while(strlen($str) < $length) 
$str .= substr($possible, (rand() % strlen($possible)), 1); 
return($str); 
} 
	$row[coupon] = $config['coupon'];//优惠券规则
	$sjth = array('[sss]'=> MakeStr(6),'[yyh]'=>$row[id]);//
	$row[yyq]=strtr($row[coupon],$sjth);//优惠券号
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"发送短信");
	$smt->display('sms/smsyhq_fs.htm');
	exit;
}
//短信写入
if($do=="smsyhq_fs"){
	$expire_at=date("Y-m-d H:i:s",strtotime("+$_POST[day] day"));//到期时间
	$tel=explode("/",$_POST[tel]);
	$intro ="券号：".$_POST[yhq]."|".$_POST[sms_intro]."。本券到期时间".$expire_at;
	$Sender=$_POST[infoid].','.$_SESSION[userid];
	$created_at=date("y-m-d H:i:s", time());
	
	//优惠券写入处理
	 $sql2="INSERT INTO MSG_Outbox (`Sender`,`Receiver`,`MsgType`,`MsgTitle`,`MMSContentLocation`,`SendTime`)   VALUES('$Sender','$tel[0]','0','$intro','$MMSContentLocation','$created_at');";
	if($db->query($sql2)){
		$sql="INSERT INTO cs_yhq (`infoid`,`tel`,`salesid_yhq`,`yhq`,`created_at`,`expire_at`,`lx`)   VALUES('$_POST[infoid]','$tel[0]','$_SESSION[userid]','$_POST[yhq]','$created_at','$expire_at','$_POST[lx]');";;
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"优惠券已加入发送列表!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	exit;
}

//邮件发送	
if($do=="send"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//读取邮件设置信息
	
	$bei=$config['sysmail'];//读取配置
	$cfe=explode(",",$bei);
	$names = ($cfe[1]);
	//模版
	if($bei==""){$row[zt]="系统未设置发件邮箱";}
	else{$row[zt]="发件邮箱:".$names;}
	$smt->assign('row',$row);
	$smt->assign('title',"发送短信");
	$smt->display('mail_add.htm');
	exit;
}
//邮件写入
if($do=="add"){ 
$bei=$config['sysmail'];//读取配置
	
$subject=$_POST['title'];
$body=$_POST['zw'];
$altbody=$_POST['ts'];
$sendto_email=$_POST['mail'];
$fromname=$_POST['fj'];
$mail = new PHPMailer();
$mail->IsSMTP(); // 通过SMTP发送
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
$mail->AddAddress($sendto_email); // 收件人邮箱和姓名$msg
if(!$mail->Send())      
{           
echo "{\"statusCode\":\"300\",\"message\":\"$cwu 邮件发送失败,请检查设置及收件人地址!\"}";
}      
else {$salesid10=$_SESSION[userid];
	  $created_at=date("Y-m-d H:i:s", time());
	  $sql="INSERT INTO `cs_mail` (`infoid`,`title`,`intro`,`salesid10`,`created_at`)
	  VALUES ('$_POST[infoid]','$subject','$body','$salesid10','$created_at');";
	  $db->query($sql);
echo "{\"statusCode\":\"200\",\"message\":\"$sendto_email 邮件发送成功!\",\"navTabId\":\"\",\"callbackType\":\"closeCurrent\"}";
}
exit;
}
//二维码生成
if($do=="ewmsc"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$jm=md5($row[name].$row[tel]);
	 
	$c ="#".$row[id]."#".$jm."#http://www.33c33.com";
	$len = strlen($c);
	   if ($len <= 360){
	   QRcode::png($c, 'chajian/ewm/images/'.$row[id].'.gif');
	   $sc = urlencode($c);
	   echo 'nihsadfkhsdj就的发生过哈房价高的发生的和规范<style type="text/css">*{margin:0;padding:0;}.kk{width: 180px;height: 135px;overflow:hidden;text-align:left;margin-left:0.05cm;margin-top:1.8cm;}.kk img{float:left;}.kk p{width: 110px;text-align:left;font-size:10px;}</style>';
	   echo '<div class="kk"><div><img src="chajian/ewm/images/'.$row[id].'.gif" /><div><p>#bdl_'.$row[id].'</p></div>';
	   }
	   else{echo '亲！信息量过大。';}
     exit;
}
//二维码生成
if($do=="ewmnew"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$jm=md5($row[name].$row[tel]);

	$c ="#".$row[id]."#".$jm."#http://www.33c33.com";
	$len = strlen($c);

	   QRcode::png($c, 'chajian/ewm/images/'.$row[id].'.gif');	
	   $sc = urlencode($c);
	   $row[ewmsrc] = 'chajian/ewm/images/'.$row[id].'.gif';

	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"发送短信");
	$smt->display('ewm_dy.htm');
	exit;
}
//邮件发送列表
if($do=="m_list"){
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " && i.name like '%$_POST[name]%'";}	
	if($_POST['tel']){$search .= " && i.tel like '%$_POST[tel]%'";}
	if($_POST['salesid10']){$search .= " && s.salesid10 = '$_POST[salesid10]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && s.created_at >=  '$_POST[time_start]' &&  s.created_at <=  '$_POST[time_over]'";
	}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_mail` as s where 1=1 $search ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询
	$sql="SELECT i.name,i.tel,s.created_at,s.id,s.salesid10,s.infoid,s.intro,s.title FROM `cs_mail` as s,`cs_info` as i where s.infoid = i.id $search order by s.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][salesid10_txt] = $user_list[$list[$key][salesid10]];
		//隐藏电话
		$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	    $replacement = "\$1&#9742;\$3";
		$list[$key][dh_txt] = preg_replace($pattern, $replacement, $list[$key][tel]);
	}


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($salesid,"salesid","","操作人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"邮件发送记录");
	$smt->display('mail_list.htm');
	exit;	
}
//短信发送记录
if($do=="s_list"){
	If_rabc($action,$do); //检测权限
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " && i.name like '%$_POST[name]%'";}	
	if($_POST['tel']){$search .= " && i.tel like '$_POST[tel]%'";}
	if($_POST['salesid9']){$search .= " && FIND_IN_SET('$_POST[salesid9]', Sender)";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && s.SendTime >=  '$_POST[time_start] 00:00:00' &&  s.SendTime <=  '$_POST[time_over] 23:59:50'";
	}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT s.ID,s.Sender,s.MsgTitle,s.SendTime,s.ActualSendTime,i.id,i.name,i.tel FROM `msg_sentbox` as s,`cs_info` as i  where i.id=s.Sender+',%' $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//客户名称&电话
	$sql_info="SELECT id,name,tel FROM `cs_info` ";
	$db->query($sql_info);
	$info_arr=$db->fetchAll();
	foreach($info_arr as $key=>$val){
		$info_list[$info_arr[$key][id]]=$info_arr[$key][name];
		$info_list2[$info_arr[$key][id]]=$info_arr[$key][tel];
	}
	//查询
	$sql="SELECT s.ID,s.Sender,s.MsgTitle,s.SendTime,s.ActualSendTime,i.id,i.name,i.tel FROM `msg_sentbox` as s,`cs_info` as i  where i.id=s.Sender+',%' $search order by s.ID desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		//隐藏电话
		$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	    $replacement = "\$1&#9742;\$3";
		$list[$key][dh_txt] = preg_replace($pattern, $replacement, $list[$key][tel]);
		$b=explode(",",$list[$key][Sender]);
		$list[$key][salesid9]= $user_list[$b[1]];
		$list[$key][name1]= $info_list[$b[0]];
		$list[$key][dh_txt]= $info_list2[$b[0]];

	}
	

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($salesid,"salesid9","","操作人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"短信发送记录");
	$smt->display('sms_list.htm');
	exit;	
}
//短信回复记录
if($do=="smshf"){
	//判断检索值	
	if($_POST['tel']){$search .= " && Sender like '$_POST[tel]%'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && MsgArrivedTime >=  '$_POST[time_start] 00:00:00' &&  MsgArrivedTime <=  '$_POST[time_over] 23:59:50'";
	}
	//判断首页昨日未处理短信统计
	if($yesterday){
		$search .= " && MsgArrivedTime >=  '$yesterday 00:00:00' &&  MsgArrivedTime <=  '$yesterday 23:59:50' && handle='0'";
	}
	//设置分页
	echo $tj;
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `msg_inbox` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	//处理人
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//客人名称
	$sql_info="SELECT id,tel,name FROM `cs_info` ";
	$db->query($sql_info);
	$info_arr=$db->fetchAll();
	foreach($info_arr as $key=>$val){
		$info_list[$info_arr[$key][tel]]=$info_arr[$key][name];
		$info_list2[$info_arr[$key][tel]]=$info_arr[$key][id];
	}

	//查询										 
	$sql="SELECT * FROM `msg_inbox` where 1=1 $search order by ID desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//echo $sql;
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][Message2]=strip_tags($list[$key][MsgTitle]);
		$list[$key][name] = $info_list[$list[$key][Sender]];
		$list[$key][id] = $info_list2[$list[$key][Sender]];
		$cl=explode(",",$list[$key][handle]);
		$list[$key][salesid_txt] = $user_list[$cl[1]];
		$handle=array('0'=>'<font style=color:#f00; >未处理</font>','1'=>'电话','2'=>'短信');
		$list[$key][handle_cn] = strtr($cl[0],$handle)."[".$list[$key][salesid_txt]."]";
	
	$b=explode(",",$list[$key][MMSContentLocation]);
	$d=COUNT($b);
	for($i=1;$i<$d;$i++){
	if($i%3==1){$c1=$i;
	
	$e1=($b[$c1]);
	$list[$key][caixin].="<a href=".$e1." target=navTab >".$e1."</a>";}
	}
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($salesid,"salesid","","操作人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"全部短信回复");
	$smt->display('sms_list2.htm');
	exit;	
}

//短信回复明细
if($do=="smshfmx"){	
	$smt = new smarty();smarty_cfg($smt);

	//查询
	$sql="SELECT * FROM `msg_inbox` as e,`cs_info` as i  where e.Sender='$id' and i.tel+'/%'=e.Sender";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询2
	$sql2="SELECT b.id,b.name,b.tel,b.salesid,s.SendTime,s.ID,s.Sender,s.Receiver,s.MsgTitle FROM `msg_sentbox` as s,`cs_info` as b where  b.tel+'/%'='$id' and b.id=s.Sender+',%'";
	$db->query($sql2);
	$list2=$db->fetchAll();
	
	//格式化输出数据
	foreach($list2 as $key=>$val){
		if($key%2==0){
			$list2[$key][rowcss]="listOdd";
		}else{
			$list2[$key][rowcss]="listEven";
		}
		$b=explode(",",$list2[$key][Sender]);
		$list2[$key][salesid2]= $user_list[$b[1]];
		//$list[$key][Message2]=strip_tags($list[$key][Message]);
		//$list[$key][name] = $info_list[$list[$key][Mobile]];
		//$list[$key][infoid] = $info_list2[$list[$key][Mobile]];
	}

	
	//模版
	$smt->assign('list',$list);if(mysql_affected_rows() > 0) {
	$smt->assign('list2',$list2);}else{echo "<span style=color:#f00;>系统查无登记该号码，不能显示发件人</span>";}
	$smt->assign('title',"明细");
	$smt->display('sms_hf_mx.htm');
	exit;
}
//短信回复删除
if($do=="smsdel2"){	
	$sql="delete from `msg_inbox` where `msg_inbox`.`ID`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}		
	exit;
}

//新建短信模版栏目	
if($do=="smslm"){	

	$smt = new smarty();smarty_cfg($smt);

	$smt->assign('title',"新建配置");
	$smt->display('sms_lm_new.htm');
	exit;
}
//模版栏目写入
if($do=="smslmadd"){
	$salesid=$_SESSION[userid];
	$created_at=date("y-m-d", time());
	$sql="INSERT INTO `cs_type_smsmail` (`title` ,`type`,`userid`,`created_at` )
	VALUES ('$_POST[title]','smsid','$salesid','$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	exit;
}
//模版栏目修改#删除
if($do=="smslmxg"){
	$salesid=$_SESSION[userid];
	if($id==''){$mb='sms_lm_xg.htm';}else{$mb='sms_lm_del.htm';}
	$sql="SELECT * FROM `cs_type_smsmail` where type='smsid' and userid=$salesid $search ";
	$db->query($sql);
	$list=$db->fetchAll();
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('title',"新建配置");
	$smt->display($mb);
	exit;
}
//模版栏目更新
if($do=="smslmxgu"){
	$id=$_POST['typeid'];
	$sql="UPDATE `cs_type_smsmail` SET 
	`title`  = '$_POST[title]' WHERE `cs_type_smsmail`.`id` ='$id' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}		
	exit;
}
//模版栏目删除
if($do=="smslmdel"){
	$salesid=$_SESSION[userid];
	$id=$_POST['typeid'];
	$sql="delete from `cs_type_smsmail` where `cs_type_smsmail`.`id`=$id  limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}		
	exit;
}
//短信模版列表	
if($do=="smsmb"){
	$salesid=$_SESSION[userid];
	if($_POST['intro']){$search .= "and intro like '%$_POST[intro]%'";}	
	if($_POST['typeid']){$search .= "and typeid = '$_POST[typeid]'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_sms_intro` where 1=1 $search ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	 if($id!=''){$type="typeid='$id'";$mb='sms_mb2.htm';}else{$type="1=1";$mb='sms_mb.htm';}
	//查询
	$sql="SELECT * FROM `cs_sms_intro` where $type $search  LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//查询栏目
	$sql2="SELECT * FROM `cs_type_smsmail` where type='smsid' and userid='1'";
	$db->query($sql2);
	$list2=$db->fetchAll();
	//查询栏目2
	$sql3="SELECT * FROM `cs_type_smsmail` where type='smsid' and userid=$salesid and userid!='1'";
	$db->query($sql3);
	$list3=$db->fetchAll();

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('list',$list);
	$smt->assign('list2',$list2);
	$smt->assign('list3',$list3);
	$smt->assign('total',$total);
	$smt->assign('smslm_cn',select($smslmid,"typeid","","栏目选择","required"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"配置列表");
	$smt->display($mb);
	exit;
}
//新建短信模版	
if($do=="smsnew2"){	
	//查询栏目
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('smslm_cn',select($smslmid,"typeid","","栏目选择","required"));
	$smt->assign('title',"新建");
	$smt->display('smsnew2.htm');
	exit;
}
//模版短信写入
if($do=="smsnew2add"){
	$salesid=$_SESSION[userid];
	$sql="INSERT INTO `cs_sms_intro` (`intro`,`typeid`,`userid`)
	VALUES ('$_POST[intro]','$_POST[typeid]','$salesid');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}
	exit;
}
//模版短信修改#删除
if($do=="sms2xg"){
	$salesid=$_SESSION[userid];
	$sql="SELECT * FROM `cs_sms_intro` where `cs_sms_intro`.`id`='$id'  LIMIT 1 ";
	$db->query($sql);
	$row=$db->fetchRow();
	
	if($row[userid]!=$salesid){echo "你不能更改别人的东西";exit;}
	//栏目查询
	$sql="SELECT id,title FROM `cs_type_smsmail` where type='smsid' and userid='$salesid'";
	$db->query($sql);
	$list=$db->fetchAll();	
	foreach($list as $key=>$val){
		$l_list[$list[$key][id]]=$list[$key][title];	
	}
	
	//用户
	$smt = new smarty();smarty_cfg($smt);
	$row[title_mr] = $l_list[$row[typeid]];
	$smt->assign('row',$row);
	$smt->assign('list',$list);
	$smt->assign('title',"修改短信");
	$smt->display('sms2xg.htm');
	exit;
}
//模版短信更新
if($do=="sms2xgu"){
	$id=$_POST['id'];
	$sql="UPDATE `cs_sms_intro` SET 
	`intro`  = '$_POST[intro]',
	`typeid`  = '$_POST[typeid]'
	WHERE `cs_sms_intro`.`id` ='$id' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}		
	exit;
}
//模版短信删除
if($do=="sms2del"){
	$salesid=$_SESSION[userid];
	if($salesid==1){$sql="delete from `cs_sms_intro` where `cs_sms_intro`.`id`=$id limit 1";}
	else{$sql="delete from `cs_sms_intro` where `cs_sms_intro`.`id`=$id and userid=$salesid limit 1";}
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!或权限不够\"}";}
	exit;
}

//发送信息列表	
if($do=="messlist"){
	If_rabc($action,$do); //检测权限
	$tj="(address like '%,$_SESSION[userid],%' || address like ',$_SESSION[userid]' || address='0')";
	if($list){$search .= "and type = $list";}//公共用户
	if($me){$search .= "and sender=$_SESSION[userid] and type !='4'";$tj="1=1";}
	if($_POST['intro']){$search .= "and intro like '%$_POST[intro]%'";}	
	if($_POST['type']){$search .= "and type = '$_POST[type]'";}
	$del =$_SESSION[userid].'D';
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_message` where $tj $search and isdel not like '%,$del%' ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数

	//查询
	$sql="SELECT * FROM `cs_message` where $tj $search and isdel not like '%,$del%' LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][sender_txt] = $user_list[$list[$key][sender]];
		$list_zxr = explode(",",$list[$key][address]);
		foreach($list_zxr as $k=>$v){
			$list[$key][address_txt] .= $user_list[$v].",";
		}
		if($list[$key][address]=="0"){$list[$key][address_txt]="所有人";}
		$list[$key][type_cn] = strtr($list[$key][type],$messtype);
		//判断是否已读
		$read = ','.$_SESSION[userid].'R';
		if(stripos($list[$key][isread],$read)=== false){$list[$key][isread_cn]='未读';}else{$list[$key][isread_cn]='<font style="color:#f00">已读</font>';}
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('total',$total);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('messtype_cn',select($messtype,"type","","选择类型","required"));
	$smt->assign('title',"配置列表");
	$smt->display('mess/mess_list.htm');
	exit;
	
}
//发送信息添加	
if($do=="messnew"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['intro'])){
	$created_at=date("Y-m-d H:i:s", time());
	$sender=$_SESSION[userid];
	if($_POST[type]=="1"){$_POST[user_orgxh]="0";}
	$user=explode(",",$_POST[user_orgxh]);//变成数组
	//判断不能给自己发信息
	if(in_array($_SESSION[userid],$user)){echo  "{\"statusCode\":\"300\",\"message\":\"请不要给自己发信息!\"}";exit;} //判断查
	$sql="INSERT INTO `cs_message` (`sender`,`address`,`type`,`intro`,`created_at` )
	VALUES ('$sender',',$_POST[user_orgxh]','$_POST[type]','$_POST[intro]', '$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"messlist\",\"callbackType\":\"closeCurrent\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}	
	exit;}//写入结束

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"信息发送");
	$smt->display('mess/mess_new.htm');
	exit;
}
//发送信息添加	
if($do=="messreply"){
	//If_rabc($action,$do); //检测权限
	//查询
	$sql="SELECT * FROM `cs_message` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$row[sender_txt] = $user_list[$row[sender]];
	if(isset($_POST['intro'])){
	$created_at=date("Y-m-d H:i:s", time());
	$sender=$_SESSION[userid];
	$sql2="INSERT INTO `cs_message` (`tid`,`sender`,`address`,`type`,`intro`,`created_at` )
	VALUES ('$_POST[tid]','$sender',',$_POST[address]','3','$_POST[intro]', '$created_at');";
	if($db->query($sql2)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"messlist\",\"callbackType\":\"closeCurrent\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}	
	exit;}//写入结束

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"信息发送");
	$smt->display('mess/mess_reply.htm');
	exit;
}
//发送信息显示	
if($do=="messshow"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_message` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$tid=$row[tid];
	if($row[tid]!='0'){$row[original]='<a href="?action=smsmail&do=messshow&id='.$tid.' "target="dialog" title="查看发件信息"> &#9758;原信息</a>';}else{$row[original]='';}
	
	$read =','.$_SESSION[userid].'R';
	if(stripos($row[isread],$read)=== false){
	$sql2="UPDATE `cs_message` SET `isread` = concat(isread,'$read') WHERE `cs_message`.`id` ='$id' LIMIT 1 ;";
	$db->query($sql2);}
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$row[sender_txt] = $user_list[$row[sender]];
	$list_zxr = explode(",",$row[address]);
		foreach($list_zxr as $k=>$v){
			$row[address_txt] .= $user_list[$v].",";
		}
		if($row[address]=="0"){$row[address_txt]="所有人";}
		$row[type_cn] = strtr($row[type],$messtype);
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"信息详细");
	$smt->display('mess/mess_show.htm');
	exit;
}
//删除消息
if($do=="messdel"){
	If_rabc($action,$do); //检测权限
	//查询
	$sql="SELECT * FROM `cs_message` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$del =','.$_SESSION[userid].'D';
	if(stripos($row[isdel],$del)=== false){
	$sql2="UPDATE `cs_message` SET `isdel` = concat(isdel,'$del') WHERE `cs_message`.`id` ='$id' LIMIT 1 ;";
	$db->query($sql2);echo "{\"statusCode\":\"200\",\"message\":\"删除成功!\",\"navTabId\":\"messlist\",\"callbackType\":\"forward\"}";}
	else{
	echo "{\"statusCode\":\"300\",\"message\":\"操作错误,已经删除过了!\",\"navTabId\":\"messlist\",\"callbackType\":\"forward\"}";}	
	exit;
}
?>