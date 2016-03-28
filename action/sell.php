<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 
include(CORE."include/cfg.php");		  //配置类
include(CORE."include/cfgqt.php");		  //配置类2
$idx=explode(",",$id);//多值id
$id=$idx[0];
if($id1){$idx=explode(",",$id1);//判断多值id传值
$id=$idx[1];}
if($id2){$idx=explode(",",$id2);//判断多值id传值
$id=$idx[2];}
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	//dump($_SESSION);
	//判断检索值
	$b=explode("#",$_POST[nt]);
	$b2=trim($_POST[nt]);
	if($_POST['nt']){$search .= " and (i.id='$b[1]' || name like '%$b2%' || tel like '%$b2%' || card='$b2')";}	
	if($_POST['fz']){$search .= " and fz='$_POST[fz]'";}
	if($_POST['typeid']){$search .= " && typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " and i.salesid = '$_POST[salesid]'";}
	if($_POST['productid']){$search .= " && i.productid = '$_POST[productid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && s.created_at >=  '$_POST[time_start] 00:00:00' &&  s.created_at <=  '$_POST[time_over] 23:59:59'";
	}
	if($ms=='dy'){$mb='sell/sell_list_dy.htm';
		$time=date("Y-m-d H:i:s",strtotime("-30 day"));//时间往后1天
		$search .=" && s.created_at >=  '$time' ";
		}else{$mb='sell/sell_list.htm';}//判断调用OR列表
	
	$yhz=explode(",",$config['sellsee']);//变成数组
	//判断用户级别显示
	if(in_array($_SESSION[roleid],$yhz)&&empty($_POST['nt'])){$search .= " and salesid = '$_SESSION[userid]'";} //判断查看和搜索显示
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search");//当前频道条数
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
	//科室数据
	$sql_zd="SELECT sellid,zlff,zdjg,zlid FROM `cs_section` ";
	$db->query($sql_zd);
	$mr_arr=$db->fetchAll();
	foreach($mr_arr as $key=>$val){
		$mr_list[$mr_arr[$key][sellid]][]=$mr_arr[$key][zlff];
	}
	
			

	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,s.fz_count,i.salesid,i.typeid,i.levelid,i.xb,i.nl, s.id,s.salesid2,s.infoid,s.money_ss,s.intro,s.created_at,s.fz,s.productid,s.doctorid,s.item FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search order by s.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);

	$list=$db->fetchAll();
	//查询
	$sql2="SELECT s.id,s.infoid,s.intro FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search order by id desc  LIMIT 1";
	$db->query($sql2);
	$row2=$db->fetchRow();
	//合计
	$re=mysql_query("SELECT COUNT(infoid) FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id $search GROUP BY s.infoid");
	$re2=mysql_query("SELECT COUNT(infoid) FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.fz=1 $search GROUP BY s.infoid");
	$re3=mysql_query("SELECT COUNT(infoid) FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.fz=2 $search GROUP BY s.infoid");
    $fz_count_sql = "SELECT sum(fz_count) as fz_count FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.fz=2 $search";
	$db->query($fz_count_sql);
	$fz_count_list=$db->fetchAll();
	$fz_count_list=$fz_count_list[0];
	$list2[num]=mysql_num_rows($re);
	$list2[num2]=mysql_num_rows($re2);
	$list2[num3]=mysql_num_rows($re3);
	$list2[num4]=$fz_count_list['fz_count'];
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][typeid_txt] = $type_list[$list[$key][typeid]];
		$list[$key][areaid_txt] = $type_list[$list[$key][areaid]];
		$list[$key][salesid2_txt] = $user_list[$list[$key][salesid2]];
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$pattern = "/(1\d{1,2})\d\d(\d{0,3})/";
	    $replacement = "\$1&#9742;\$3";
		$list[$key][dh_txt] = preg_replace($pattern, $replacement, $list[$key][tel]);
		
		$list[$key][fz_cn] = strtr($list[$key][fz],$diagnosis);
		$time=explode(" ",$list[$key][created_at]);//时间显示
		if($config['infotime']==1){$list[$key][created]=$time[0];}elseif($config['infotime']==0){$list[$key][created]=$list[$key][created_at];}
		if($list[$key][levelid]==3){$list[$key][vip]="ico1";}
		//科室登记项目显示
		$list_ks= $mr_list[$list[$key][id]];
		foreach($list_ks as $k=>$v){
			$list[$key][zlff] .= "<option value=>".$v."</option>";
		}
		$list_productid = explode(",",$list[$key][productid]);
		foreach($list_productid as $k=>$v){
			$list[$key][productid_txt] .= $productid[$v].",";
		}
		$list_doctorid = explode(",",$list[$key][doctorid]);
		foreach($list_doctorid as $k=>$v){
			$list[$key][doctorid_txt] .= $doctorid[$v].",";
		}
	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('row2',$row2);
	$smt->assign('list2',$list2);
	$smt->assign('list3',$list3);
	$smt->assign('typeid_cn',select($typeid,"typeid","","类型选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid2_cn',select($salesid2,"salesid2","","销售选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));
	$smt->assign('productid_cn',select($productid,"productid","","预约科室"));
	$smt->assign('diagnosis_cn',select($diagnosis,"fz","","到院情况"));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('typeid',$_POST[typeid]); //来源渠道
	$smt->assign('salesid',$_POST[salesid]); //登记人
	$smt->assign('time_start',$_POST[time_start]); //开始时间
	$smt->assign('time_over',$_POST[time_over]); //结束时间
	$smt->assign('fz',$_POST[fz]); //初复诊
	$smt->assign('total',$total);
	$smt->assign('title',"列表");
	$smt->display($mb);
	exit;
	
}


//编辑	
if($do=="show"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.xb,i.visitnum,s.id,s.salesid2,s.infoid,s.intro,s.created_at,s.fz,s.tp FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.id='$id' LIMIT 1";
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
	$row[salesid2_txt] = $user_list[$row[salesid2]];
	$list_sellproduct = explode(",",$row[sellproduct]);
		$list_sellvol = explode(",",$row[sellvol]);
		foreach($list_sellproduct as $k=>$v){
			$row[sellproduct_txt] .= $productid[$v]." / ";
			$row[sellvol_txt] .= $list_sellvol[$k]." / ";
	}
	$b=explode("|",$row[tp]);
	$d=COUNT($b);
	for($i=1;$i<$d;$i++){
	if($i%3==1){$c1=$i;
	
	$e1=($b[$c1]);
	

	$row[tp1].="<dd><a href=?action=sell&do=tpyl&wz=".$e1." target=navTab ><img src=chajian/slt/slt.php?src=".$cfg["app"].$e1."&w=120 ></a><i>".$e2."</i></dd>";}
	}
	

	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"明细");
	$smt->display('sell/sell_show.htm');
	exit;
}
//打印挂号信息	
if($do=="print"){
	//If_rabc($action,$do); //检测权限
	//类型
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}
	//查询
	$sql="SELECT i.name,i.tel,i.nl,i.zxxm,i.salesid,i.xb,i.areaid,i.visitnum,i.typeid,i.levelid,s.id,s.salesid2,s.productid,s.infoid,s.intro,s.created_at,s.fz,s.tp,s.item,s.doctorid FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.id='$id'  LIMIT 1";
	$db->query($sql);
	$mt2=$db->fetchRow();
	$mt2[url]=$_SERVER['HTTP_HOST'];
	
	$mt2[age] = $mt2[nl];$mt2[sex] = $mt2[xb];$mt2[time_cn] = $mt2[created_at];
	$mt2[canal] = $type_list[$mt2[typeid]];
	$mt2[vip] = $type_list[$mt2[levelid]];
	$mt2[user] = $salesid[$mt2[salesid]];
	$mt2[user2] = $salesid[$mt2[salesid2]];
	//科室登记项目显示
		$list_productid = explode(",",$mt2[productid]);
		foreach($list_productid as $k=>$v){
			$mt2[department] .= $productid[$v].",";
		}
		$list_doctorid = explode(",",$mt2[doctorid]);
		foreach($list_doctorid as $k=>$v){
			$mt2[doctor] .= $doctorid[$v].",";
		}
	//查询
	$sql3="SELECT id,value2,value FROM `cs_config` where varname='printsell' LIMIT 1";
	$db->query($sql3);
	$mt3=$db->fetchRow();
	//二维码
	include(CORE."chajian/ewm/phpqrcode.php");
	$ewm=array('{mt:id}'=>$mt2[id],'{mt:name}'=>md5($mt2[name]));
	$c = strtr($config['sms_ewm'],$ewm);
	$len = strlen($c);

	   QRcode::png($c, 'chajian/ewm/images/s_'.$mt2[id].'.png');	
	   $sc = urlencode($c);
	   $mt2[ewmsrc] = 'chajian/ewm/images/s_'.$mt2[id].'.png';
	//内容替换
	$content=array('{mt:id}'=>$mt2[id],'{mt:infoid}'=>$mt2[infoid],'{mt:name}'=>$mt2[name],'{mt:tel}'=>$mt2[tel],'{mt:age}'=>$mt2[age],'{mt:sex}'=>$mt2[sex],'{mt:fz}'=>$mt2[fz],'{mt:time_cn}'=>$mt2[time_cn],'{mt:item}'=>$mt2[item],'{mt:user}'=>$mt2[user],'{mt:user2}'=>$mt2[user2],'{mt:canal}'=>$mt2[canal],'{mt:vip}'=>$mt2[vip],'{mt:department}'=>$mt2[department],'{mt:doctor}'=>$mt2[doctor],'{mt:ewm}'=>$mt2[ewmsrc]);//此处勿改
	$mt2[content] = strtr($mt3[value2],$content);
	if($type=='dy'){echo $mt2[content];exit;}//判断
	$print_cs = explode("|",$mt3[value]);
	$mt2[mar_u]=$print_cs[0];$mt2[mar_d]=$print_cs[1];$mt2[mar_l]=$print_cs[2];$mt2[mar_r]=$print_cs[3];
	$mt2[p_u]=$print_cs[4];$mt2[p_d]=$print_cs[5];$mt2[p_m]=$print_cs[6];
	if($mt2[p_m]==""){$mt2[p_m]=0;}
	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('mt2',$mt2);
	$smt->assign('title',"打印预览");
	$smt->display('sell/sell_print_yl.htm');
	exit;
}
//查看更多	
if($do=="intro"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_sell` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();	
	
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"备注");
	$smt->display('sell/sell_intro.htm');
	exit;
}
//编辑	
if($do=="edit"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['updata'])){
		$updated_at=date("Y-m-d H:i:s", time());
	$post_productid = implode(",",$_POST[productid]);
	$post_doctorid = implode(",",$_POST[doctorid]);
    $fz_count = $_POST[fz] == 2 ? 1 : 0;
	//sql
	$sql="UPDATE `cs_sell` SET 
	`intro` = '$_POST[intro]',
	`fz` = '$_POST[fz]',
	`fz_count` = fz_count + '$fz_count',
	`tp` = '$_POST[tp]',
	`item` = '$_POST[item]',
	`productid` = '$post_productid',
	`doctorid` = '$post_doctorid',
	`updated_at` = '$updated_at' WHERE `cs_sell`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"sell\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=sell\"}";}	
	exit;
		}//编辑写入
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.xb,s.id,s.salesid2,s.infoid,s.productid,s.doctorid,s.money_ss,s.intro,s.created_at,s.tp,s.fz,s.item FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.id='$id'  LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
  	$created_at2=date("Y-m-d", time());
	$time=explode(" ",$row[created_at]);
	//查询
	$sql="SELECT id FROM `cs_sell` where id LIMIT 1";
	$db->query($sql);
	$list=$db->fetchAll();	
	foreach($list as $key=>$val){
		$parentid[$val[id]]=$val[name];	
	}
	//模版
	$smt->assign('row',$row);
	$smt->assign('diagnosis_cn',radio($diagnosis,"fz",$row[fz]));
	$smt->assign('product_cn',checkbox($productid,$row[productid]));
	$smt->assign('doctor_cn',checkbox2($doctorid,$row[doctorid]));
	$smt->assign('title',"来访编辑");
	$smt->display('sell/sell_edit.htm');
	exit;
}


//上传图片
if($do=="tpad"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	if($ids){$idx=explode(",",$ids);//判断多值id传值
	$id=$idx[2];}
	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,s.id,s.salesid2,s.infoid,s.intro,s.created_at,s.tp FROM `cs_sell` as s,`cs_info` as i where  s.infoid = i.id and s.id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//查询
	$sql="SELECT id FROM `cs_sell` where id LIMIT 1";
	$db->query($sql);
	$list=$db->fetchAll();	
	foreach($list as $key=>$val){
		$parentid[$val[id]]=$val[name];	
	}
	$b=explode("|",$row[tp]);
	$d=COUNT($b);
	for($i=1;$i<$d;$i++){
	if($i%3==1){$c1=$i;$c2=$i+1;$c3=$i+2;
	
	$e1=$b[$c1];
	$e2="格式".$b[$c2]."大小".$b[$c3];
	$e3="|".$e1."|".$b[$c2]."|".$b[$c3];
	$row[tp1].="<dd ><a href=?action=sell&do=tpyl&wz=".$e1." target=navTab ><img src=chajian/slt/slt.php?src=".$cfg["app"].$e1."&w=120 ></a><a href=?action=sell&do=picdel&id=".$id."&tpnr=".$e3." class=deltp target=ajaxTodo title=确定要删除吗?>X</a><i>".$e2."</i></dd>";}
	}
	if($row[tp]==""){$row[kj]="none";}else{$row[kj]="";}
	//模版
	$smt->assign('typeid_cn',select($typeid,"typeid",$row[typeid],"类型选择","required"));
	$smt->assign('parentid_cn',select($parentid,"parentid",$row[parentid],"上级选择",""));
	$smt->assign('product_cn',checkbox($productid,$row[productid]));
	$smt->assign('row',$row);
	$smt->assign('title',"手术图片");
	$smt->display('pic_new.htm');
	exit;
}
//图片预览
if($do=="tpyl"){
	$smt = new smarty();smarty_cfg($smt);
	$row[wz]=$wz;
	$smt->assign('row',$row);
	$smt->assign('title',"图片预览");
	$smt->display('pic_yl.htm');
	exit;
}
//图片预览对比全
if($do=="picview"){
	$smt = new smarty();smarty_cfg($smt);
	$sql="SELECT tp,created_at FROM `cs_sell` where infoid='$id' LIMIT 5";
	$db->query($sql);
	$list=$db->fetchAll();

	foreach($list as $key=>$val){
	$b=explode("|",$list[$key][tp]);
	$d=COUNT($b);
	for($i=1;$i<$d;$i++){
	if($i%3==1){$c1=$i;$c2=$i+1;$c3=$i+2;

	$e1=$b[$c1];
	$e2="格式".$b[$c2]."大小".$b[$c3];
	$e3="|".$e1."|".$b[$c2]."|".$b[$c3];
	//$list[$key][tp1].="<a href=?action=sell&do=tpyl&wz=".$e1." target=navTab ><img src=chajian/slt/slt.php?src=".$cfg["app"].$e1."&w=400 ></a>"
	$list[$key][tp1].="<div class=tbbox><img src=chajian/slt/slt.php?src=".$cfg["app"].$e1."&w=400 ></div>";}
	}
	if($list[$key][tp]==""){$list[$key][kj]="none";}else{$list[$key][kj]="";}
	}
	$smt->assign('list',$list);
	$smt->assign('title',"图片预览");
	$smt->display('pic_view.htm');
	exit;
}
//图片上传
if($do=="updata2"){
	//sql
	$tpsc=$_POST[tp].$_POST[tp2];
	$sql="UPDATE `cs_sell` SET 
	`tp` = '$tpsc'
	 WHERE `cs_sell`.`id` ='$_POST[id]' LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=sell&do=tpad&id=$_POST[id]\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=sell&do=tpad&id=$_POST[id]\"}";}	
	exit;
}
//图片删除
if($do=="picdel"){
	//dump($_POST);
	$picdz=explode("|",$tpnr);
	if(unlink($picdz[1])){
	$sql="UPDATE `cs_sell` SET 
	`tp` =replace(tp,'$tpnr','') WHERE `cs_sell`.`id` ='$id' LIMIT 1 ;";
	
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=sell&do=tpad&id=$id\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=sell&do=tpad&id=$id\"}";}}
	else{echo "{\"statusCode\":\"300\",\"message\":\"找不到图片!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=sell&do=tpad&id=$id\"}";}
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
	$sql="SELECT i.name,i.salesid,s.id,s.infoid,s.intro,s.salesid2,s.created_at,s.fz FROM `cs_sell` as s,`cs_info` as i where s.infoid = i.id and s.infoid='$id' order by s.id desc LIMIT 5";
	if($nu=mysql_num_rows(mysql_query($sql))<=0){echo"系统没有记录该客户的来院信息";}
	else{
	//用户
	$db->query($sql);
	
echo '<style>.lb{margin:0;padding:0;}.lb li{background:#FFF; text-align:left;line-height:20px;font-size:12px;list-style:none;}span{padding_left:5px;}</style>';
echo '<ul class="lb">';
while($row=$db->fetchRow()){
		$row[salesid2_txt] = $user_list[$row[salesid2]];
		$row[salesid_txt] = $user_list[$row[salesid]];
		$fz1=array('1'=>'初诊','2'=>'复诊','0'=>'不详');
		$row[fz_cn] = strtr($row[fz],$fz1);

echo '<li>'.$row[created_at].'--<b>姓名: </b>'.$row[name].'--<b>接待人: </b>'.$row[salesid2_txt].'--<b>登记人: </b>'.$row[salesid_txt].'--<b>到诊情况: </b>'.$row[fz_cn].'--<b>备注: </b>'.$row[intro].'----</li>';}}
echo '</ul>';
exit;	
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	//查询要删除的sellid下的infoID
	$sql="SELECT infoid FROM `cs_sell` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	//执行要删除的	
	$sql="delete from `cs_sell` where `cs_sell`.`id`=$id limit 1";
	if($db->query($sql)){
		$sql="UPDATE `cs_info` SET `visitnum` = visitnum-1 WHERE `cs_info`.`id`=$row[infoid] LIMIT 1 ;";
		$db->query($sql);
		echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	}else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}		
	exit;
}

?>
