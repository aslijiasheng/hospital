<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类
include(CORE."include/cfgqt.php");		  //配置类2
$idx=explode(",",$id);//多值id
$id=$idx[0];


//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	
	$b=explode("#",$_POST[nt]);
	$b2=trim($_POST[nt]);
	if($type!=''){$search .= " && s.type = '$type'";$mb='visits/visits_list_'.$type.'.htm';}//判断类型显示列表
	if($_POST['nt']){$search .= " and (i.id='$b[1]' || i.name like '%$b2%' || i.tel like '%$b2%')";}
	if($_POST['salesid5']){$search .= " and s.salesid5 = '$_POST[salesid5]'";}
	if($_POST['pingjia']){$search .= " and s.pingjia = '$_POST[pingjia]'";}
	if($_POST['hfnum']){$search .= " and i.hfnum >= '$_POST[hfnum]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and s.created_at >=  '$_POST[time_start] 00:00:00' AND  s.created_at <=  '$_POST[time_over] 23:59:59'";
	}
	if($hfat){$search .= " && s.created_at = '$hfat'";}//首页快捷信息传值
	
	$yhz=explode(",",$config['visitssee']);//变成数组
	//判断用户级别显示
	if(in_array($_SESSION[roleid],$yhz)&&empty($_POST['nt'])){$search .= " and s.salesid5 = '$_SESSION[userid]'";} //判断查看和搜索显示
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_visits` as s,`cs_info` as i where s.infoid = i.id $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询
	$sql="SELECT i.id,i.name,i.tel,i.zxxm,i.typeid,i.visitnum,i.money,i.hfnum,s.id,s.infoid,s.salesid5,s.intro,s.pingjia,s.created_at FROM `cs_visits` as s,`cs_info` as i where s.infoid = i.id $search order by s.id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid5]];
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($salesid,"salesid5","","回访人"));
	$smt->assign('v_evaluate_cn',select($v_evaluate,"pingjia","","满意度"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('salesid5',$_POST[salesid5]); //登记人
	$smt->assign('time_start',$_POST[time_start]); //开始时间
	$smt->assign('time_over',$_POST[time_over]); //结束时间
	$smt->assign('pingjia',$_POST[pingjia]); //结束时间
	$smt->assign('hfnum',$_POST[hfnum]); //结束时间
	$smt->assign('type',$type); //结束时间
	$smt->assign('title',"回访列表");
	$smt->display($mb);
	exit;
	
}
 //新建回访	
if($do=="new"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['add'])){
	$salesid5=$_SESSION[userid];
	$created_at=date("Y-m-d H:i:s", time());
	$intro=$_POST[intro];
	$num=1;
	$pingjia=$_POST[pingjia];
	$type=0;
	//短信处理方法
	$handle="1,".$salesid5;
	if($_POST[clfs]!=''){$sql2="UPDATE `msg_inbox` SET `handle` = '$handle' WHERE `msg_inbox`.`id` ='$_POST[clfs]' LIMIT 1 ;";
		$db->query($sql2);}
	//sql
	if($_POST[visits_at]!=''){$created_at=$_POST[visits_at];$type=1;$intro=$_POST[intro2];$num=0;$pingjia="";}
	$sql="INSERT INTO `cs_visits` (`infoid` ,`intro`,`created_at`,`salesid5`,`pingjia`,`type`)
	VALUES ('$_POST[infoid]','$intro','$created_at','$salesid5','$pingjia','$type');";
	if($db->query($sql)){$sql3="UPDATE `cs_info` SET `hfnum` = hfnum+$num WHERE `cs_info`.`id` ='$_POST[infoid]' LIMIT 1 ;";
		$db->query($sql3);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"callbackType\":\"closeCurrent\"}";}
	exit;
	}//回访写入
	
	if($id1){$idx=explode(",",$id1);//判断多值id传值
    $id=$idx[1];}
	//查询
	if($id=="")exit('不是本系统客户，请先登记');
	$sql="SELECT id,name,tel,yy_at FROM `cs_info` where id=$id  LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//短信回复处理
	if($clfs!=''){$row[clfs]=$clfs;}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('v_evaluate_cn',radio($v_evaluate,"pingjia"));
	$smt->assign('title',"增加回访");
	$smt->display('visits/visits_add.htm');
	exit;
}

//展示	
if($do=="show"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.typeid,i.visitnum,i.money,s.id,s.infoid,s.salesid5,s.intro,s.pingjia,s.created_at FROM `cs_visits` as s,`cs_info` as i where s.infoid = i.id and s.id=$id order by s.id desc LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	
	$row[salesid_txt] = $user_list[$row[salesid5]];


	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"回访明细");
	$smt->display('visits/visits_show.htm');
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['updata'])){
	$created_at2=date("Y-m-d",strtotime("-2 day"));//时间往后2天
	$created_at=$_POST[created_at];

	if($created_at>=$created_at2){$sql="UPDATE `cs_visits` SET `pingjia` = '$_POST[pingjia]', 
	`intro` = '$_POST[intro]',`visits_at` = '$_POST[visits_at]' WHERE `cs_visits`.`id` ='$_POST[id]' LIMIT 1;";
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"visits\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"信息已过期,不能修改。只能修改3天以内的信息!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=visits\"}";}
	exit;
		}//回访编辑
	$smt = new smarty();smarty_cfg($smt);
	
	//查询
	$sql="SELECT i.name,s.id,s.infoid,s.pingjia,s.intro,s.created_at,s.visits_at FROM `cs_visits` as s,`cs_info` as i where s.infoid=i.id and s.id=$id ";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('v_evaluate_cn',radio($v_evaluate,"pingjia",$row[pingjia]));
	$smt->assign('title',"编辑");
	$smt->display('visits/visits_edit.htm');
	exit;
}

//回访写入
if($do=="visitadd"){
	If_rabc($action,$do); //检测权限
	$salesid2=$_SESSION[userid];
	$post_sellproduct = implode(",",$_POST[sellproduct]);
	$post_sellvol = implode(",",$_POST[sellvol]);
	$created_at=date("Y-m-d H:i:s", time());

	$sql="INSERT INTO `cs_sell` (`infoid` ,`intro`,`sellproduct` ,`sellvol`,`created_at`,`salesid2`,`fz`)
	VALUES ('$_POST[infoid]', '$_POST[intro]','$post_sellproduct','$post_sellvol','$created_at','$salesid2','$_POST[fz]');";
	if($db->query($sql)){
		$sql="UPDATE `cs_info` SET `name` = '$_POST[name]',`visitnum` = visitnum+1 WHERE `cs_info`.`id` ='$_POST[infoid]' LIMIT 1 ;";
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=visit\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=visit\"}";}
	exit;
}

//查询5单条查询
if($do=="chaxun1"){	
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$sql="SELECT i.name,s.id,s.infoid,s.intro,s.salesid5,s.created_at,s.pingjia FROM `cs_visits` as s,`cs_info` as i where s.infoid = i.id and s.infoid='$id' order by s.id desc LIMIT 5";
	if($nu=mysql_num_rows(mysql_query($sql))<=0){echo"系统没有记录该客户的回访信息";}
	else{
	//用户
	$db->query($sql);
	
echo '<style>.lb{margin:0;padding:0;}.lb li{background:#FFF; text-align:left;line-height:20px;font-size:12px;list-style:none;}span{padding_left:5px;}</style>';
echo '<ul class="lb">';
while($row=$db->fetchRow()){$row[salesid_txt] = $user_list[$row[salesid5]];
echo '<li>'.$row[created_at].'--<b>姓名: </b>'.$row[name].'--<b>回访人: </b>'.$row[salesid_txt].'--<b>评价: </b>'.$row[pingjia].'--<b>备注: </b>'.$row[intro].'----</li>';}}
echo '</ul>';
exit;
}

?>

