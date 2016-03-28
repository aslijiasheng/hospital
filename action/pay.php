<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类
//列表2	
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
	$info_num=mysql_query("SELECT * FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.sellvol>0 $search");//当前频道条数
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
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.typeid,i.xb,i.money,s.id,s.salesid2,s.infoid,s.sellproduct,s.sellvol,s.intro,s.created_at,s.fz,s.sellvol FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search order by s.id desc LIMIT $pageNum,$numPerPage";
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
	$smt->assign('title',"客户消费详细");
	$smt->display('pay_list.htm');
	exit;
	
}
?>