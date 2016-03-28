<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类
include(CORE."include/cfgqt.php");		  //配置类2
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['title']){$search .= " and title like '%$_POST[title]%'";}
	if($_POST['doctid']){$search .= " && doctid = '$_POST[doctid]'";}
	if($_POST['salesid']){$search .= " && salesid = '$_POST[salesid]'";}
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
	$info_num=mysql_query("SELECT * FROM `cs_doc` where 1=1 $search");//当前频道条数
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
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('doctid_cn',select($doctid,"doctid","","公告类型"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","发布人"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display('doc/doc_list.htm');
	exit;
	
}

//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	if(isset($_POST['title'])){
	$salesid=$_SESSION[userid];
	$sx=$_POST[color].",".$_POST[sx1].",".$_POST[sx2].",".$_POST[sx3].",";
	$created_at=date("Y-m-d H:i:s", time());
	$sql="INSERT INTO `cs_doc` (`title` ,`doctid`,`intro` ,`created_at`,`salesid`,`sx`)
	VALUES ('$_POST[title]', '$_POST[doctid]','$_POST[intro]','$created_at','$salesid','$sx');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=doc\"}";}
	exit;
	}//文档写入完毕
	
	$sx3=array("0"=>"1号","3"=>"2号","6"=>"3号");

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('doctid_cn',select($doctid,"doctid","","选择类型","required"));
	$smt->assign('zhid_cn',select($sx3,"sx3","","大小"));
	$smt->assign('row',$row);
	$smt->assign('title',"新建");
	$smt->display('doc/doc_new.htm');
	exit;
}


//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['title'])){
	$sx=$_POST[color].",".$_POST[sx1].",".$_POST[sx2].",".$_POST[sx3].",";
	$updated_at=date("Y-m-d H:i:s", time());
	$post_productid = implode(",",$_POST[productid]);
	//sql
	$sql="UPDATE `cs_doc` SET 
	`title` = '$_POST[title]',
	`doctid` = '$_POST[doctid]',
	`intro` = '$_POST[intro]',
	`sx` = '$sx',
	`updated_at` = '$updated_at' WHERE `cs_doc`.`id` ='$_POST[id]' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc\"}";}	
	exit;
	}//更新部分
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_doc` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$sx=explode(",",$row[sx]);
	$row[color]=$sx[0];
	if($sx[1]==1){$row[checked1]='checked';}else{$row[checked1]='';}
	if($sx[2]==1){$row[checked2]='checked';}else{$row[checked2]='';}
	$sx3=array("0"=>"1号","3"=>"2号","6"=>"3号");
	
	//模版
	$smt->assign('doctid_cn',select($doctid,"doctid",$row[doctid],"类型选择","required"));
	$smt->assign('zhid_cn',select($sx3,"sx3",$sx[3],"大小","combox"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	$smt->display('doc/doc_edit.htm');
	exit;
}
//展示	
if($do=="show"){
	If_rabc($action,$do); //检测权限
	//查询
	$sql="SELECT * FROM `cs_doc` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	//栏目类型
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}	
	$row[doctid_txt] = $type_list[$row[doctid]];
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$row[salesid_txt]=$user_list[$row[salesid]];

	//设置分页回复列表开始
	$row[fyid]=$id;
	if($_POST[pageNum]>1){$row[xs2]="style=display:none;";}
	if($_POST[numPerPage]==""){
		$numPerPage="8";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_doc_reply` where docid='$id'");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	
	//查询
	$sql="SELECT * FROM `cs_doc_reply` where docid='$id' LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][doctid_txt] = $type_list[$list[$key][doctid]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		if($list[$key][intro_r]==""){$list[$key][xs]="style=display:none;";}
	}//回复列表部分
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"文档详细");
	$smt->display('doc/doc_show.htm');
	exit;
}
//回复	
if($do=="reply"){	
	If_rabc($action,$do); //检测权限
	$salesid=$_SESSION[userid];
	$created_at=date("Y-m-d H:i:s", time());
	if(isset($_POST['introtj'])){
	$sql="INSERT INTO `cs_doc_reply` (`title_r` ,`docid`,`created_at`,`salesid`)
	VALUES ('$_POST[introtj]', '$_POST[docid]','$created_at','$salesid');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"docsee\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=doc\"}";}
	exit;
	}//文档写入完毕
	if(isset($_POST[intro_r])){
	$intro_r="<div><span class=zz>".$_SESSION[username].":</span> ".$_POST[intro_r]." <span class=sm >| ".$created_at."</span></div><div class=divider>divider</div>";
	$sql="UPDATE `cs_doc_reply` SET 
	`intro_r` = concat(intro_r,'$intro_r') WHERE `cs_doc_reply`.`id` ='$_POST[hid]' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"docsee\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc\"}";}	
	exit;
	} 
	$row[hid]=$hid;
	
    
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"回复");
	$smt->display('doc/doc_reply.htm');
	exit;
}
//回复窗口
if($do=="reply2"){	
	$smt = new smarty();smarty_cfg($smt);

	//模版
	$smt->assign('title',"回复");
	$smt->display('doc/doc_reply.htm');
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="SELECT wjbz FROM `cs_doc` where id='$id' LIMIT 1";//搜索文件标志
	$db->query($sql);
	$row=$db->fetchRow();
	$sql="delete from `cs_doc` where `cs_doc`.`id`=$id limit 1";
	if($db->query($sql)){
		$sql2="delete from `cs_doc_reply` where `cs_doc_reply`.`docid`=$id ";
		$db->query($sql2);

		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!{$wjmu}\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc\"}";}		
	exit;
}
//日程列表	
if($do=="work"){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	if(empty($view)){echo "{\"statusCode\":\"300\",\"message\":\"无效参数!\"}";exit;}
	//判断检索值
	if($_POST['title']){$search .= " and title like '%$_POST[title]%'";}
	if($_POST['doctid']){$search .= " && doctid = '$_POST[doctid]'";}
	if($_POST['salesid']){$search .= " && salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and `created_at` >  '$_POST[time_start] 00:00:00' AND  `created_at` <  '$_POST[time_over] 23:59:59'";
	}	
	if($view=="me"){$search .= " && upsalesid = '$_SESSION[userid]'";}//
	if($view=="manage"){$search .= " && levelid = '$_SESSION[userid]'";}//
	if($view=="admin"){if($_SESSION[roleid]==1){$search .= " && 1=1";}else{echo "{\"statusCode\":\"300\",\"message\":\"你没有权限!\"}";exit;}}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_jqcalendar` where style>=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//查询
	$sql="SELECT * FROM `cs_jqcalendar` where style>=1 $search order by id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][salesid_txt] = $user_list[$list[$key][upsalesid]];
		//汇报类型
		$list[$key][stlye_cn] = strtr($list[$key][style],$workstyle);
		//审核状态
		$list[$key][state_cn] = strtr($list[$key][state],$w_state);
		if($list[$key][state]==0){$list[$key][score]="未评";}else{$list[$key][score] =$list[$key][score1]+$list[$key][score1];}
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('salesid_cn',select($salesid,"salesid","","报告人"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('view',$view); //结束时间
	$smt->assign('total',$total);
	$smt->assign('title',"日程列表");
	$smt->display('doc/work_list.htm');
	exit;
	
}
//新建工作报告	
if($do=="work_new"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['Subject'])){
	$salesid=$_SESSION[userid];
	$created_at=date("Y-m-d H:m:s", time());
	$row[time]=date("Y/m/d", time());
	
	$s_num=count($_POST[work_title]);
		for($i=0;$i<$s_num;$i++){
			$title.=$_POST[work_id][$i]."@#".$_POST[work_title][$i]."@#".$_POST[work_progress][$i]."@@@";
			
		}
	$sql="INSERT INTO `cs_jqcalendar` (`Subject` ,`levelid`,`Description` ,`StartTime`,`upsalesid`,`style`,`title`) VALUES ('$_POST[Subject]', '$_POST[salesid]','$_POST[Description]','$created_at','$salesid','$_POST[style]','$title');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"报告创建成功-办公管理-工作报告可查看!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=info\"}";}
	exit;
	}//文档写入完毕
	

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('salesid_cn',select($salesid,"salesid","","汇报对象选择","required"));
	$smt->assign('workstyle_cn',select($workstyle,"style","","汇报类型","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"新建工作报告");
	$smt->display('doc/work_new.htm');
	exit;
}
//编辑工作报告	
if($do=="work_edit"){	
	If_rabc($action,$do); //检测权限
	if(isset($_POST['Subject'])){
	$s_num=count($_POST[work_title]);
		for($i=0;$i<$s_num;$i++){
			$title.=$_POST[work_id][$i]."@#".$_POST[work_title][$i]."@#".$_POST[work_progress][$i]."@@@";
			
		}
	$sql="UPDATE `cs_jqcalendar` SET  `Subject`='$_POST[Subject]',`levelid`='$_POST[salesid]',`Description`='$_POST[Description]',`style`='$_POST[style]',`title`='$title' where `cs_jqcalendar`.`Id` ='$_POST[Id]' LIMIT 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"报告修改成功{$_POST[Id]}!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=doc&do=work\"}";}
	exit;
	}//文档写入完毕
	//查询
	$sql="SELECT * FROM `cs_jqcalendar` where style>=1 and id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($_SESSION[userid]!=$row[upsalesid]){echo "{\"statusCode\":\"300\",\"message\":\"你不能修改别人的报告!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}"; exit;}
	if($row[state]==1){echo "{\"statusCode\":\"300\",\"message\":\"报告已经审核，不能再编辑了!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}"; exit;}//修改判断
	$title2 = explode("@@@",$row[title]);

	$s_num=count($title2)-1;
		for($i=0;$i<$s_num;$i++){
			$title3= explode("@#",$title2[$i]);
			$row[tt].="<script type='text/javascript' src='javascripts/cs.slider.js'></script><TR class=unitBox sizset=\"{$i}\" ><TD ><INPUT class=\"digits textInput\" name=\"work.id[]\" value=\"{$title3[0]}\" size=3></TD><TD ><INPUT class=\"required textInput\" name=\"work.title[]\" value=\"{$title3[1]}\" size=50 ></TD><TD ><INPUT  name=\"work.progress[]\" value=\"{$title3[2]}\" size=3 class='easyui-slider' style='width:100px' data-options='showTip: true'></TD><TD><A class=\"btnDel \" href=\"javascript:void(0)\" >删除</A></TD></TR>";
		}

	


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('salesid_cn',select($salesid,"salesid",$row[levelid],"汇报对象选择","required"));
	$smt->assign('workstyle_cn',select($workstyle,"style",$row[style],"汇报类型","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"新建工作报告");
	$smt->display('doc/work_edit.htm');
	exit;
}
//领导审核	
if($do=="work_audit"){
	If_rabc($action,$do); //检测权限
	//查询
	$sql="SELECT * FROM `cs_jqcalendar` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//判断
	if($row[state]==1){echo "{\"statusCode\":\"300\",\"message\":\"已经审核过了，请勿重复审核!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=doc&do=work\"}";exit;}
	if($_SESSION[roleid]!=1){if($_SESSION[userid]!=$row[levelid]){echo "{\"statusCode\":\"300\",\"message\":\"你不能修改别人的报告!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}"; exit;}}//除管理员，，其他人不能越权审核
	//插入审核
	if(isset($_POST['audit'])){
	$Description="<br/>---------------<br/><b style=\"color:#f00\">领导批注：</b>{$_POST[Description]}--[审核人-{$_SESSION[username]}]";
	$sql="UPDATE `cs_jqcalendar` SET  `score1`='$_POST[gzzl]',`score2`='$_POST[gzsl]',`state`=1,`Description`=concat(Description,'$Description') where `cs_jqcalendar`.`Id` ='$_POST[Id]' LIMIT 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"成功审核!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=doc&do=work\"}";}
	exit;
	}
	
	
	$title2 = explode("@@@",$row[title]);

	$s_num=count($title2)-1;
		for($i=0;$i<$s_num;$i++){
			$title3= explode("@#",$title2[$i]);
			$row[tt].="<li><span class=xh>{$title3[0]}</span><span class=bt>{$title3[1]}</span><span class=jd >进度：{$title3[2]}%</span></li>";
		}

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$row[salesid_txt]=$user_list[$row[upsalesid]];
	$row[levelid_txt]=$user_list[$row[levelid]];
	
	//汇报类型
	$row[style_txt] = strtr($row[style],$workstyle);
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('salesid_cn',select($salesid,"salesid",$row[levelid],"汇报对象选择","required"));
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('title',"报告审核");
	$smt->display('doc/work_audit.htm');
	exit;
}
//明细	
if($do=="work_show"){
	If_rabc($action,$do); //检测权限
	//查询
	$sql="SELECT * FROM `cs_jqcalendar` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($_SESSION[roleid]!=1){if($_SESSION[userid]==$row[upsalesid]||$_SESSION[userid]==$row[levelid]){}else{echo "{\"statusCode\":\"300\",\"message\":\"你不能查看此报告内容!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}"; exit;}}
	$title2 = explode("@@@",$row[title]);
	
	$s_num=count($title2)-1;
		for($i=0;$i<$s_num;$i++){
			$title3= explode("@#",$title2[$i]);
			$row[tt].="<li><span class=xh>{$title3[0]}</span><span class=bt>{$title3[1]}</span><span class=jd >进度：{$title3[2]}%</span></li>";
		}

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$row[salesid_txt]=$user_list[$row[upsalesid]];
	$row[levelid_txt]=$user_list[$row[levelid]];
	
	//汇报类型
	$row[style_txt] = strtr($row[style],$workstyle);
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('salesid_cn',select($salesid,"salesid",$row[levelid],"汇报对象选择","required"));
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('title',"报告详细");
	$smt->display('doc/work_show.htm');
	exit;
}
//工作报告删除
if($do=="work_del"){
	If_rabc($action,$do); //检测权限
	$sql="SELECT state,upsalesid FROM `cs_jqcalendar` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($_SESSION[roleid]!=1){if($_SESSION[userid]!=$row[upsalesid]){echo "{\"statusCode\":\"300\",\"message\":\"你不能删除别人的报告!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}"; exit;}}
	if($row[state]==1){echo "{\"statusCode\":\"300\",\"message\":\"报告已经审核，不能删除了!\",\"navTabId\":\"work\",\"callbackType\":\"closeCurrent\"}"; exit;}
	$sql="delete from `cs_jqcalendar` where `cs_jqcalendar`.`id`=$id limit 1";
	if($db->query($sql)){
		echo "{\"statusCode\":\"200\",\"message\":\"报告删除成功！\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc&do=work\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=doc&do=work\"}";}		
	exit;
}
?>