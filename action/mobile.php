<?php
if(!defined('CORE'))exit("error!"); 
include(CORE."include/cfg.php");		  //配置类

//首页	
if($do==""){
	if(!isLogin()){exit($lang_cn['rabc_is_mobile_login']);} //判断是否登录
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}	
	if($_POST['address']){$search .= " and address like '%$_POST[address]%'";}
	if($_POST['areaid']){$search .= " and areaid = '$_POST[areaid]'";}
	if($_POST['typeid']){$search .= " and typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}
	if($_POST['levelid']){$search .= " and levelid = '$_POST[levelid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND  `created_at` <  '$_POST[time_over] 23:59:59'";
	}
	
	//判断用户级别显示
	if($_SESSION[roleid]=="2"){$search .= " and salesid = '$_SESSION[userid]'";} //销售
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_info` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//地区
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
	$sql="SELECT * FROM `cs_info` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","销售选择"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"客户列表");
	$smt->display('m_info.htm');
	exit;
}

//新建	
if($do=="new"){	
	$smt = new smarty();smarty_cfg($smt);

	//查询
	$sql="SELECT id,name FROM `cs_info` where levelid in (27,28)";
	$db->query($sql);
	$list=$db->fetchAll();	
	foreach($list as $key=>$val){
		$parentid[$val[id]]=$val[name];	
	}
	//模版
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择","required"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择","required"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择","required"));
	$smt->assign('parentid_cn',select($parentid,"parentid","","上级选择","required"));
	$smt->assign('product_cn',checkbox_mobile($productid));
	$smt->assign('title',"新建");
	$smt->display('m_new.htm');
	exit;
}

//写入
if($do=="add"){
	$smt = new smarty();smarty_cfg($smt);
	$salesid=$_SESSION[userid];
	$post_productid = implode(",",$_POST[productid]);
	$sql="INSERT INTO `cs_info` (`name` ,`address`,`Hnumber` ,`tel`,`mail`,`clerk`,`areaid`,`salesid`,`typeid`,`levelid`,`productid`,`parentid`,`intro`)
	VALUES ('$_POST[name]', '$_POST[address]','$_POST[Hnumber]','$_POST[tel]','$_POST[mail]','$_POST[clerk]','$_POST[areaid]','$salesid','$_POST[typeid]','28','$post_productid','','$_POST[intro]');";
	if($db->query($sql)){	
		$message[link]="mobile.php";
		$smt->assign('message',$message);
		$smt->assign('title',"新建客户成功!");
		$smt->display('m_msg.htm');	
		exit;
	}else{
		$smt->assign('message',$message);
		$smt->assign('title',"新建客户失败!");
		$smt->display('m_msg.htm');	
		exit;
	}
}

//拜访	
if($do=="visit"){
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
		$row[productid_txt].= "<input type=\"text\" name=\"sellproduct[]\" value=\"".$val."\" style=\"display:none;\"/>(".$type_list[$val] .") 销售数量:<input type=\"text\" name=\"sellvol[]\" value=\"\" /> <br/>";
	}	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"拜访");
	$smt->display('m_visit.htm');
	exit;
}

//拜访写入
if($do=="visitadd"){
	$salesid=$_SESSION[userid];
	$post_sellproduct = implode(",",$_POST[sellproduct]);
	$post_sellvol = implode(",",$_POST[sellvol]);
	$created_at=date("Y-m-d H:i:s", time());
	$smt = new smarty();smarty_cfg($smt);
	$sql="INSERT INTO `cs_sell` (`infoid` ,`intro`,`sellproduct` ,`sellvol`,`created_at`,`salesid`)
	VALUES ('$_POST[infoid]', '$_POST[intro]','$post_sellproduct','$post_sellvol','$created_at','$salesid');";
	if($db->query($sql)){
		$sql="UPDATE `cs_info` SET `visitnum` = visitnum+1 WHERE `cs_info`.`id` ='$_POST[infoid]' LIMIT 1 ;";
		$db->query($sql);		
		$message[link]="mobile.php";
		$smt->assign('message',$message);
		$smt->assign('title',"拜访成功");
		$smt->display('m_msg.htm');		
		exit;
	}else{
		$smt->assign('message',$message);
		$smt->assign('title',"拜访失败");
		$smt->display('m_msg.htm');		
		exit;
	}
}

//公告文档	
if($do=="doc"){

	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_doc` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//类型
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}

	//查询
	$sql="SELECT * FROM `cs_doc` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][doctid_txt] = $type_list[$list[$key][doctid]];
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('m_doc.htm');
	exit;
	
}


//文档展示	
if($do=="docshow"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_doc` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	//类型
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}	
	
	$row[doctid_txt] = $type_list[$row[doctid]];

	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"明细");
	$smt->display('m_docshow.htm');
	exit;
}

//常用功能	
if($do=="soft"){
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('message',$message);
	$smt->assign('title',"常用功能");
	$smt->display('m_soft.htm');		
}

//登录	
if($do=="login"){
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"登录");
	$smt->display('m_login.htm');
	exit;
}

//验证登录
if($do=="loginok"){
	$name=$_GET[username];
	$pwd=$_GET[password];	
	
	$smt = new smarty();smarty_cfg($smt);
	$sql = "SELECT id,username,roleid from cs_user WHERE username = '$name' AND password = md5('$pwd') limit 1";
	$db->query($sql);
	if ($record = $db->fetchRow()){	//登录成功
		$_SESSION['isLogin'] 	= true;
		$_SESSION['userid']		= $record['id'];
		$_SESSION['username']	= $record['username'];
		$_SESSION['roleid']	= $record['roleid'];
		$_SESSION['app']	= $cfg["app"];
		$message[link]="mobile.php";
		$smt->assign('message',$message);
		$smt->assign('title',"登录成功");
		$smt->display('m_msg.htm');
		exit();
	}else{
		$message[link]="";
		$smt->assign('message',$message);
		$smt->assign('title',"密码错误!");
		$smt->display('m_msg.htm');
		exit();
	}
}

//退出	
if($do=="logout"){
	$smt = new smarty();smarty_cfg($smt);
	$_SESSION = array();
	session_destroy();
	$message[link]="mobile.php";
	$smt->assign('message',$message);
	$smt->assign('title',"退出成功!");
	$smt->display('m_msg.htm');
	exit();
}


?>
