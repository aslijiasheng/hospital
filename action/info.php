<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
//make_semiangle全半角转化
include(CORE."include/cfg.php");		  //配置类
include(CORE."include/cfgqt.php");		  //配置类2
onlylogin();   //用户登入唯一判断
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	$mb="info/info_list.htm";
	//数据导出
	 if($date=='dc'){
	set_time_limit(0);
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;filename=mtp_info.xls");
	header('Cache-Control: max-age=0');
	$mb='info/info_date.htm';
	 }
	//判断检索值
	$b=explode("#",$_POST[nt]);
	$b2=trim($_POST[nt]);
	if($_POST['nt']){$search .= " and (id='$b[1]' || name like '%$b2%' || tel like '%$b2%' || word like '%$b2%' )";}	
	if($_POST['visitnum']){$search .= " && visitnum $_POST[visitnum] 1";}
	if($_POST['productid']){$search .= " && productid  like '%$_POST[productid]%'";}
	if($yyat){$search .= " && yy_at = '$yyat'";}//快捷信息传值
	if($_POST['yy_at']){$search .= " && yy_at = '$_POST[yy_at]'";}
	if($_POST['salesid']){$search .= " && salesid = '$_POST[salesid]'";}
	if($_POST['typeid']){$search .= " && typeid = '$_POST[typeid]'";}
	if($_POST['sx_id']){$search .= " && parentid = '$_POST[sx_id]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && `created_at` >=  '$_POST[time_start] 00:00:00' &&  `created_at` <=  '$_POST[time_over] 23:59:59'";
	}
	if($_POST['zxxm']){$search .= " && zxxm like '%$_POST[zxxm]%'";}
	if($_POST['intro']){$search .= " && intro like '%$_POST[intro]%'";}
	if($_POST['doctorid']){$search .= " && doctorid like '%$_POST[doctorid]%'";}
	if($_POST['qq']){$search .= " && qq = '$_POST[qq]'";}
	if($_POST['card']){$search .= " && card = trim('$_POST[card]')";}
	
	$yhz=explode(",",$config['infosee']);//变成数组
	if($list=="public"){$mb="info/info_public.htm";$search .= " && salesid =99";$yhz="";}//公共用户
	//判断用户级别显示
	if(in_array($_SESSION[roleid],$yhz)&&empty($_POST['nt'])){$search .= " and salesid = '$_SESSION[userid]'";} //判断查看和搜索显示
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT id FROM `cs_info` where 1=1 $search ");//当前频道条数
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
	
	$sql="SELECT * FROM `cs_info` where 1=1 $search order by id desc  LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//查询右栏初始化
	$sql2="SELECT id,name,intro,tel,yy_at FROM `cs_info` where 1=1 $search order by id desc  LIMIT 1";
	$db->query($sql2);
	$row2=$db->fetchRow();
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
		if($list[$key][visitnum]>=1){$list[$key][visitnum_pic]='<span class="ito"></span>';}else{{$list[$key][visitnum_pic]='<span class="nto"></span>';}}
		$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	    $replacement = "\$1&#9742;\$3";
		$list[$key][dh_txt] = preg_replace($pattern, $replacement, $list[$key][tel]);
		$time=explode(" ",$list[$key][created_at]);//时间显示
		if($config['infotime']==1){$list[$key][created]=$time[0];}elseif($config['infotime']==0){$list[$key][created]=$list[$key][created_at];}
		$list_productid = explode(",",$list[$key][productid]);
		foreach($list_productid as $k=>$v){
			$list[$key][productid_txt] .= $productid[$v].",";
		}
		$list_doctorid = explode(",",$list[$key][doctorid]);
		foreach($list_doctorid as $k=>$v){
			$list[$key][doctorid_txt] .= $doctorid[$v].",";
		}
		//会员头像显示
		if($list[$key][levelid]!=0){$list[$key][vip]="ico1";}
	}
	 

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row2',$row2);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('productid_cn',select($productid,"productid","","科室预约"));
	$smt->assign('doctorid_cn',select($doctorid,"doctorid","","预约医生"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('typeid',$_POST[typeid]); //来源渠道
	$smt->assign('productid',$_POST[productid]); //科室预约
	$smt->assign('doctorid',$_POST[doctorid]); //预约医生
	$smt->assign('salesid',$_POST[salesid]); //登记人
	$smt->assign('salesid2',$_POST[salesid2]); //登记人
	$smt->assign('visitnum',$_POST[visitnum]); //来院记录
	$smt->assign('time_start',$_POST[time_start]); //开始时间
	$smt->assign('time_over',$_POST[time_over]); //结束时间
	$smt->assign('nt',$_POST[nt]);
	$smt->assign('zxxm',$_POST[zxxm]); //整形项目
	$smt->assign('sx_id',$_POST[sx_id]); //上线
	$smt->assign('total',$total);
	$smt->assign('yyat',$yyat);
	$smt->assign('title',"客户列表");
	$smt->display($mb);
	
	exit;
	
}
//高级搜索	
if($do=="search"){	
	//If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询

	//模版
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约类型",""));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择",""));
	$smt->assign('parentid_cn',select($parentid,"parentid","","上级选择",""));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择",""));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人",""));
	$smt->assign('product_cn',select($productid,"productid","","预约科室",""));
	$smt->assign('doctor_cn',select($doctorid,"doctorid","","预约医生",""));
	$smt->assign('title',"高级查找");

	$smt->display('info/info_search.htm');
	exit;
}
//新建	
if($do=="new"){	
	If_rabc($action,$do); //检测权限
	echo $_SESSION['activetime'];
	if(isset($_POST['name'])){
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//查询是否已登记
	$sql="SELECT id,name,tel,salesid FROM `cs_info` where tel='$_POST[k]' && tel!='' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$row[salesid_txt] = $user_list[$row[salesid]];
	if($row[id]!=''){echo "{\"statusCode\":\"300\",\"message\":\"已存在数据:ID#{$row[id]}#{$row[name]}#{$row[tel]}登记人#{$row[salesid_txt]}#请直接修改，勿重复添加!\"}";exit;}
	//数据添加开始
	 include(CORE."include/pinyin.php");		  //拼音
	$py=iconv("utf-8","gbk",$_POST[name]);
	$word=$PingYing->getFirstPY($py)." ".$PingYing->getAllPY($py);
	$salesid=$_SESSION[userid];
	$post_productid = implode(",",$_POST[productid]);
	$post_doctorid = implode(",",$_POST[doctorid]);
	$created_at=date("Y-m-d H:i:s", time());
	$tel=trim(make_semiangle($_POST[k]));
	$sql="INSERT INTO `cs_info` (`name` ,`xb`,`nl`,`address`,`qq` ,`tel`,`mail`,`card`,`clerk`,`areaid`,`salesid`,`typeid`,`productid`,`doctorid`,`zxxm`,`parentid`,`intro`,`yy_at`,`keyword`,`word`,`created_at` )
	VALUES ('$_POST[name]','$_POST[xb]','$_POST[nl]', '$_POST[address]','$_POST[qq]','$tel','$_POST[mail]','$_POST[card]','$_POST[clerk]','$_POST[areaid]','$salesid','$_POST[typeid]','$post_productid','$post_doctorid','$_POST[zxxm]','$_POST[sx_id]','$_POST[intro]','$_POST[yy_at]','$_POST[keyword]','$word','$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"info\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=info\"}";}
	exit;

	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约类型","required"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择",""));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择",""));
	$smt->assign('sex_cn',radio($infosex,"xb","女"));
	$smt->assign('product_cn',checkbox($productid));
	$smt->assign('doctor_cn',checkbox2($doctorid));
	$smt->assign('doctorid_cn',select($doctorid,"doctorid[]","","预约医生"));//单选
	$smt->assign('productid_cn',select($productid,"productid[]","","预约科室"));//单选
	$smt->assign('title',"预约登记");

	$smt->display('info/info_new.htm');
	exit;
}

//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['name'])){
	$updated_at=date("Y-m-d H:i:s", time());
	$post_productid = implode(",",$_POST[productid]);
	$post_doctorid = implode(",",$_POST[doctorid]);
	//$time2=date("Y-m-d H:i:s",strtotime("-2 day"));//时间往后2天
	$time=$_POST[created_at];
	if($_SESSION[roleid]!="1"&&$_SESSION[userid]!=$_POST[salesid]){echo "{\"statusCode\":\"300\",\"message\":\"你没有权限修改别人登记的客户信息!\"}";exit;}
	//elseif($_SESSION[roleid]!="1"&&$time<$time2){echo "{\"statusCode\":\"300\",\"message\":\"超过3天的信息，请联系管理员修改!\"}";exit;}
	//每天操作次数限制
	o_limit(1,$config['limit_info_edit']);
	include(CORE."include/pinyin.php");		  //拼音
	$py=iconv("utf-8","gbk",$_POST[name]);
	$word=$PingYing->getFirstPY($py)." ".$PingYing->getAllPY($py);
	$tel=make_semiangle($_POST[tel]);
	//sql
	$sql="UPDATE `cs_info` SET `name` = '$_POST[name]',`xb` = '$_POST[xb]',`nl` = '$_POST[nl]',`areaid` = '$_POST[areaid]',`typeid` = '$_POST[typeid]',`salesid` = '$_POST[salesid]',`productid` = '$post_productid',`zxxm` = '$_POST[zxxm]',`parentid` = '$_POST[sx_id]',`doctorid` = '$post_doctorid',`address` = '$_POST[address]',`tel` = '$tel',`mail` = '$_POST[mail]',`Identity` = '$_POST[Identity]',`card` = '$_POST[card]',`qq` = '$_POST[qq]',`clerk` = '$_POST[clerk]',`intro` = '$_POST[intro]',`yy_at` = '$_POST[yy_at]',`keyword` = '$_POST[keyword]',`updated_at` = '$updated_at',`word` = '$word' WHERE `cs_info`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"infoedit\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}	
	//写入客户日志
	$lognr="用户[".$_SESSION[username]."]修改了该客户信息";
	infolog($_POST[id],$lognr,1);
	exit;
	}
	$mb='info/info_edit.htm';
	if($_SESSION[roleid]=="1"){$mb='info/info_edit_admin.htm';}
	//查询
	$sql2="SELECT * FROM `cs_info` ";
	$db->query($sql2);
	$sql="SELECT * FROM `cs_info` where id='$id'  LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//会员级别查询
	//$sql="SELECT id,name FROM `cs_info` where levelid in (3)";
	$sql="SELECT id,name FROM `cs_info` where levelid>0";
	$db->query($sql);
	$list=$db->fetchAll();	
	foreach($list as $key=>$val){
		$parentid[$val[id]]=$val[name];	
	}
	$row[sxname]=$parentid[$row[parentid]];
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('typeid_cn',select($typeid,"typeid",$row[typeid],"类型选择","required"));
	$smt->assign('areaid_cn',select($areaid,"areaid",$row[areaid],"地区选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid",$row[salesid],"登记人选择","required"));
	$smt->assign('levelid_cn',select($levelid,"levelid",$row[levelid],"级别选择","required"));
	$smt->assign('product_cn',checkbox($productid,$row[productid]));
	$smt->assign('doctor_cn',checkbox2($doctorid,$row[doctorid]));
	$smt->assign('doctorid_cn',select($doctorid,"doctorid[]",$row[doctorid],"预约医生"));//单选
	$smt->assign('productid_cn',select($productid,"productid[]",$row[productid],"预约科室"));//单选
	$smt->assign('sex_cn',radio($infosex,"xb",$row[xb]));
	$smt->assign('row',$row);
	$smt->assign('list',$list);
	$smt->assign('title',"编辑");
	
    $smt->display($mb);
	exit;
}

//客户级别	
if($do=="agent"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	if($id1){$idx=explode(",",$id1);//判断多值id传值
    $id=$idx[1];}
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//模版
	$smt->assign('levelid_cn',select($levelid,"levelid",$row[levelid],"设置级别",""));

	$smt->assign('row',$row);
	$smt->assign('title',"客户级别");
	$smt->display('info/info_agent.htm');
	exit;
}
//更新
if($do=="updata2"){
	//dump($_POST);	
	$updated_at=date("Y-m-d H:i:s", time());
	//sql
	$sql="UPDATE `cs_info` SET 
	`levelid` = '$_POST[levelid]',
	`Identity` ='$_POST[Identity]',
	`card` = '$_POST[card]',
	`updated_at` = '$updated_at' WHERE `cs_info`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}	
	exit;
}

//展示	
if($do=="show"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	//地区
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}
	//上级查询
	$sql_info="SELECT id,name FROM `cs_info` where levelid!=''";
	$db->query($sql_info);
	$info_arr=$db->fetchAll();	
	foreach($info_arr as $key=>$val){
		$info_list[$info_arr[$key][id]]=$info_arr[$key][name];	
	}
	
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//会员级别显示
	$row[levelid_txt] = $type_list[$row[levelid]];

	$row[typeid_txt] = $type_list[$row[typeid]];
	$row[areaid_txt] = $type_list[$row[areaid]];
	
	$row[salesid_txt] = $user_list[$row[salesid]];
	if($row[parentid]!=''){$row[parentid_cn]="上线：".$info_list[$row[parentid]];}
	$productid_arr=explode(',',$row[productid]);
	foreach($productid_arr as $key=>$val){
		$row[productid_txt].= $type_list[$val] .", ";
	}
	$doctorid_arr=explode(',',$row[doctorid]);
	foreach($doctorid_arr as $key=>$val){
		$row[doctorid_txt].= $type_list[$val] .", ";
	}

	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"明细");
	$smt->display('info/info_show.htm');
	exit;
}
//查看更多	
if($do=="intro"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"备注");
	$smt->display('info/info_intro.htm');
	exit;
}
//再预约提醒
if($do=="zyy"){
	If_rabc($action,$do); //检测权限
	
	if($_POST[infoid]){
	if($_SESSION[roleid]!="1"&&$_SESSION[userid]!=$_POST[salesid]){echo "{\"statusCode\":\"300\",\"message\":\"你没有权限修改别人登记的客户信息!\"}";exit;}
	$updated_at=date("Y-m-d H:i:s", time());
	$intro="<br/>----------------<br/>".$_SESSION[username]."--更改预约时间为：".$_POST[yy_at]."备注：".$_POST[intro];
	$sql="UPDATE `cs_info` SET 
	`intro` = concat(intro,'$intro'),
	`yy_at` = '$_POST[yy_at]',
	`updated_at` = '$updated_at' WHERE `cs_info`.`id` ='$_POST[infoid]' LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"info\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}	
	//写入客户日志
	$lognr="用户[".$_SESSION[username]."]修改了该客户预约上门时间";
	infolog($_POST[infoid],$lognr,1);
	exit;
	}
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"备注");
	$smt->display('info/info_zyy.htm');
}
//挂号	
if($do=="visit"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['add'])){
	$salesid2=$_SESSION[userid];
	$post_productid = implode(",",$_POST[productid]);
	$post_doctorid = implode(",",$_POST[doctorid]);
	$created_at=date("Y-m-d H:i:s", time());
	
	$sql="INSERT INTO `cs_sell` (`infoid` ,`intro`,`productid` ,`doctorid` ,`item` ,`created_at`,`salesid2`,`fz`)
	VALUES ('$_POST[infoid]', '$_POST[intro]','$post_productid','$post_doctorid','$_POST[item]','$created_at','$salesid2','$_POST[fz]');";
	if($db->query($sql)){
		$sql="UPDATE `cs_info` SET `name` = '$_POST[name]',`visitnum` = visitnum+1 WHERE `cs_info`.`id` ='$_POST[infoid]' LIMIT 1 ;";
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"closeCurrent\",	\"forwardUrl\":\"?action=sell\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=sell\"}";}
	exit;
		}//挂号写入
	$smt = new smarty();smarty_cfg($smt);
	$created_at=date("Y-m-d", time());
	//查询
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	$sql2="SELECT infoid FROM `cs_sell` where infoid='$id' and '$created_at 00:00:00'<= created_at and created_at<='$created_at 23:59:00'< created_at LIMIT 1";

    if($nu=mysql_num_rows(mysql_query($sql2))>=1){$row[ts]="<font style=color:#f00;font-weight:bold;>该客户今天已挂号,确定要再次挂号操作</font>";}
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('typeid_cn',select($typeid,"typeid",$row[typeid],"预约类型",""));
	$smt->assign('diagnosis_cn',radio($diagnosis,"fz"));
	$smt->assign('product_cn',checkbox($productid,$row[productid]));
	$smt->assign('doctor_cn',checkbox2($doctorid,$row[doctorid]));
	$smt->assign('title',"拜访");
	$smt->display('info/info_visit.htm');
	exit;
}


//回访写入
if($do=="visitsadd"){
	If_rabc($action,$do); //检测权限
	$salesid=$_SESSION[userid];
	$post_productid = implode(",",$_POST[productid]);
	$created_at=date("y-m-d", time());
	$sql="INSERT INTO `cs_visits` (`title`,`infoid`,`salesid`,`intro`,`pingjia`,`created_at` )
	VALUES ('$_POST[title]','$_POST[infoid]',$salesid,'$_POST[intro]','$_POST[pingjia]','$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=visits\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=visits\"}";}
	exit;
}
//查询
if($do=="chaxun"){
$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$v=$_POST[value];
	$sql="select tel,name,salesid from `cs_info` WHERE tel LIKE '$v%' or name LIKE '%$v%' limit 5";
	if($nu=mysql_num_rows(mysql_query($sql))<=0)exit('0');
	//用户
	$db->query($sql);
	
echo '<ul>';
while($row=$db->fetchRow()){
		$row[salesid_txt] = $user_list[$row[salesid]];
echo '<li >'.$row[tel].'_'.$row[name].'_'.$row[salesid_txt].'</li>';}
echo '<li class="cls"><a href="javascript:;" onclick="$(this).parent().parent().parent().fadeOut(100)">关闭</a>已存在数据,请勿重复添加</li>';
echo '</ul>';
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
	$sql="SELECT * FROM `cs_info` where id='$id' LIMIT 1";
	if($nu=mysql_num_rows(mysql_query($sql))<=0){echo"系统没有记录该客户的来院信息";}
	else{
	//用户
	$db->query($sql);
echo '<style>.lb{margin:0;padding:0;}.lb li{background:#FFF; text-align:left;line-height:20px;font-size:12px;list-style:none;}span{padding_left:5px;}</style>';
echo '<ul class="lb">';
while($row=$db->fetchRow()){

echo '<li><b>时间：</b>'.$row[created_at].'--<b>姓名: </b>'.$row[name].'--<b>预约项目: </b>'.$row[zxxm].'--<b>备注: </b>'.$row[intro].'----</li>';}}
echo '</ul>';
exit;	
}
//自动查询tags
if($do=="chaxun2"){	
$q = strtolower($_GET["q"]);
if (!$q) return;

$sql = "select id,item from `cs_price` WHERE item LIKE '%$q%' || word like '%$q%' LIMIT 15";
$rsd = mysql_query($sql);
while($rs = mysql_fetch_array($rsd)) {
 $item = $rs['item'];
 echo "$item\n";
}
exit;	
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	//查询
	$sql2="SELECT id,name,salesid,visitnum FROM `cs_info` where id = '$id' LIMIT 1";
	$db->query($sql2);
	$row=$db->fetchRow();
	
	//权限判断
	if($row[salesid]!=$_SESSION[userid]&&$_SESSION[roleid]!=1){
	echo "{\"statusCode\":\"300\",\"message\":\"操作错误!,你不能操作别人的客户\"}";exit;}
	if($row[visitnum]>=1){
	echo "{\"statusCode\":\"300\",\"message\":\"挂号过的客人不能删除\"}";exit;}
	//每天操作次数限制
	o_limit(2,$config['limit_info_del']);

	$sql="delete from `cs_info` where `cs_info`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	$lognr="删除了客户[{$row[name]}],该客户id[{$row[id]}]";
	infolog($id,$lognr,2);
	exit;
}
//查找带回上线人员列表	
if($do=="listsx"){
	$b=explode("#",$_POST[nt]);
	$b2=trim($_POST[nt]);
	if($_POST['nt']){$search .= " and (id='$b[1]' || name like '%$b2%' || tel like '%$b2%' || card='$b2')";}	
	if($_POST['levelid']){$search .= "and levelid = '$_POST[levelid]'";}
	if($_POST['address']){$search .= "and address like '%$_POST[address]%'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_info` where levelid >0 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询1
	$sql="SELECT * FROM `cs_info` where levelid >0 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('levelid_cn',select($levelid,"levelid",$row[levelid],"上线级别",""));
	$smt->assign('levelid',$_POST[levelid]); //级别分页
	$smt->assign('title',"上线列表");
	$smt->display('info/info_list_sx.htm');
	exit;
	
}
//客户放弃
if($do=="giveup"){
	If_rabc($action,$do); //检测权限
	//查询
	$sql="SELECT id,name,salesid FROM `cs_info` where id = '$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$row[salesid_txt]=$salesid[$row[salesid]];
	if($row[salesid]=='99'){echo "{\"statusCode\":\"300\",\"message\":\"公共组客户不能被放弃\"}";exit;}
	$updated_at=date("Y-m-d H:i:s", time());
	if($_POST[add]){
	if($_POST[salesid]!=$_SESSION[userid]&&$_SESSION[roleid]!=1){
	echo "{\"statusCode\":\"300\",\"message\":\"操作错误!,你不能操作别人的客户\"}";exit;}
	$salesid=$_SESSION[userid];
	$intro="操作人[{$_SESSION[username]}]，将原[{$_POST[salesid_txt]}]客户，设为公共客户 <b>理由：</b>{$_POST[intro]}";
	//写入日志
	infolog($infoid,$intro,3);
	$sql="UPDATE `cs_info` SET 
	`salesid` = 99,`updated_at` = '$updated_at' WHERE `cs_info`.`id` ='$_POST[infoid]'  LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"放弃操作成功!\",\"callbackType\":\"closeCurrent\"}";}
	exit;
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('salesid_cn',select($salesid,"salesid","","接手人选择",""));
	$smt->assign('row',$row);
	$smt->assign('title',"客户放弃");
    $smt->display('info/info_giveup.htm');
	exit;
}
//批量客户放弃
if($do=="allgiveup"){
	// If_rabc($action,$do); //检测权限
    $ids = $_POST['ids'];
    $idArrs = explode(',', $ids);
    foreach($idArrs as $key => $idArr){
        //查询
        $sql="SELECT id,name,salesid FROM `cs_info` where id = '$idArr' LIMIT 1";
        $db->query($sql);
        $row=$db->fetchRow();
        $row[salesid_txt]=$salesid[$row[salesid]];
        if($row[salesid]=='99'){echo "{\"statusCode\":\"300\",\"message\":\"公共组客户不能被放弃\"}";exit;}
    }
	$updated_at=date("Y-m-d H:i:s", time());
	if($_POST[salesid]!=$_SESSION[userid]&&$_SESSION[roleid]!=1){
	echo "{\"statusCode\":\"300\",\"message\":\"操作错误!,你不能操作别人的客户\"}";exit;}
	$salesid=$_SESSION[userid];
	$intro="操作人[{$_SESSION[username]}]，将原[{$_POST[salesid_txt]}]客户，设为公共客户 <b>理由：</b>{$_POST[intro]}";
	//写入日志
	infolog($infoid,$intro,3);
	$sql="UPDATE `cs_info` SET 
	`salesid` = 99,`updated_at` = '$updated_at' WHERE `cs_info`.`id` in ($ids);";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"放弃操作成功!\",\"callbackType\":\"closeCurrent\"}";}
	exit;
}
//客户领取
if($do=="receive"){
	If_rabc($action,$do); //检测权限
	$salesid=$_SESSION[userid];
	$updated_at=date("Y-m-d H:i:s", time());
	$intro="[{$_SESSION[username]}]领取了该客户，要好好维护";
	//写入日志
	infolog($id,$intro);
	//查询
	$sql2="SELECT id,salesid FROM `cs_info` where id = '$id' LIMIT 1";
	$db->query($sql2);
	$row=$db->fetchRow();
	//防止其他用户客户被领取
	if($row[salesid]!='99'){echo "{\"statusCode\":\"300\",\"message\":\"不是公共组客户不能领取!\"}";exit;}
	$sql="UPDATE `cs_info` SET 
	`salesid` = '$salesid',
	`updated_at` ='$updated_at'
	 WHERE `cs_info`.`id` ='$id' LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"领取成功，要好好维护哦!\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}	
	exit;
}
//数据导出
if($do=="date"){
	If_rabc($action,$do); //检测权限
	set_time_limit(0);
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;filename=mtp_info.xls");
	header('Cache-Control: max-age=0');
	$yhz=explode(",",$config['infosee']);//变成数组
	//判断用户级别显示
	if(in_array($_SESSION[roleid],$yhz)){$search .= " and salesid = '$_SESSION[userid]'";} //判断查看和搜索显示
	$sql="SELECT * FROM `cs_info` where 1=1 $search order by id desc limit 500";
	$db->query($sql);
	$list=$db->fetchAll();

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
	//格式化输出数据
	foreach($list as $key=>$val){
		$list[$key][typeid_txt] = $type_list[$list[$key][typeid]];
		$list[$key][areaid_txt] = $type_list[$list[$key][areaid]];
		$list[$key][levelid_txt] = $type_list[$list[$key][levelid]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	    $replacement = "\$1&#9742;\$3";
		$list[$key][dh_txt] = preg_replace($pattern, $replacement, $list[$key][tel]);
		$list_productid = explode(",",$list[$key][productid]);
		foreach($list_productid as $k=>$v){
			$list[$key][productid_txt] .= $productid[$v].",";
		}
		$list_doctorid = explode(",",$list[$key][doctorid]);
		foreach($list_doctorid as $k=>$v){
			$list[$key][doctorid_txt] .= $doctorid[$v].",";
		}
	}
	$smt = new smarty();
	$smt->assign('list',$list);
	$smt->display('info/info_date.htm');
	exit;
}
//用户log列表
if($do=="log"){
	If_rabc($action,$do); //检测权限
	$mb='info/info_log_list.htm';
	if($id){$search .=" && infoid = '$id'";$mb='info/info_log.htm';}else{$tj="";}
	if($_POST['infoid']){$search .= " && infoid = trim('$_POST[infoid]')";}
	if($_POST['salesid']){$search .= " && salesid = '$_POST[salesid]'";}
	if($_POST['intro']){$search .= " && intro like '%$_POST[intro]%'";}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT id FROM `cs_log` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	//查询
	$sql="SELECT * FROM `cs_log` where 1=1 $search order by id desc  LIMIT $pageNum,$numPerPage";
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
		$list[$key][salesid_txt]=$user_list[$list[$key][salesid]];
	}
	$row[id]=$id; 

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('salesid_cn',select($salesid,"salesid","","操作人"));
	$smt->assign('infoid',$infoid);
	$smt->assign('intro',$intro);
	$smt->assign('salesid',$_POST[salesid]); //操作人
	$smt->assign('title',"客户列表");
	$smt->display($mb);
	exit;	
}
?>
