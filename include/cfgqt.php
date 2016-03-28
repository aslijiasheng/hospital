<?php
header("Content-type: text/html; charset=utf-8");

//价格栏目
$sql_price="SELECT id,title FROM `cs_type_alone` where type='priceid'";
$db->query($sql_price);
$price_arr=$db->fetchAll();
foreach($price_arr as $key=>$val){
	$priceid[$price_arr[$key][id]]=$price_arr[$key][title];	
}
//短信栏目
$sql_sms="SELECT id,title FROM `cs_type_smsmail` where type='smsid' and userid='$_SESSION[userid]'";
$db->query($sql_sms);
$sms_arr=$db->fetchAll();
foreach($sms_arr as $key=>$val){
	$smslmid[$sms_arr[$key][id]]=$sms_arr[$key][title];	
}
//客户表定义
$infosex=array('女'=>'女','男'=>'男');	//性别定义
	//初诊复诊类型
	$diagnosis=array('1'=>'初诊','2'=>'复诊','3'=>'不详');	//值不能为0 0和空值一样 3数据表该字段的默认值
	//回访客户满意度选项
	$v_evaluate=array('很满意'=>'A','一般'=>'B','较差'=>'C','不是很好'=>'D');	

//工作报告---汇报类型
$workstyle=array('1'=>'天总结','2'=>'周总结','3'=>'月总结','4'=>'季总结','5'=>'年总结');//不能为0，0为日程计划
$w_state=array('0'=>'<span style="color:#ccc">未审核</span>','1'=>'已审核');
//消息管理
$messtype=array('1'=>'公共信息','2'=>'私人信息','3'=>'回复信息');//此处勿改
//系统设置
	//特殊角色
	$u_role=array('1'=>'医生组','2'=>'医护人员');
?>
