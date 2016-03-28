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
	if($_POST['nt']){$search .= " and (i.name like '%$_POST[nt]%' || i.tel like '%$_POST[nt]%') && s.typeid = '$_POST[tid]'";}	
	if($_POST['zd']){$search .= " and (s.zdjg like '%$_POST[zd]%' || s.zlff like '%$_POST[zd]%')";}
	if($tid){$search .= " && s.typeid = '$tid'";}//科室id信息传值
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && s.created_at >=  '$_POST[time_start]' &&  s.created_at <=  '$_POST[time_over]'";
	}
	//判断用户级别显示
	if($_SESSION[roleid]=="3"){$search .= " and salesid = '$_SESSION[userid]'";} //销售
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="30";
	}else{
		$numPerPage=$_POST[numPerPage];
	}
	
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_section` as s where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//科室人员
	$sql_userzx="SELECT id,zxname FROM `cs_user_zx` ";
	$db->query($sql_userzx);
	$userzx_arr=$db->fetchAll();
	foreach ($userzx_arr as $val) {
        $userzx_arr[$val[id]] = $val[zxname];
	}
	//派单项目显示
	$sql_pd="SELECT * FROM `cs_zhiliao_pd` ";
	$db->query($sql_pd);
	$pd_arr=$db->fetchAll();
	foreach($pd_arr as $val){
		$pd_arr[$val[id]] = $val[title];	
	}
	//查询
	$sql="SELECT * FROM `cs_info` as i,`cs_section` as s where s.infoid=i.id  $search order by s.id desc  LIMIT $pageNum,$numPerPage";
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
		$list[$key][salesid_ks_txt] = $user_list[$list[$key][salesid_ks]];
		if($list[$key][zdjg]!=''){$list[$key][zdjg_txt]="<option >".$list[$key][zdjg]."</option>";}
		$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	    $replacement = "\$1&#9742;\$3";
		$list[$key][dh_txt] = preg_replace($pattern, $replacement, $list[$key][tel]);
		$list_doctorid = explode(",",$list[$key][zzys]);
		foreach($list_doctorid as $k=>$v){
			$list[$key][doctorid_txt] .= $doctorid[$v].",";
					
		}
		$list_zxr = explode(",",$list[$key][zxr]);
		foreach($list_zxr as $k=>$v){
			$list[$key][zxr_txt] .= $userzx_arr[$v].",";
		}
		$list_zl = explode(",",$list[$key][zlid]);
		foreach($list_zl as $k=>$v){
			$list[$key][zl_txt] .= "<option >".$pd_arr[$v]."</option>";
		}
	}


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row',$row);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('zd',$_POST[zd]); //诊断
	$smt->assign('time_start',$_POST[time_start]); //开始时间
	$smt->assign('time_over',$_POST[time_over]); //结束时间
	$smt->assign('total',$total);
	$smt->assign('tid',$tid);
	$smt->assign('title',"客户列表");
	$smt->display('section/section_list.htm');
	exit;
	
}
//科室登记	
if($do=="new"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT i.name,i.tel,i.xb,i.nl,s.id,s.infoid,s.doctorid,s.fz,s.created_at FROM `cs_sell` as s,`cs_info` as i where s.id='$id' and s.infoid=i.id LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	if($id){$row[xs2]="style=display:none;";}//判断有无id传值
	//类型，医生
	$fz1=array('1'=>'初诊','2'=>'复诊','0'=>'不详');
	$row[fz_cn] = strtr($row[fz],$fz1);
	

	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"科室登记");
	$smt->assign('product_cn',select($productid,"typeid","$ksid","科室选择","required"));
	$smt->assign('doctor_cn',checkbox2($doctorid,$row[doctorid]));
	$smt->display('section/section_new.htm');
	exit;
}
//科室写入
if($do=="add"){
	If_rabc($action,$do); //检测权限
	$salesid_ks=$_SESSION[userid];
	$post_zzys = implode(",",$_POST[doctorid]);
	$zlxm = implode(",",$_POST[zlxm]);
	$created_at=date("Y-m-d H:i:s", time());
	$sql2="UPDATE `cs_info` SET 
	`nl` = '$_POST[kh_nl]' where `cs_info`.`id` ='$_POST[kh_infoid]' LIMIT 1";
	$sql="INSERT INTO `cs_section` (`infoid`,`sellid`,`intro`,`zdjg`,`zlff`,`zlcs`,`zzys`,`zxr`,`created_at`,`salesid_ks`,`typeid`,`zlid`)
	VALUES ('$_POST[kh_infoid]','$_POST[kh_sellid]','$_POST[intro]', '$_POST[zdjg]','$_POST[zlff]','$_POST[zlcs]','$post_zzys','$_POST[zx_orgxh]','$created_at','$salesid_ks','$_POST[typeid]','$zlxm');";
	$s_num=count($_POST[zlxm]);
		
		for($i=0;$i<$s_num;$i++){
			$num_z=$_POST[zlxm][$i];
			$sql3="UPDATE `cs_zhiliao_pd` SET 
			`num_z` = num_z+1 WHERE `cs_zhiliao_pd`.`id` ='$num_z' LIMIT 1 ;";
	$db->query($sql3);
		}
	if($db->query($sql)&&$db->query($sql2)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"section\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}
	exit;
}
//编辑	
if($do=="edit"){
	$smt = new smarty();smarty_cfg($smt);
	
	//查询
	$sql="SELECT i.name,i.tel,i.xb,i.nl,s.id,s.infoid,s.zdjg,s.zlff,s.zlcs,s.zzys,s.zxr,s.typeid,s.zlid FROM `cs_section` as s,`cs_info` as i where s.id='$id' and s.infoid=i.id  LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[xb]=="女"){$row[checked0]='checked';}else{$row[checked1]='checked';}
	$created_at2=date("Y-m-d", time());
	
	//科室人员
	$sql_userzx="SELECT id,zxname FROM `cs_user_zx` ";
	$db->query($sql_userzx);
	$userzx_arr=$db->fetchAll();
	foreach ($userzx_arr as $val) {
        $userzx_arr[$val[id]] = $val[zxname];
		
	}
	//派单项目显示
	if($row[zlid]!=''){$sql_pd="SELECT * FROM `cs_zhiliao_pd` where id in($row[zlid]) order by id asc ";
	$db->query($sql_pd);
	$list=$db->fetchAll();}
	
	//格式化输出数据
		$list_zxr = explode(",",$row[zxr]);
		foreach($list_zxr as $k=>$v){
			$row[zxr_txt] .= $userzx_arr[$v].",";
		}
	//模版
	$smt->assign('product_cn',select($productid,"typeid",$row[typeid],"科室选择","required"));
	$smt->assign('doctor_cn',checkbox2($doctorid,$row[zzys]));
	$smt->assign('row',$row);
	$smt->assign('list',$list);
	$smt->assign('title',"编辑");
	
	if($_SESSION[userid]==$row[salesid]&&$created_at2==$row[created_at]&&$_SESSION[roleid]!="1"){$smt->display('section/section_edit.htm');}
	elseif($_SESSION[roleid]=="1"){$smt->display('section/section_edit.htm');}
	else{$smt->display('cw_qx.htm');}
	exit;
}
//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	//dump($_POST);	
	$post_zxr = implode(",",$_POST[zxr]);
	$post_doctorid = implode(",",$_POST[doctorid]);

	$zid = explode(",",$_POST[zid]);
	$zlid =implode(",",$_POST[zlid]);
	$zlidz = array_diff($zid,$_POST[zlid]);
	//sql
	$sql="UPDATE `cs_section` SET 
	`zdjg` = '$_POST[zdjg]',
	`zlff` = '$_POST[zlff]',
	`zlcs` = '$_POST[zlcs]',
	`zzys` = '$post_doctorid',
	`zxr` = '$_POST[zx_orgxh]',
	`typeid` = '$_POST[typeid]',
	`zlid` ='$zlid',
	`intro` = '$_POST[intro]' WHERE `cs_section`.`id` ='$_POST[id]' LIMIT 1 ;";
	//项目更新
	foreach($zlidz as $key=>$val){
			$sql3="UPDATE `cs_zhiliao_pd` SET
			`num_z` = num_z - 1 WHERE `cs_zhiliao_pd`.`id` ='$val' LIMIT 1 ;";
			$db->query($sql3);		
	}
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"{$z1}操作{$z2}成功{$z3}!\",\"navTabId\":\"section\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	//查询要删除的zhiliao_pd下的ID
	$sql="SELECT zlid FROM `cs_section` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
			if($row[zlid]!=''){$zlxm=explode(",",$row[zlid]);
			$sql3="UPDATE `cs_zhiliao_pd` SET 
			`num_z` = num_z - 1 WHERE `cs_zhiliao_pd`.`id` in($row[zlid]) ;";
			$db->query($sql3);}
			
	$sql="delete from `cs_section` where `cs_section`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}		
	exit;
}

?>