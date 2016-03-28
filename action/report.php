<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类

//区域统计表	
if($do=="t1"){
	If_rabc($action,$do); //检测权限	//查询
	
	//判断检索值
	if($_POST['time_start'] && $_POST['time_over']){
		$search = " and `created_at` > '$_POST[time_start] 00:00:00' and `created_at`<  '$_POST[time_over] 23:59:59' ";
	}	
	
	//sql
	$sql.="SELECT (SELECT count(*) FROM `cs_info` as i where t.id=i.areaid $search ) as num,title 
	FROM `cs_type` as t where type = 'areaid' group by id asc";
	$db->query($sql);
	$list=$db->fetchAll();
	
	//合计
	$sql2.="SELECT count(*) as num FROM `cs_info`";
	$db->query($sql2);
	$list2=$db->fetchRow();
	
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$arr[] = array( 
        $list[$key][title],intval($list[$key][num]));
	}
	$row[data] = json_encode($arr);
	$row[bt] = urldecode("客户所属区域分布表");
	$row[zhi] = urldecode("数值");
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('list',$list);
	$smt->assign('list2',$list2);
	$smt->assign('postdate_start',$_POST[time_start]);
	$smt->assign('postdate_over',$_POST[time_over]);
	$smt->assign('title',"区域统计表");
	$smt->display('report/report_t1.htm');
	exit;
}



//类型统计表	
if($do=="t2"){
	If_rabc($action,$do); //检测权限	//查询
	
	//判断检索值
	if($_POST['time_start'] && $_POST['time_over']){
		$search .= " && i.created_at >=  '$_POST[time_start] 00:00:00' &&  i.created_at <=  '$_POST[time_over] 23:59:59'";
	}
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}
	
	//sql
	$sql="SELECT (SELECT count(*) FROM `cs_info` as i where t.id=i.typeid $search) as num,(SELECT count(distinct(infoid)) FROM `cs_info` as s,`cs_sell` as i where t.id=s.typeid  and i.infoid=s.id $search) as num2,(SELECT count(distinct(infoid)) FROM `cs_info` as s,`cs_sell` as i where t.id=s.typeid  and  i.fz=1 and i.infoid=s.id $search ) as num2_c,(SELECT count(distinct(infoid)) FROM `cs_info` as s,`cs_sell` as i where t.id=s.typeid  and  i.fz=2 and i.infoid=s.id $search) as num2_f,(SELECT count(*) FROM `cs_info` as i where t.id=i.typeid and i.zlnum>=1  $search ) as num3,(SELECT sum(i.money_ss) FROM `cs_sell` as i,`cs_info` as s where i.infoid = s.id and t.id=s.typeid $search) as num4,title 
	FROM `cs_type` as t where type = 'typeid' group by t.id asc";
	$db->query($sql);
	$list=$db->fetchAll();
   //格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		//统计图用
		$bt[] = $list[$key]['title'];
		$sja1[] = intval($list[$key]['num']);
		$sja2[] = intval($list[$key]['num2']);
		$sja3[] = intval($list[$key]['num3']);
		$sja4[] = intval($list[$key]['num2_c']);
		$sja5[] = intval($list[$key]['num2_f']);
		$arr[] = array( 
        $list[$key][title],intval($list[$key][num4]));
	}
	$row[bt2] = json_encode($bt);
	$row[sja1] = json_encode($sja1);
	$row[sja2] = json_encode($sja2);
	$row[sja3] = json_encode($sja3);
	$row[sja4] = json_encode($sja4);
	$row[sja5] = json_encode($sja5);
	$row[data] = json_encode($arr);
	
	$row[bt] = urldecode("渠道来源统计表");
	$row[zhi] = urldecode("数值");//统计图用代码结束

	//合计
	$sql2="SELECT count(*) as num FROM `cs_info` as i where 1=1 $search";
	$db->query($sql2);
	$list2=$db->fetchRow();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('list2',$list2);
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));
	$smt->assign('postdate_start',$_POST[time_start]);
	$smt->assign('postdate_over',$_POST[time_over]);
	$smt->assign('title',"类型统计表");
	$smt->display('report/report_t2.htm');
	exit;
}

//类型统计表 [图]
if($do=="t2t"){
	//判断检索值
	if($_POST['time_start'] && $_POST['time_over']){
		$search = " and i.created_at >= '$_POST[time_start]' and i.created_at <=  '$_POST[time_over]' ";
	}
	if($_POST['salesid']){$search .= " and salesid = '$_POST[salesid]'";}

	$sql="SELECT (SELECT count(*) FROM `cs_info` as i where t.id=i.typeid $search) as num,(SELECT count(*) FROM `cs_info` as i where t.id=i.typeid  and i.visitnum>=1 $search) as num2,(SELECT count(*) FROM `cs_info` as s,`cs_sell` as i where t.id=s.typeid  and  i.fz=1 and i.infoid=s.id $search) as num2_c,(SELECT count(*) FROM `cs_info` as s,`cs_sell` as i where t.id=s.typeid  and  i.fz=2 and i.infoid=s.id $search) as num2_f,(SELECT count(*) FROM `cs_info` as i where t.id=i.typeid and i.zlnum>=1  $search ) as num3,(SELECT sum(i.money_ss) FROM `cs_sell` as i,`cs_info` as s where i.infoid = s.id and t.id=s.typeid $search) as num4,title 
	FROM `cs_type` as t where type = 'typeid' group by id asc";
	$db->query($sql);
	$list=$db->fetchAll();

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$bt[] = $list[$key]['title'];
		$sja1[] = intval($list[$key]['num']);
		$sja2[] = intval($list[$key]['num2']);
		$sja3[] = intval($list[$key]['num3']);
		$sja4[] = intval($list[$key]['num2_c']);
		$sja5[] = intval($list[$key]['num2_f']);
		$arr[] = array( 
        $list[$key][title],intval($list[$key][num4]));
	}
	$row[bt2] = json_encode($bt);
	$row[sja1] = json_encode($sja1);
	$row[sja2] = json_encode($sja2);
	$row[sja3] = json_encode($sja3);
	$row[sja4] = json_encode($sja4);
	$row[sja5] = json_encode($sja5);
	$row[data] = json_encode($arr);
	
	$row[bt] = urldecode("渠道来源统计表");
	$row[zhi] = urldecode("数值");
	 
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));
	$smt->assign('title',"渠道统计表 [图]");
	$smt->display('report/report_t_t2.htm');
	exit;
}

//预约统计表	
if($do=="t5"){
	If_rabc($action,$do); //检测权限	//查询
	
	//判断检索值
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and i.created_at >=  '$_POST[time_start]' AND i.created_at <=  '$_POST[time_over]'";
	}	
	if($_POST['typeid']){$search .= " and typeid = '$_POST[typeid]'";}
	//sql
	$sql.="SELECT (SELECT count(*) FROM `cs_info` as i where t.id=i.salesid $search ) as num,(SELECT count(*) FROM `cs_info` as i where t.id=i.salesid and i.visitnum>=1  $search ) as num2,(SELECT count(*) FROM `cs_info` as i where t.id=i.salesid and i.zlnum>=1  $search ) as num3,(SELECT sum(i.money_ss) FROM `cs_sell` as i,`cs_info` as s where i.infoid = s.id and t.id=s.salesid $search) as num4,username FROM `cs_user` as t group by t.id";
	$db->query($sql);
	$list=$db->fetchAll();
	//合计
	$sql2.="SELECT count(*) as num FROM `cs_info` as i where 1=1 $search";
	$db->query($sql2);
	$list2=$db->fetchRow();
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('list2',$list2);
	$smt->assign('list3',$list3);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('postdate_start',$_POST[time_start]);
	$smt->assign('postdate_over',$_POST[time_over]);
	$smt->assign('title',"区域统计表");
	$smt->display('report/report_t5.htm');
	
	exit;
}
?>