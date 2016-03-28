<?php
if(!defined('CORE'))exit("error!"); 
include(CORE."include/cfg.php");		  //配置类
include(CORE."include/jqm.php");		  //机器码 
//首页	
if($do==""){
	$row[webtitle] = $config['webtitle'];//系统名称读取
	$row[mapsrc] = $config['mapsrc'];//在线地图加载
	$row[syslogo] = $config['syslogo'];//系统logo图片
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	$sql="SELECT * FROM `cs_doc` where sx like '%,1,%' order by id desc limit 7" ;
	$db->query($sql);
	$list=$db->fetchAll();
	
	foreach($list as $key=>$val){
		$list[$key][intro_txt]=strip_tags(substr($list[$key][intro],30))."…"; 
		$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
		$sx=explode(",",$list[$key][sx]);
		if($sx[0]!=""&&$sx[0]!="#000000"){$list[$key][sx1]="color:".$sx[0].";";}
		if($sx[2]==1){$list[$key][sx2]="font-weight:bold;";}
		if($sx[3]!=""){$list[$key][sx3]="font-size:1.".$sx[3]."em;";}
	}

	$row[today]=date("Y-m-d", time());//今天
	$row[yesterday]=date("Y-m-d",strtotime("-1 day"));
	$sql_yy="SELECT id FROM `cs_info` where yy_at='$row[today]' ";//统计今日预约
	$row[jryy]=mysql_num_rows(mysql_query($sql_yy));

	//昨日短信回复
	$sql_sms="SELECT id FROM `msg_inbox` where MsgArrivedTime >= '$row[yesterday] 00:00:00' and MsgArrivedTime <= '$row[yesterday]  23:59:59' and handle='0' ";//统计短信回复
	$row[jrsms]=mysql_num_rows(mysql_query($sql_sms));
	//今日再回访
	$sql_visits="SELECT id FROM `cs_visits` where created_at = '$row[today]' and type=1";//统计再回访数
	$row[jrvisits]=mysql_num_rows(mysql_query($sql_visits));

	//今日治疗派单
	$sql_zhiliao="SELECT id FROM `cs_zhiliao` where zhiliao_at >= '$row[today] 00:00:00' and zhiliao_at <= '$row[today] 23:59:59'";//统计再回访数
	$row[jrzhiliao]=mysql_num_rows(mysql_query($sql_zhiliao));
		 
	if(!isLogin()){exit($lang_cn['rabc_is_login']);} //判断是否登录
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',$row[webtitle]);  
	$row[fzgj]='http://www.33c33.com/3gongju/index.html';
	//模版
	$sql_tt="SELECT id,title,type FROM `cs_type` where type='productid' and xs=0 order by id asc ";//科室列表
	$db->query($sql_tt);
	$list2=$db->fetchAll();
	$smt->assign('row',$row);
	$smt->assign('list',$list);
	$smt->assign('list2',$list2);
	$smt->display('index.htm');
	exit;
}

?>
