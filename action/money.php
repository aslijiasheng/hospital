<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类

//列表	
if($do==""){
	If_rabc($action,$do); //检测权限	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['tel']){$search .= " and tel like '%$_POST[tel]%'";}
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && s.created_at >=  '$_POST[time_start]' &&  s.created_at <=  '$_POST[time_over]'";
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
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.typeid,i.xb,i.money,s.id,s.salesid3,s.infoid,s.sellid,s.money_dj,s.money_ss,s.intro,s.created_at,s.money_qf,s.money_hk,s.yepay,s.money_ad,s.money_tk,s.money_tk2,s.integ,s.zuofei FROM `cs_money` as s,`cs_info` as i where s.infoid = i.id $search order by s.id desc LIMIT $pageNum,$numPerPage";
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
		$list[$key][salesid3_txt] = $user_list[$list[$key][salesid3]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$list_sellproduct = explode(",",$list[$key][sellproduct]);
		$list_sellvol = explode(",",$list[$key][sellvol]);
		foreach($list_sellproduct as $k=>$v){
			$list[$key][sellproduct_txt] .= $productid[$v]." / ";
			$list[$key][sellvol_txt] .= $list_sellvol[$k]." / ";
		}
		$zuofei1=array('1'=>'f00','0'=>'');
		$list[$key][zuofei_cn] = strtr($list[$key][zuofei],$zuofei1);
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择"));
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
	if($_POST['name']){$search .= " and name like '%$_POST[name]%'";}
	if($_POST['tel']){$search .= " and tel like '%$_POST[tel]%'";}
	if($_POST['fz']){$search .= " and fz='$_POST[fz]'";}
	if($_POST['money_qf']){$search .= " and money_qf >'$_POST[money_qf]'";}
	if($_POST['typeid']){$search .= " && typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " and i.salesid = '$_POST[salesid]'";}
	if($_POST['paidanid']){$search .= " and c.salesid = '$_POST[paidanid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && s.created_at >=  '$_POST[time_start] 00:00:00' &&  s.created_at <=  '$_POST[time_over] 23:59:59'";
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
	$info_num=mysql_query("SELECT * FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search and (s.money_ss>0||s.yepay>0)");//当前频道条数
	if($_POST['paidanid']){
		//$sqlNum = "SELECT sum(s.money_ss) as num FROM `cs_sell` as s,`cs_info` as i, `cs_zhiliao` as c where s.infoid = i.id and c.sellid = s.id  $search";
		$info_num=mysql_query("SELECT * FROM `cs_sell` as s,`cs_info` as i, `cs_zhiliao` as c where s.infoid = i.id and c.sellid = s.id $search and (s.money_ss>0||s.yepay>0)");//当前频道条数
	}
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
	
	//$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.typeid,c.salesid as paidan_person,i.levelid,s.id,s.salesid2,s.infoid,s.productid,s.doctorid,s.intro,s.created_at,s.fz,s.money_qf,s.money_ss,s.yepay,s.money_tk FROM `cs_sell` as s,`cs_info` as i, `cs_zhiliao` as c where s.infoid = i.id and c.sellid = s.id $search and (s.money_ss>0||s.yepay>0||s.money_qf>0||s.money_tk>0) order by s.id desc LIMIT $pageNum,$numPerPage";
    //,m.created_at as create_at_dj,m.money_dj, 
	$sql="SELECT i.name,i.xb,i.nl,i.tel,i.zxxm,i.salesid,i.typeid,c.salesid as paidan_person,i.levelid,s.id,s.salesid2,s.infoid,s.productid,m.created_at as create_at_dj,m.money_dj,s.doctorid,s.intro,s.created_at,s.fz,s.money_qf,s.money_ss,s.yepay,s.money_tk from  `cs_sell` AS s inner join `cs_info` AS i on s.infoid = i.id inner join `cs_money` AS m on m.sellid = s.id left join `cs_zhiliao` AS c on c.sellid = s.id where 1=1 $search and (s.money_ss>0||s.yepay>0||s.money_qf>0||s.money_tk>0) group by s.id order by s.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();

    $djsql="SELECT i.id from  `cs_sell` AS s inner join `cs_info` AS i on s.infoid = i.id inner join `cs_money` AS m on m.sellid = s.id left join `cs_zhiliao` AS c on c.sellid = s.id where 1=1 $search and (s.money_ss>0||s.yepay>0||s.money_qf>0||s.money_tk>0) and m.money_dj != 0 order by s.id desc ";
	$db->query($djsql);
	$djlist=$db->fetchAll();
    $money_dj_arr = array();
    $money_dj_arr = array();
    foreach($djlist as $key => $value){
        $money_dj_arr[] = $value['id'];
    }

	//合计
	$sql2="SELECT (SELECT sum(s.money_ss) FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search) as num,(SELECT sum(s.money_tk) FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search) as num3,(SELECT sum(s.money_qf) FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search) as num2,sellid FROM `cs_zhiliao` as c";
	//print_r($sql2) ;//exit;
	$sqlNum = "SELECT sum(s.money_ss) as num FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id  $search";
	$sql3Num = "SELECT sum(s.money_tk) as num3 FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id   $search";
	$sql2Num = "SELECT sum(s.money_qf) as num2 FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id 	$search";
	if($_POST['paidanid']){
		$sqlNum = "SELECT sum(s.money_ss) as num FROM `cs_sell` as s,`cs_info` as i, `cs_zhiliao` as c where s.infoid = i.id and c.sellid = s.id  $search";
		$sql3Num = "SELECT sum(s.money_tk) as num3 FROM `cs_sell` as s,`cs_info` as i, `cs_zhiliao` as c where s.infoid = i.id and c.sellid = s.id   $search";
		$sql2Num = "SELECT sum(s.money_qf) as num2 FROM `cs_sell` as s,`cs_info` as i, `cs_zhiliao` as c where s.infoid = i.id and c.sellid = s.id 	$search";
	}
	
	//print_r($sqlNum) ;//exit;
	//print_r($sql2Num) ;//exit;
	//print_r($sql3Num) ;//exit;
	//$db->query($sql2);
	//$list2=$db->fetchRow();
	
	$db->query($sqlNum);
	$listNum=$db->fetchRow();
	$db->query($sql3Num);
	$list3Num=$db->fetchRow();
	$db->query($sql2Num);
	$list2Num=$db->fetchRow();
	$list2[num] = $listNum[num];
	$list2[num3] = $list3Num[num3];
	$list2[num2] = $list2Num[num2];
	
	//echo $sql;
	$list2[num_t]=$list2[num]-$list2[num3];
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
		$list[$key][paidan_txt] = $user_list[$list[$key][paidan_person]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$fz1=array('1'=>'初诊','2'=>'复诊','0'=>'不详');
		$list[$key][fz_cn] = strtr($list[$key][fz],$fz1);
		//隐藏电话
		$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	    $replacement = "\$1&#9742;\$3";
		$list[$key][dh_txt] = preg_replace($pattern, $replacement, $list[$key][tel]);
		$list_sellproduct = explode(",",$list[$key][sellproduct]);
		$list_sellvol = explode(",",$list[$key][sellvol]);
		//会员头像显示
		if($list[$key][levelid]!=0){$list[$key][vip]="ico1";}
		foreach($list_sellproduct as $k=>$v){
			$list[$key][sellproduct_txt] .= $productid[$v]." / ";
			$list[$key][sellvol_txt] .= $list_sellvol[$k]." / ";
		}
	}

    //销售
    $sql_salesid=" SELECT id,username FROM `cs_user` where roleid = 12  order by id asc ";
    $db->query($sql_salesid);
    $paidanid_arr=$db->fetchAll();
    foreach($paidanid_arr as $key=>$val){
        $paidanids[$paidanid_arr[$key][id]]=$paidanid_arr[$key][username];	
    }
    $roleID = $_SESSION['roleid'];
    $sql_role=" SELECT action FROM `cs_role` where id = $roleID  order by id asc ";
    $db->query($sql_role);
    $role_attr=$db->fetchAll();
    $role_attr = $role_attr[0];
    $role_action_attr = explode(',', $role_attr['action']);
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('list2',$list2);
	$smt->assign('role_action',$role_action_attr);
	$smt->assign('money_dj_arr',$money_dj_arr);
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));
	$smt->assign('paidan_cn',select($paidanids,"paidanid","","派单人"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('typeid',$_POST[typeid]); //来源渠道
	$smt->assign('salesid',$_POST[salesid]); //登记人
	$smt->assign('time_start',$_POST[time_start]); //开始时间
	$smt->assign('time_over',$_POST[time_over]); //结束时间
	$smt->assign('fz',$_POST[fz]); //初复诊
	$smt->assign('total',$total);
	$smt->assign('title',"客户消费详细");
	$smt->display('money_list2.htm');
	exit;
	
}


//本次消费		
if($do=="pay"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	if($id2){$idx=explode(",",$id2);//判断多值id传值
	$id=$idx[2];}
	//查询
	$sql="SELECT i.name,i.money,i.moneyqf,s.id,s.salesid2,s.infoid,s.productid,s.money_ss,s.money_tk,s.money_qf,s.intro FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.id='$id' LIMIT 1";

	$db->query($sql);
	$row=$db->fetchRow();

	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"收费");
	$smt->display('money_pay.htm');
	exit;
}
//本次消费写入
if($do=="payadd"){
	If_rabc($action,$do); //检测权限
	$salesid3=$_SESSION[userid];
	$created_at=date("Y-m-d H:i:s", time());
	
	$sql="INSERT INTO `cs_money` (`infoid` ,`sellid` ,`intro`,`yepay`,`money_ss`,`money_dj`,`money_qf`,`money_hk`,`money_tk`,`money_tk2`,`money_ad`,`integ`,`created_at`,`salesid3`)
	VALUES ('$_POST[infoid]','$_POST[sellid]', '$_POST[intro2]','$_POST[yepay]','$_POST[money_ss]','$_POST[money_dj]','$_POST[money_qf]','$_POST[money_hk]','$_POST[money_tk]','$_POST[money_tk2]','$_POST[money_ad]','$_POST[integ]','$created_at','$salesid3');";
	if($db->query($sql)){
		$sql="UPDATE cs_sell inner join cs_info ON cs_sell.infoid = cs_info.id SET 
		`cs_sell`.`money_ss` =cs_sell.money_ss+'$_POST[money_ss]'+'$_POST[money_ad]'+'$_POST[money_dj]'+'$_POST[money_hk]',
		`cs_sell`.`money_qf` =cs_sell.money_qf+'$_POST[money_qf]',
		`cs_sell`.`yepay` =cs_sell.yepay+'$_POST[yepay]',
		`cs_sell`.`money_tk` =cs_sell.money_tk+'$_POST[money_tk]'+'$_POST[money_tk2]',
		`cs_sell`.`integ` =cs_sell.integ+'$_POST[integ]',
		`cs_info`.`money`=cs_info.money+'$_POST[money_ad]'-'$_POST[yepay]'-'$_POST[money_tk2]',
		`cs_info`.`moneyqf`=cs_info.moneyqf+'$_POST[money_qf]'-'$_POST[money_hk]'
		WHERE `cs_sell`.`id` ='$_POST[sellid]' and `cs_info`.`id` ='$_POST[infoid]';";
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=money\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=money\"}";}
	exit;
}

//作废页面
if($do=="zuofei"){
	//查询
	$sql="SELECT * FROM `cs_money` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[zuofei]==1){echo "{\"statusCode\":\"300\",\"message\":\"已作废单子!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=money\"}";}
	else{
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"作废");
	$smt->display('zuofei_ad.htm');}
	exit;
}
//收费作废2
if($do=="zuofeixr"){
	//查询
	$id=$_POST[id];
	$sql="SELECT * FROM `cs_money` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//验证密码
	$pw=md5($_POST[pw]);
	$pw2=$config['financepass'];//读取系统配置
	// if($pw!=$pw2){echo "{\"statusCode\":\"300\",\"message\":\"密码错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=money\"}";}
	if($row[zuofei]==1){echo "{\"statusCode\":\"300\",\"message\":\"单子已作废了!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=money\"}";}
		else{
		$sql2="UPDATE cs_sell inner join cs_info ON cs_sell.infoid = cs_info.id SET 
		`cs_sell`.`money_ss` =cs_sell.money_ss-'$row[money_ss]'-'$row[money_ad]'-'$row[money_dj]'-'$row[money_hk]',
		`cs_sell`.`money_qf` =cs_sell.money_qf-'$row[money_qf]',
		`cs_sell`.`yepay` =cs_sell.yepay-'$row[yepay]',
		`cs_sell`.`money_tk` =cs_sell.money_tk-'$row[money_tk]'-'$row[money_tk2]',
		`cs_sell`.`integ` =cs_sell.integ-'$row[integ]',
		`cs_info`.`money`=cs_info.money-'$row[money_ad]'+'$row[yepay]'+'$row[money_tk2]',
		`cs_info`.`moneyqf`=cs_info.moneyqf-'$row[money_qf]'+'$row[money_hk]'
		WHERE `cs_sell`.`id` =$row[sellid] and `cs_info`.`id` =$row[infoid];";
		$db->query($sql2);
		$sql3="UPDATE `cs_money` SET `zuofei` ='1' WHERE id='$id' LIMIT 1 ;";
		if($db->query($sql3)){
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=money\"}";		
	}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",\"forwardUrl\":\"?action=money\"}";}}
	exit;
}
//查询1
if($do=="chaxun1"){	
	$smt = new smarty();smarty_cfg($smt);
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$sql="SELECT i.name,s.id,s.intro,s.created_at,s.salesid3,s.money_ss,s.money_qf,s.yepay,s.money_dj,s.money_ad,s.money_qf,s.money_hk,s.money_tk,s.money_tk2,s.zuofei FROM `cs_money` as s,`cs_info` as i where s.infoid = i.id and s.infoid='$id' order by s.id desc LIMIT 5";
	if($nu=mysql_num_rows(mysql_query($sql))<=0){echo"系统没有记录该客户本次消费信息";}
	else{$db->query($sql);
	
echo '<style>.lb{margin:0;padding:0;}.lb li{background:#FFF; text-align:left;line-height:20px;font-size:12px;list-style:none;}span{padding_left:5px;}</style>';
echo '<ul class="lb">';

while($row=$db->fetchRow()){$row[salesid_txt] = $user_list[$row[salesid3]];
	$row[m_ss]=$row[money_ss]+$row[money_ad]+$row[money_dj]+$row[money_hk];
	$row[m_qf]=$row[money_qf];
	$row[m_yp]=$row[yepay];
	$row[m_tk]=$row[money_tk]+$row[money_tk2];
if($row[zuofei]==1){$row[zf]="<font style=color:#f00;>本单作废</font>";}else{$row[zf]="";}
echo '<li>'.$row[created_at].'--<b>姓名: </b>'.$row[name].'--<b>收款人: </b>'.$row[salesid_txt].'--<b>实收金额: </b>'.$row[m_ss].'--<b>欠费: </b>'.$row[m_qf].'--<b>账户支付: </b>'.$row[m_yp].'--<b>退款: </b>'.$row[m_tk].'--<b>备注: </b>'.$row[intro].'--'.$row[zf].'--</li>';}}
echo '</ul>';
}

//查询2
if($do=="chaxun2"){	
	$smt = new smarty();smarty_cfg($smt);
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$sql="SELECT i.name,s.id,s.infoid,s.intro,s.created_at,s.salesid3,s.money_ss,s.money_qf,s.yepay,s.money_dj,s.money_ad,s.money_qf,s.money_hk,s.money_tk,s.money_tk2 FROM `cs_money` as s,`cs_info` as i where s.infoid = i.id and s.sellid='$id' order by s.id desc LIMIT 1";
	if($nu=mysql_num_rows(mysql_query($sql))<=0){echo"系统没有记录该客户本次消费信息";}
	else{$db->query($sql);
	
	
echo '<style>.lb{margin:0;padding:0;}.lb li{background:#FFF; text-align:left;line-height:20px;font-size:12px;list-style:none;}span{padding_left:5px;}</style>';
echo '<ul class="lb">';

while($row=$db->fetchRow()){$row[salesid_txt] = $user_list[$row[salesid3]];echo '<li >'.$row[created_at].'--<b>姓名: </b>'.$row[name].'--<b>普通消费: </b>'.$row[money_ss].'--<b>余额消费: </b>'.$row[yepay].'--<b>定金: </b>'.$row[money_dj].'--<b>充值: </b>'.$row[money_ad].'--<b>还款: </b>'.$row[money_hk].'--<b>退款: </b>'.$row[money_tk].'--<b>账户款: </b>'.$row[money_tk2].'--<b>收款人: </b>'.$row[salesid_txt].'--<b>收款详细: </b>'.$row[intro].'</li>';}}
echo '</ul>';
}

?>
