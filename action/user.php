<?php
if(!defined('CORE'))exit("error!");
//验证登录
if($do=="loginok"){
	$name=$_POST[username];
	$pwd=$_POST[password];

	$validate_arr=array($name,$pwd);
	Ifvalidate($validate_arr);
	$sql = "SELECT id,username,roleid,free from cs_user WHERE username = '$name' AND password = md5('$pwd') limit 1";
	$db->query($sql);
	$active=rand(100,9999);
	
	if ($record = $db->fetchRow()){	//登录成功
	    
		//if(time()-$_SESSION['activetime']<20*60){echo "<script>alert(\"该用户目前已经登入{$_SESSION['activetime']}，可联系管理员让其强行退出!\");window.location=\"index.php?action=user&do=login\";</script>";exit;}
		$_SESSION['isLogin'] 	= true;
		$_SESSION['userid']		= $record['id'];
		$_SESSION['username']	= $record['username'];
		$_SESSION['roleid']	= $record['roleid'];
		$_SESSION['app']	= $mt["app"];
		$_SESSION['active']	= $active;
		if($record['free']==0){
		$sql="UPDATE `cs_user` SET `active` = '$active' WHERE `cs_user`.`id` ='$record[id]' LIMIT 1 ;";
		$db->query($sql);	
			exit($lang_cn['rabc_login_ok']);
		}else{$_SESSION['isLogin'] 	= false;
			exit($lang_cn['rabc_login_dj']);
		}
	}
	else
		exit($lang_cn['rabc_login_error']);
	
	exit;
}
  

//登录	
if($do=="login"){
	require_once("include/cfg.php");		  //配置类
	$row[syslogo] = $config['syslogo'];//系统logo图片
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"登录");
	$smt->display('user_login.htm');
	exit;
}


//退出	
if($do=="logout"){
	$sql="UPDATE `cs_user` SET `active` = NULL WHERE `cs_user`.`id` ='$_SESSION[userid]' LIMIT 1 ;";
	$db->query($sql);
	$_SESSION = array();	
	session_destroy();
	exit($lang_cn['rabc_logout']);
}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	if($_POST['username']){$search .= "and username like '%$_POST[username]%'";}	
	if($_POST['roleid']){$search .= "and roleid = '$_POST[roleid]'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_user` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询
	$sql="SELECT * FROM `cs_user` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();	
	
	
	//角色数组
	$sql_role="SELECT id,title FROM `cs_role`";
	$db->query($sql_role);
	$list_role=$db->fetchAll();
	
	//格式化输出数据
	foreach($list_role as $key=>$val){
		$role_cn[$list_role[$key][id]]=$list_role[$key][title];
	}
	
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][role_cn]=$role_cn[$list[$key][roleid]];
		$free1=array('1'=>'<font style=color:#ccc; >已冻结</font>','0'=>'良好');
		$list[$key][zt] = strtr($list[$key][free],$free1);
	}
	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('select_role_cn',select($role_cn,"roleid","","选择角色","required"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"用户列表");
	$smt->display('user/user_list.htm');
	exit;
	
}


//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	
	//角色数组
	$sql="SELECT id,title FROM `cs_role`";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//格式化角色数据
	foreach($list as $key=>$val){
		$role_cn[$list[$key][id]]=$list[$key][title];		
	}
	
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('select_role_cn',select($role_cn,"roleid","","选择角色","required"));
	$smt->assign('title',"新建用户");
	$smt->display('user/user_new.htm');
	exit;
}

//编辑	
if($do=="edit"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_user` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[free]==0){$row[checked0]='checked';}else{$row[checked1]='checked';}
	//角色数组
	$sql_role="SELECT id,title FROM `cs_role`";
	$db->query($sql_role);
	$list_role=$db->fetchAll();
	
	//格式化角色数据
	foreach($list_role as $key=>$val){
		$role_cn[$list_role[$key][id]]=$list_role[$key][title];		
	}
	
	//模版
	$smt->assign('select_role_cn',select($role_cn,"roleid",$row[roleid],"选择角色","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑用户");
	$smt->display('user/user_edit.htm');
	exit;
}


//修改密码	
if($do=="editpass"){	
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_user` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"修改个人信息");
	$smt->display('user/user_edit_pass.htm');
	exit;
}

//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$created_at=date("Y-m-d H:i:s", time());
	$password=md5($_POST[password]);
	
	//查询
	$sql="SELECT * FROM `cs_user` where username ='$_POST[username]' LIMIT 1";
	$db->query($sql);
	if($db->fetchRow()){echo  "{\"statusCode\":\"300\",\"message\":\"错误!用户已存在!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user\"}";exit();}
	
	$sql="INSERT INTO `cs_user` (`username` ,`password` ,`roleid` ,`tel` ,`created_at` )
	VALUES ( '$_POST[username]', '$password', '$_POST[roleid]','$_POST[tel]', '$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user\"}";}
	exit;
}

//更新密码
if($do=="updatapass"){
	If_rabc($action,$do); //检测权限
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_SESSION['userid'];
	if($_POST[password]){
		$password=md5($_POST[password]);
		$pasql="`password`='$password',";
	}
	$sql="UPDATE `cs_user` SET $pasql
	`updated_at` = '$updated_at',`tel` = '$_POST[tel]' WHERE `cs_user`.`id` =$id LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=logout\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=logout\"}";}	
	exit;
}

//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_POST['id'];
	
	if($_POST[password]){
		$password=md5($_POST[password]);
		$pasql="`password`='$password',";
	}
	$sql="UPDATE `cs_user` SET 
	$pasql
	`roleid`  = '$_POST[roleid]',
	`username`  = '$_POST[username]',
	`free`  = '$_POST[free]',
	`updated_at` = '$updated_at',`tel` = '$_POST[tel]' WHERE `cs_user`.`id` =$id LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user\"}";}
	exit;
}
//序列号验证
if($do=="xlh"){
	include_once('include/jqm.php');
	$smt = new smarty();smarty_cfg($smt);
	$row[jqm]=$robotstr;
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"系统注册");
	$smt->display('key.htm');
	exit;
}
//序列号验证
if($do=="xlhad"){
	include_once('include/jqm.php');
	$xlh=$_POST[xlh];
	if($xlh==$robotxlh){
	$fp=fopen("key.txt","r+"); 
	if($fp==NULL){ echo "找不到key文件";} 
	else{rewind($fp);//指针移到文件头
	fopen("key.txt","w");//清空内容
	$sql=fputs($fp, $xlh);//写入 
    fclose($fp); 
	echo "欢迎使用正版系统,祝你使用愉快^-^--重新打开就可以用了";}}
	else{echo"你猜啊！你的序列号肯定不对了--<a href=?action=user&do=xlh >返回上页继续猜……</a>";}
	exit;
}


//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	if($id=='1'){echo  "{\"statusCode\":\"300\",\"message\":\"该用户为初始管理员，你不能删除!\"}";exit;}	
	$sql="delete from `cs_user` where `cs_user`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user\"}";}	
	exit;
}

//执行人员列表	
if($do=="listzx"){
	If_rabc($action,$do); //检测权限
	if($_POST['zxname']){$search .= "and zxname like '%$_POST[zxname]%'";}	
	if($_POST['typeid']){$search .= "and typeid = '$_POST[typeid]'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_user_zx` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询
	$sql="SELECT * FROM `cs_user_zx` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();	
	
	
	//科室选择
	$sql_type="SELECT id,title FROM `cs_type` where type='productid' ";
	$db->query($sql_type);
	$list_ks=$db->fetchAll();
	foreach($list_ks as $key=>$val){
		$type_ks[$list_ks[$key][id]]=$list_ks[$key][title];	
	}

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][typeid_cn]=$type_ks[$list[$key][typeid]];
		$free1=array('1'=>'<font style=color:#ccc; >已冻结</font>','0'=>'良好');
		$list[$key][zt] = strtr($list[$key][free],$free1);
	}
	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('type_ks_cn',select($type_ks,"typeid","","科室选择",""));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"用户列表");
	$smt->display('userzx_list.htm');
	exit;
	
}
//新建工作人员	
if($do=="newzx"){	
	
	$sql="SELECT * FROM `cs_type` where type='productid' order by id";
	$db->query($sql);
	$list=$db->fetchAll();
	//科室选择
	$sql_type="SELECT id,title FROM `cs_type` where type='productid' ";
	$db->query($sql_type);
	$list_ks=$db->fetchAll();
	foreach($list_ks as $key=>$val){
		$type_ks[$list_ks[$key][id]]=$list_ks[$key][title];	
	}

	
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('type_ks_cn',select($type_ks,"typeid","","科室选择","required"));
	$smt->assign('title',"工作人员创建");
	$smt->display('userzx_new.htm');
	exit;
}
//写入
if($do=="addzx"){
	If_rabc($action,$do); //检测权限
	$created_at=date("Y-m-d H:i:s", time());
	
	//查询
	$sql="SELECT * FROM `cs_user_zx` where zxname ='$_POST[zxname]' LIMIT 1";
	$db->query($sql);
	if($db->fetchRow()){echo  "{\"statusCode\":\"300\",\"message\":\"错误!用户已存在!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=listzx\"}";exit();}
	
	$sql="INSERT INTO `cs_user_zx` (`zxname` ,`typeid` ,`created_at` )
	VALUES ( '$_POST[zxname]',  '$_POST[typeid]', '$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=listzx\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=listzx\"}";}
	exit;
}
//执行人员编辑	
if($do=="editzx"){	
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_user_zx` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[free]==0){$row[checked0]='checked';}else{$row[checked1]='checked';}
	//科室选择
	$sql_type="SELECT id,title FROM `cs_type` where type='productid' ";
	$db->query($sql_type);
	$list_ks=$db->fetchAll();
	foreach($list_ks as $key=>$val){
		$type_ks[$list_ks[$key][id]]=$list_ks[$key][title];	
	}
	
	//模版
	$smt->assign('select_role_cn',select($role_cn,"roleid",$row[roleid],"选择角色","required"));
	$smt->assign('type_ks_cn',select($type_ks,"typeid",$row[typeid],"科室选择","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑用户");
	$smt->display('userzx_edit.htm');
	exit;
}
//更新
if($do=="updatazx"){
	If_rabc($action,$do); //检测权限
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_POST['id'];
	
	$sql="UPDATE `cs_user_zx` SET
	`zxname`  = '$_POST[zxname]',
	`typeid`  = '$_POST[typeid]',
	`free`  = '$_POST[free]',
	`updated_at` = '$updated_at' WHERE `cs_user_zx`.`id` =$id LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=listzx\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=listzx\"}";}
	exit;
}

//删除
if($do=="delzx"){
	If_rabc($action,$do); //检测权限	
	$sql="delete from `cs_user_zx` where `cs_user_zx`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=listzx\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=user&do=listzx\"}";}	
	exit;
}

//查找带回执行人员列表	
if($do=="listzxdh"){
	if($_POST['zxname']){$search .= "and zxname like '%$_POST[zxname]%'";}	
	if($_POST['typeid']){$search .= "and typeid = '$_POST[typeid]'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_user_zx` where free=0 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询1
	$sql="SELECT * FROM `cs_user_zx` where free=0 $search order by typeid desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();	

	
	//科室选择
	$sql_type="SELECT id,title FROM `cs_type` where type='productid' ";
	$db->query($sql_type);
	$list_ks=$db->fetchAll();
	foreach($list_ks as $key=>$val){
		$type_ks[$list_ks[$key][id]]=$list_ks[$key][title];	
	}

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][typeid_cn]=$type_ks[$list[$key][typeid]];
		$free1=array('1'=>'<font style=color:#ccc; >已冻结</font>','0'=>'良好');
		$list[$key][zt] = strtr($list[$key][free],$free1);
	}
	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('list2',$list2);
	$smt->assign('list3',$list3);
	$smt->assign('total',$total);
	$smt->assign('type_ks_cn',select($type_ks,"typeid","","科室选择",""));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"用户列表");
	$smt->display('user/userzx_list_dh.htm');
	exit;
	
}
//查找带回用户列表	
if($do=="listdh"){
	if($_POST['username']){$search .= "and username like '%$_POST[username]%'";}	
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_user` where free=0 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询1
	$sql="SELECT * FROM `cs_user` where free=0 $search  LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();	

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][typeid_cn]=$type_ks[$list[$key][typeid]];
	}
	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('title',"用户列表");
	$smt->display('user/user_list_dh.htm');
	exit;
	
}
?>