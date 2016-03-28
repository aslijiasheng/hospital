<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类

//优惠券列表	
if($do=="couponlist"){
	
	//dump($_SESSION);
	//判断检索值
	if($_POST['b']){$search .= " and (i.name like '%$_POST[b]%' || s.tel like '%$_POST[b]%')";}
	if($_POST['yhq']){$search .= " && yhq = '$_POST[yhq]'";}
	if($_POST['salesid']){$search .= " && salesid_yhq = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND  `created_at` <  '$_POST[time_over] 23:59:59'";
	}	
		
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_yhq` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//客户名称
	$sql_name="SELECT id,name FROM `cs_info` ";
	$db->query($sql_name);
	$name_arr=$db->fetchAll();
	foreach($name_arr as $key=>$val){
		$name_list[$name_arr[$key][id]]=$name_arr[$key][name];	
	}
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//查询
	$sql="SELECT i.name,s.salesid_yhq,s.salesid_czr,s.infoid,s.id,s.yhq,s.lx,s.created_at,s.expire_at,s.tel,s.updated_at,s.handle FROM `cs_info` as i,`cs_yhq` as s where i.id=s.infoid $search order by id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][name] = $name_list[$list[$key][infoid]];
		$list[$key][ffr] = $user_list[$list[$key][salesid_yhq]];
		$list[$key][czr] = $user_list[$list[$key][salesid_czr]];
		
		$handle=array('0'=>'<span style=color:#666;>未使用</span>','1'=>'<span style=color:#f00;>已使用</span>');
		$list[$key][handle_cn] = strtr($list[$key][handle],$handle);
		if($list[$key][updated_at]=='0000-00-00 00:00:00'){$list[$key][updated]="--";}else{$list[$key][updated]=$list[$key][updated_at];}
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($salesid,"salesid_yhq","","发放人"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('yhq_list.htm');
	exit;
	
}


//优惠券删除
if($do=="coupondel"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `cs_yhq` where `cs_yhq`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=plug&do=couponlist\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=plug&do=couponlist\"}";}		
	exit;
}
//优惠券处理
if($do=="couponhandle"){
	$updated_at=date("Y-m-d H:i:s", time());
	//查询
	$sql2="SELECT * from `cs_yhq` where `cs_yhq`.`id`=$id limit 1";
	$db->query($sql2);
	$list=$db->fetchAll();
	foreach($list as $key=>$val){
		if($list[$key][handle]==1){echo "{\"statusCode\":\"300\",\"message\":\"操作错误,该优惠券于".$list[$key][updated_at]."已使用!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=plug&do=couponlist\"}";}
	else{
	
	$sql="UPDATE `cs_yhq` set
	`handle` = 1,
	`salesid_czr` = '$_SESSION[userid]',
	`updated_at` = '$updated_at' WHERE `cs_yhq`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=plug&do=couponlist\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=plug&do=couponlist\"}";}
	}}
	exit;
}
//公用查看文件调用
if($do=="publicshow"){
	$row[src]=$src;
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('row',$row);
	$smt->assign('title',"配置列表");
	$smt->display('public_show.htm');
	exit;	
}
?>