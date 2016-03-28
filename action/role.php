<?php
if(!defined('CORE'))exit("error!"); 

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	if($_POST['title']){$search .= "and title like '%$_POST[title]%'";}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_role` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数

	
	//查询
	$sql="SELECT * FROM `cs_role` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][role_cn]=$role_cn[$list[$key][role_id]];		
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"角色列表");
	$smt->display('user/role_list.htm');
	exit;
	
}

//面板	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	if($_POST[title]){
	$action=implode(',',$_POST[action]);
	$sql="INSERT INTO `cs_role` (`title` ,`action`)
	VALUES ( '$_POST[title]', '$action');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=role\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=role\"}";}	
	exit;
	}
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('checkbox_role_action',checkbox_role_action());
	$smt->assign('row',$row);
	$smt->assign('title',"新建角色");
	$smt->display('user/role_new.htm');
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	if($_POST[title]){
	$id=$_POST['id'];
	$action=implode(',',$_POST[action]);
	
	$sql="UPDATE `cs_role` SET 
	`title` = '$_POST[title]',
	`action` = '$action' WHERE `cs_role`.`id` =$id LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=role\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=role\"}";}	
	exit;
	}
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_role` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();

	//模版
	$smt->assign('checkbox_role_action',checkbox_role_action($row[action]));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑角色");
	$smt->display('user/role_edit.htm');
	exit;
}


//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	echo  "{\"statusCode\":\"300\",\"message\":\"禁止删除!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=role\"}";
	exit;
	$sql="delete from `cs_role` where `cs_role`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=role\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=role\"}";}	
	exit;
}
?>