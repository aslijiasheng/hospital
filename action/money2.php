<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " and i.name like '%$_POST[name]%'";}
	if($_POST['tel']){$search .= " and i.tel like '%$_POST[tel]%'";}
	if($_POST['salesid']){$search .= " and i.salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and s.created_at >  '$_POST[time_start] 00:00:00' AND  s.created_at <  '$_POST[time_over] 23:59:59'";
	}
	
	//判断用户级别显示
	if($_SESSION[roleid]=="3"){$search .= " and s.salesid2 = '$_SESSION[userid]'";} //销售
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_money` as s,`cs_info` as i where s.infoid = i.id $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//类型
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}


	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.typeid,i.xb,i.money,s.id,s.salesid3,s.infoid,s.sellid,s.sellproduct,s.sellvol,s.intro,s.created_at,s.sellvol,s.arrears,s.sellpay,s.money_ad,s.money_all FROM `cs_money` as s,`cs_info` as i where s.infoid = i.id $search order by s.id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][typeid_txt] = $type_list[$list[$key][typeid]];
		$list[$key][areaid_txt] = $type_list[$list[$key][areaid]];
		$list[$key][levelid_txt] = $type_list[$list[$key][levelid]];
		$list[$key][salesid3_txt] = $user_list[$list[$key][salesid3]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$list_sellproduct = explode(",",$list[$key][sellproduct]);
		$list_sellvol = explode(",",$list[$key][sellvol]);
		foreach($list_sellproduct as $k=>$v){
			$list[$key][sellproduct_txt] .= $productid[$v]." / ";
			$list[$key][sellvol_txt] .= $list_sellvol[$k]." / ";
		}
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid3_cn',select($salesid3,"salesid3","","销售选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"金额管理");
	$smt->display('money_list.htm');
	exit;
	
}

//列表2	
if($do=="list2"){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " and i.name like '%$_POST[name]%'";}
	if($_POST['tel']){$search .= " and i.tel like '%$_POST[tel]%'";}
	if($_POST['salesid']){$search .= " and i.salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and s.created_at >  '$_POST[time_start] 00:00:00' AND  s.created_at <  '$_POST[time_over] 23:59:59'";
	}
	
	//判断用户级别显示
	if($_SESSION[roleid]=="3"){$search .= " and s.salesid2 = '$_SESSION[userid]'";} //销售
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search and s.sellvol>0 ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//类型
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}


	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.typeid,i.xb,i.money,s.id,s.salesid2,s.infoid,s.sellproduct,s.sellvol,s.intro,s.created_at,s.fz,s.sellvol,s.arrears,s.money_ss FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search and s.sellvol>0 order by s.id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][typeid_txt] = $type_list[$list[$key][typeid]];
		$list[$key][areaid_txt] = $type_list[$list[$key][areaid]];
		$list[$key][levelid_txt] = $type_list[$list[$key][levelid]];
		$list[$key][salesid2_txt] = $user_list[$list[$key][salesid2]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$list_sellproduct = explode(",",$list[$key][sellproduct]);
		$list_sellvol = explode(",",$list[$key][sellvol]);
		foreach($list_sellproduct as $k=>$v){
			$list[$key][sellproduct_txt] .= $productid[$v]." / ";
			$list[$key][sellvol_txt] .= $list_sellvol[$k]." / ";
		}
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid3_cn',select($salesid3,"salesid3","","销售选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"客户消费详细");
	$smt->display('money_list2.htm');
	exit;
	
}


 //充值	
if($do=="gl"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	//类型
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}
	
	$row[typeid_txt] = $type_list[$row[typeid]];
	$row[areaid_txt] = $type_list[$row[areaid]];
	$row[levelid_txt] = $type_list[$row[levelid]];
	$row[salesid_txt] = $user_list[$row[salesid]];
	
	$productid_arr=explode(',',$row[productid]);
	foreach($productid_arr as $key=>$val){
		$row[productid_txt].= "<input type=\"text\" name=\"sellproduct[]\" value=\"".$val."\" style=\"display:none;\"/>金额:<input type=\"text\" name=\"sellvol[]\" value=\"\" style=\"float:none;width:30px\"/> (".$type_list[$val] .")";
	}

	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"充值");
	$smt->display('money_add.htm');
	exit;
}
 //充值写入
if($do=="gladd"){
	//dump($_POST);
	$salesid3=$_SESSION[userid];
	$created_at=date("Y-m-d H:i:s", time());
	$money_all=$_POST[money2]+$_POST[money_ad2];
	//sql
	$sql="INSERT INTO `cs_money` (`infoid` ,`intro`,`money_ad`,`created_at`,`salesid3`,`money_all`)
	VALUES ('$_POST[infoid]','$_POST[intro]','$_POST[money_ad2]','$created_at','$salesid3','$money_all');";
	if($db->query($sql)){
		$sql="UPDATE `cs_info` SET `money` =money+'$_POST[money_ad2]' WHERE `cs_info`.`id` ='$_POST[infoid]' LIMIT 1 ;";
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=money\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=money\"}";}
	exit;
}
//本次消费+改自		
if($do=="pay"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT i.name,i.money,s.id,s.salesid,s.infoid,s.productid,s.pay,s.money_ss,s.intro FROM `cs_zhiliao` as s,`cs_info` as i where s.infoid = i.id and s.id='$id'  LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();

	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"添加消费");
	$smt->display('money_pay.htm');
	exit;
}

//本次消费写入
if($do=="payadd"){
	If_rabc($action,$do); //检测权限
	$salesid2=$_SESSION[userid];
	$post_sellproduct = implode(",",$_POST[sellproduct]);
	$post_sellvol = implode(",",$_POST[sellvol]);
	$created_at=date("Y-m-d H:i:s", time());
	$money_all=$_POST[money]-$_POST[sellpay];

	$sql="INSERT INTO `cs_money` (`infoid` ,`sellid` ,`intro`,`sellpay`,`sellvol`,`arrears`,`created_at`,`salesid3`,`money_all`)
	VALUES ('$_POST[infoid]','$_POST[sellid]', '$_POST[intro]','$_POST[yepay]','$_POST[sellvol2]','$_POST[arrears2]','$created_at','$salesid3','$money_all');";
	if($db->query($sql)){
		$sql="UPDATE cs_zhiliao inner join cs_info ON cs_zhiliao.infoid = cs_info.id SET 
		`cs_zhiliao`.`money_ss` ='$_POST[money_ss]'+'$_POST[yepay]',
		`cs_zhiliao`.`money_qf`=cs_zhiliao.pay-'$_POST[money_ss]'-'$_POST[yepay]',
		`cs_sell`.`money_ss`=cs_sell.money_ss+'$_POST[sellvol2]'+'$_POST[sellpay]',`cs_info`.`money`=cs_info.money-'$_POST[sellpay]'-'$_POST[arrears2]' WHERE `cs_sell`.`id` ='$_POST[sellid]' and `cs_info`.`id` ='$_POST[infoid]';";
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=money\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=money\"}";}
	exit;
}

?>