<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类
$idx=explode(",",$id);//多值id选择
$id=$idx[0];
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " and i.name like '%$_POST[name]%'";}
	if($_POST['tel']){$search .= " and i.tel like '%$_POST[tel]%'";}
	if($_POST['salesid']){$search .= " and i.salesid = '$_POST[salesid]'";}
	if($_POST['paidanid']){$search .= " and s.salesid = '$_POST[paidanid]'";}
	if($_POST['state']){$search .= " and s.state = '$_POST[state]'";}
	if($zhiliaoat){$search .= " && zhiliao_at >= '$zhiliaoat 00:00:00' && zhiliao_at <= '$zhiliaoat 23:59:50' ";}//首页快捷信息传值
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and s.created_at >=  '$_POST[time_start]' AND  s.created_at <=  '$_POST[time_over]'";
	}
	
	$yhz=explode(",",$config['zhiliaosee']);//变成数组
	//判断用户级别显示
	if(in_array($_SESSION[roleid],$yhz)&&empty($_POST['name'])){$search .= " and s.salesid = '$_SESSION[userid]'";} //判断查看和搜索显示
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="30";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_zhiliao` as s,`cs_info` as i where s.infoid = i.id $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	
	
	//派单项目显示
	if($_SESSION[roleid]!=1){$sql_pd="SELECT * FROM `cs_zhiliao_pd` where salesid = '$_SESSION[userid]'";}
	else{$sql_pd="SELECT * FROM `cs_zhiliao_pd` ";}
	$db->query($sql_pd);
	$pd_arr=$db->fetchAll();
	foreach($pd_arr as $key=>$val){
		$pdid[$pd_arr[$key][sellid]][]=$pd_arr[$key][title]."共[".$pd_arr[$key][num]."]已治[".$pd_arr[$key][num_z]."]次";	
	}

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询
	$sql="SELECT i.name,i.tel,i.xb,s.id,s.sellid,s.salesid,s.infoid,s.zxxm,s.productid,s.doctorid,s.intro,s.created_at,s.zhiliao_at,s.state  FROM `cs_zhiliao` as s,`cs_info` as i where s.infoid = i.id $search order by s.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	 //合计
	$re=mysql_query("SELECT COUNT(*) FROM `cs_zhiliao` as s where 1=1 $search GROUP BY infoid");
	$row[num]=mysql_num_rows($re);
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
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		//状态
		$state2=array('1'=>'已成交','2'=>'未成交');
		$list[$key][state_txt] = strtr($list[$key][state],$state2);
		if($list[$key][zxxm]!=''){$list[$key][zxxm_txt]="<option >".$list[$key][zxxm]."</option>";}
		$list_productid = explode(",",$list[$key][productid]);
		foreach($list_productid as $k=>$v){
			$list[$key][productid_txt] .= $productid[$v].",";
		}
		$list_doctorid = explode(",",$list[$key][doctorid]);
		foreach($list_doctorid as $k=>$v){
			$list[$key][doctorid_txt] .= $doctorid[$v].",";
		}
		//项目显示
			if($pdid[$list[$key][sellid]]!=''||$list[$key][zxxm]!=''){$list[$key][xs]='style=display:none;';}else{$list[$key][xs2]='style=display:none;';}
			//派单状态判断
			if($list[$key][state]=='2'){$list[$key][xs]='style=display:none;';$list[$key][xs2]='style=display:none;';}
		$list4 = $pdid[$list[$key][sellid]];
		foreach($list4 as $k=>$v){
			$list[$key][pd_txt] .= "<option >".$v."</option>";
		}
	}

    $sql_salesid=" SELECT id,username FROM `cs_user` where roleid = 12  order by id asc ";
    $db->query($sql_salesid);
    $paidanid_arr=$db->fetchAll();
    foreach($paidanid_arr as $key=>$val){
        $paidanids[$paidanid_arr[$key][id]]=$paidanid_arr[$key][username];	
    }
		
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('paidan_cn',select($paidanids,"paidanid","","派单人"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","派单人"));
	//$smt->assign('zlxm_cn',select($pdid,"pdid",$row[sellid],"派单人2"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"治疗列表");
	$smt->display('zhiliao/zhiliao_list.htm');
	exit;
	
}

//派单	
if($do=="single"){
	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.xb,s.id,i.productid,i.doctorid,s.infoid,s.intro,s.created_at FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.id='$id'  LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($id){$row[xs2]="style=display:none;";}//判断有无id传值
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('product_cn',checkbox($productid,$row[productid]));
	$smt->assign('doctor_cn',checkbox2($doctorid,$row[doctorid]));
	$smt->assign('row',$row);
	$smt->assign('title',"派单写入");
	$smt->display('zhiliao/zhiliao_single.htm');
	exit;
}
//写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$salesid=$_SESSION[userid];
	$post_productid = implode(",",$_POST[productid]);
	$post_doctorid = implode(",",$_POST[doctorid]);
	$created_at=date("Y-m-d H:i:s", time());
	if($_POST[state]==1){
	$sql="INSERT INTO `cs_zhiliao` (`infoid`,`sellid`,`salesid`,`zxxm`,`doctorid`,`productid`,`created_at`,`zhiliao_at`,`intro`,`state` )
	VALUES ('$_POST[kh_infoid]','$_POST[kh_sellid]','$salesid','$_POST[zxxm]','$post_doctorid', '$post_productid','$created_at','$_POST[zhiliao_at]','$_POST[intro]','$_POST[state]');";
	if($db->query($sql)){
		//项目写入
		if(isset($_POST[zlxm_title])){
		$s_num=count($_POST[zlxm_title]);
		for($i=0;$i<$s_num;$i++){
			$title=$_POST[zlxm_title][$i];
			$num=$_POST[zlxm_num][$i];
			$sql3="INSERT INTO `cs_zhiliao_pd` (`infoid`,`sellid`,`salesid`,`title`,`num`,`created_at`)
	VALUES ('$_POST[kh_infoid]','$_POST[kh_sellid]','$salesid','$title','$num','$created_at');";
			$db->query($sql3);}}

		$sql2="UPDATE `cs_info` SET `zlnum` = zlnum+1 WHERE `cs_info`.`id` ='$_POST[kf_infoid]' LIMIT 1 ;";
		$db->query($sql2);
		
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"zhiliao\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}}
	//未成交
	else{$sql="INSERT INTO `cs_zhiliao` (`infoid`,`sellid`,`salesid`,`created_at`,`intro`,`state` )
	VALUES ('$_POST[kh_infoid]','$_POST[kh_sellid]','$salesid','$created_at','$_POST[intro]','$_POST[state]');";
	$db->query($sql);
	echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"zhiliao\",\"callbackType\":\"closeCurrent\"}";
	}
	exit;
}
if($do=="xmadd"){
	$salesid=$_SESSION[userid];
	$created_at=date("Y-m-d H:i:s", time());
	if(isset($_POST[zlxm_title])){
	$smt = new smarty();smarty_cfg($smt);
	$s_num=count($_POST[zlxm_title]);
		
		for($i=0;$i<$s_num;$i++){
			$title=$_POST[zlxm_title][$i];
			$num=$_POST[zlxm_num][$i];
			$sql3="INSERT INTO `cs_zhiliao_pd` (`infoid`,`sellid`,`pdid`,`salesid`,`title`,`num`,`created_at`)
	VALUES ('$_POST[infoid]','$_POST[sellid]','$_POST[id]','$salesid','$title','$num','$created_at');";
			$db->query($sql3);}
	echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"zhiliao\",\"callbackType\":\"closeCurrent\"}";
	exit;}
	//查询
	$sql="SELECT infoid,sellid,id FROM `cs_zhiliao`  where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"治疗项目");
	$smt->display('zhiliao/zhiliao_xmadd.htm');
	exit;
}
//展示	
if($do=="show"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT i.name,i.tel,i.xb,s.id,s.salesid,s.infoid,s.productid,s.doctorid,s.zxxm,s.intro,s.created_at FROM `cs_zhiliao` as s,`cs_info` as i where s.infoid = i.id and s.id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
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
	
	$row[typeid_txt] = $type_list[$row[typeid]];
	$row[areaid_txt] = $type_list[$row[areaid]];
	$row[levelid_txt] = $type_list[$row[levelid]];
	$row[salesid_txt] = $user_list[$row[salesid]];
	
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
	$smt->display('zhiliao_show.htm');
	exit;
}
//派单修改	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	
	if(isset($_POST['k'])){
	$post_productid = implode(",",$_POST[productid]);
	$post_doctorid = implode(",",$_POST[doctorid]);
	//sql
	$sql="UPDATE `cs_zhiliao` SET 
	`zhiliao_at` = '$_POST[zhiliao_at]',
	`productid` = '$post_productid',
	`doctorid` = '$post_doctorid',
	`zxxm` = '$_POST[zxxm]',
	`intro` = '$_POST[intro]' WHERE `cs_zhiliao`.`id` ='$_POST[id]' LIMIT 1 ;";
	//派单项目修改
	$s_num=count($_POST[title]);
	for($i=0;$i<$s_num;$i++){
			$title=$_POST[title][$i];
			$num=$_POST[num][$i];
			$zlid=$_POST[zlid][$i];
			$sql3="UPDATE `cs_zhiliao_pd` SET
			`title` = '$title',`num` = '$num' WHERE `cs_zhiliao_pd`.`id` ='$zlid' LIMIT 1 ;";
			$db->query($sql3);}
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"zhiliao\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"closeCurrent\"}";}	
	
	
	$time2=date("Y-m-d H:i:s",strtotime("-2 day"));//时间往后2天
	if($_SESSION[roleid]!="1"&&$_SESSION[userid]!=$row[salesid]){echo "{\"statusCode\":\"300\",\"message\":\"你没有权限修改别人登记的客户信息!\"}";}
	elseif($_SESSION[roleid]!="1"&&$row[created_at]<$time2){echo "{\"statusCode\":\"300\",\"message\":\"超过3天的信息，请联系管理员修改!\"}";}exit;}else{
	//查询
	$sql="SELECT i.name,i.tel,i.xb,s.id,s.salesid,s.productid,s.doctorid,s.infoid,s.intro,s.zxxm,s.created_at,s.zhiliao_at FROM `cs_zhiliao` as s,`cs_info` as i where s.infoid = i.id and s.id='$id'  LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//查询
	$sql_xm="SELECT * from `cs_zhiliao_pd`  where sellid=$idx[2]";
	$db->query($sql_xm);
	$list=$db->fetchAll();
	//信息更新
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('product_cn',checkbox($productid,$row[productid]));
	$smt->assign('doctor_cn',checkbox2($doctorid,$row[doctorid]));
	$smt->assign('row',$row);
	$smt->assign('list',$list);
	$smt->assign('title',"派单编辑");
	$smt->display('zhiliao/zhiliao_edit.htm');
	exit;}
}
//派单修改	
if($do=="xg"){
	

	$post_productid = implode(",",$_POST[productid]);
	$post_doctorid = implode(",",$_POST[doctorid]);
	//sql
	$sql="UPDATE `cs_zhiliao` SET 
	`zhiliao_at` = '$_POST[zhiliao_at]',
	`productid` = '$post_productid',
	`doctorid` = '$post_doctorid',
	`zxxm` = '$_POST[zxxm]',
	`intro` = '$_POST[intro]' WHERE `cs_zhiliao`.`id` ='$_POST[id]' LIMIT 1 ;";
	//派单项目修改
	$s_num=count($_POST[title]);
	for($i=0;$i<$s_num;$i++){
			$title=$_POST[title][$i];
			$num=$_POST[num][$i];
			$zlid=$_POST[zlid][$i];
			$sql3="UPDATE `cs_zhiliao_pd` SET
			`title` = '$title',`num` = '$num' WHERE `cs_zhiliao_pd`.`id` ='$zlid' LIMIT 1 ;";
			$db->query($sql3);}
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"zhiliao\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"closeCurrent\"}";}	
	
	
	$time2=date("Y-m-d H:i:s",strtotime("-2 day"));//时间往后2天
	if($_SESSION[roleid]!="1"&&$_SESSION[userid]!=$row[salesid]){echo "{\"statusCode\":\"300\",\"message\":\"你没有权限修改别人登记的客户信息!\"}";}
	elseif($_SESSION[roleid]!="1"&&$row[created_at]<$time2){echo "{\"statusCode\":\"300\",\"message\":\"超过3天的信息，请联系管理员修改!\"}";}exit;
}
//查询多查询
if($do=="chaxun1"){	
	$smt = new smarty();smarty_cfg($smt);
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//地区
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}
	$sql="SELECT i.name,s.id,s.infoid,s.intro,s.zxxm,s.created_at,s.sellid,s.salesid,s.doctorid FROM `cs_zhiliao` as s,`cs_info` as i where s.infoid = i.id and s.infoid='$id' order by s.id desc LIMIT 5";
	if($nu=mysql_num_rows(mysql_query($sql))<=0){echo"系统没有记录该客户的派单信息";}
	else{$db->query($sql);
	
echo '<style>.lb{margin:0;padding:0;}.lb li{background:#FFF; text-align:left;line-height:20px;font-size:12px;list-style:none;}span{padding_left:5px;}</style>';
echo '<ul class="lb">';

while($row=$db->fetchRow()){$row[salesid_txt] = $user_list[$row[salesid]];
		$row[doctorid_txt] = $type_list[$row[doctorid]];

echo '<li>'.$row[created_at].'--<b>姓名: </b>'.$row[name].'--<b>派单人: </b>'.$row[salesid_txt].'--<b>到诊情况: </b>'.$row[fz_cn].'--<b>治疗项目: </b>'.$row[zxxm].'--<b>治疗医生: </b>'.$row[doctorid_txt].'--<b>备注: </b>'.$row[intro].'----</li>';}}
echo '</ul>';
exit;
}
//查询1查询
if($do=="chaxun2"){	
	$smt = new smarty();smarty_cfg($smt);
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	//地区
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}
	$sql="SELECT i.name,s.id,s.infoid,s.intro,s.zxxm,s.created_at,s.sellid,s.salesid,s.doctorid FROM `cs_zhiliao` as s,`cs_info` as i where s.infoid = i.id and s.sellid='$id' order by s.id desc LIMIT 1";
	if($nu=mysql_num_rows(mysql_query($sql))<=0){echo"系统没有记录本次派单信息";}
	else{$db->query($sql);
	
echo '<style>.lb{margin:0;padding:0;}.lb li{background:#FFF; text-align:left;line-height:20px;font-size:12px;list-style:none;}span{padding_left:5px;}</style>';
echo '<ul class="lb">';

while($row=$db->fetchRow()){$row[salesid_txt] = $user_list[$row[salesid]];
		$row[doctorid_txt] = $type_list[$row[doctorid]];

echo '<li>'.$row[created_at].'--<b>姓名: </b>'.$row[name].'--<b>派单人: </b>'.$row[salesid_txt].'--<b>到诊情况: </b>'.$row[fz_cn].'--<b>治疗项目: </b>'.$row[zxxm].'--<b>治疗医生: </b>'.$row[doctorid_txt].'--<b>备注: </b>'.$row[intro].'----</li>';}}
echo '</ul>';
}

//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="SELECT infoid,sellid FROM `cs_zhiliao` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//执行要删除的	
	$sql="delete from `cs_zhiliao` where `cs_zhiliao`.`id`=$id limit 1";
	$sql2="delete from `cs_zhiliao_pd` where `cs_zhiliao_pd`.`pdid`=$id ";
	if($db->query($sql)&&$db->query($sql2)){$sql3="UPDATE `cs_info` SET `zlnum` = zlnum-1 WHERE `cs_info`.`id`=$row[infoid] LIMIT 1 ;";
		$db->query($sql3);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=zhiliao\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=zhiliao\"}";}		
	exit;
}
//列表	
if($do=="listzl"){	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " and i.name like '%$_POST[name]%'";}
	if($_POST['tel']){$search .= " and i.tel like '%$_POST[tel]%'";}
	if($_POST['salesid']){$search .= " and i.salesid = '$_POST[salesid]'";}
	if($zhiliaoat){$search .= " && zhiliao_at >= '$zhiliaoat 00:00:00' && zhiliao_at <= '$zhiliaoat 23:59:50' ";}//首页快捷信息传值
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and s.created_at >=  '$_POST[time_start]' AND  s.created_at <=  '$_POST[time_over]'";
	}
	
	
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询
	$sql="SELECT * FROM `cs_zhiliao_pd` where infoid='$id'";
	$db->query($sql);
	$list=$db->fetchAll();
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
	$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
	}	
	//模版
	if(count($list)!=""){
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('title',"治疗列表");
	$smt->display('zhiliao/zhiliao_list_zlxm.htm');
	exit;}else{echo "<font style=color:#f00; >系统查无此客人派单信息，请联系相关人员派单，或手动输入</font>";}
	
}
?>
