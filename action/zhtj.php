<?php
while(date('Y-m-d')>'2016/3/1')die('本程序使用权限已过期！请联系QQ:13011103');?>
<?php
header("Content-type: text/html; charset=utf-8");
if(!defined('CORE'))exit("error!"); 

include(CORE."include/cfg.php");		  //配置类

//用户
$sql_user="SELECT id,username FROM `cs_user` ";
$db->query($sql_user);
$user_arr=$db->fetchAll();
foreach($user_arr as $key=>$val){
$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
}
//预约方式
	$sql_type="SELECT id,title FROM `cs_type` ";
	$db->query($sql_type);
	$type_arr=$db->fetchAll();
	foreach($type_arr as $key=>$val){
		$type_list[$type_arr[$key][id]]=$type_arr[$key][title];	
	}
//已来院列表	
if($do=="list1"){
	If_rabc($action,$do); //检测权限
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " && name like '%$_POST[name]%'";}	
	if($_POST['tel']){$search .= " && tel like '%$_POST[tel]%'";}
	if($_POST['typeid']){$search .= " && typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " && salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && `created_at` >=  '$_POST[time_start]' &&  `created_at` <=  '$_POST[time_over]'";
	}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_info` where visitnum>0 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//查询
	$sql="SELECT * FROM `cs_info` where visitnum>0 $search order by id desc  LIMIT $pageNum,$numPerPage";
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


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"已到院客户列表");
	$smt->display('zhtj/zhtj_list1.htm');
	exit;
	}
//未来院列表	
if($do=="list2"){
	If_rabc($action,$do); //检测权限
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " && name like '%$_POST[name]%'";}	
	if($_POST['tel']){$search .= " && tel like '%$_POST[tel]%'";}
	if($_POST['typeid']){$search .= " && typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " && salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && `created_at` >=  '$_POST[time_start] 00:00:00' &&  `created_at` <=  '$_POST[time_over] 23:59:59'";
	}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_info` where visitnum=0 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//查询
	$sql="SELECT * FROM `cs_info` where visitnum=0 $search order by id desc  LIMIT $pageNum,$numPerPage";
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


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('time_start',$_POST[time_start]); //开始时间
	$smt->assign('time_over',$_POST[time_over]); //结束时间
	$smt->assign('total',$total);
	$smt->assign('title',"未到院客户列表");
	$smt->display('zhtj/zhtj_list2.htm');
	exit;
	}
 //到院已消费列表	
if($do=="list3"){
	If_rabc($action,$do); //检测权限
	//dump($_SESSION);
	//判断检索值
	$b=explode("#",$_POST[nt]);
	$b2=trim($_POST[nt]);
	if($_POST['nt']){$search .= " and (i.id='$b[1]' || i.name like '%$b2%' || i.tel like '%$b2%')";}	
	if($_POST['typeid']){$search .= " && i.typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " && i.salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and s.created_at >=  '$_POST[time_start]' and s.created_at <=  '$_POST[time_over]'";
	}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_sell` as s,`cs_info` as i where (s.money_ss>0||s.yepay>0||s.money_qf>0) and s.infoid = i.id $search GROUP BY infoid");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.typeid,i.id,i.hfnum,salesid2,s.infoid,s.productid,s.doctorid,s.intro,s.created_at,s.fz,s.money_qf,s.money_ss,s.yepay FROM `cs_sell` as s,`cs_info` as i where (s.money_ss>0||s.yepay>0||s.money_qf>0) and s.infoid = i.id $search  GROUP BY s.infoid order by s.created_at desc LIMIT $pageNum,$numPerPage";
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


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"已消费客户列表");
	$smt->display('zhtj/zhtj_list3.htm');
	exit;
	}
	 //到院未消费列表	
if($do=="list4"){	
	//dump($_SESSION);
	//判断检索值
	if($_POST['name']){$search .= " && name like '%$_POST[name]%'";}	
	if($_POST['tel']){$search .= " && tel like '%$_POST[tel]%'";}
	if($_POST['typeid']){$search .= " && i.typeid = '$_POST[typeid]'";}
	if($_POST['salesid']){$search .= " && i.salesid = '$_POST[salesid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and s.created_at >=  '$_POST[time_start]' and s.created_at <=  '$_POST[time_over]'";
	}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT sum(s.money_ss) as a sum(s.yepay) as b FROM `cs_sell` as s,`cs_info` as i where a=0 and b=0 and s.infoid = i.id $search GROUP BY s.infoid");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	


	//查询
	$sql="SELECT i.name,i.tel,i.zxxm,i.salesid,i.typeid,s.id,s.salesid2,s.infoid,s.productid,s.doctorid,s.intro,s.created_at,s.fz,s.money_qf,s.money_ss,s.yepay FROM `cs_sell` as s,`cs_info` as i where (s.money_ss=0&&s.yepay=0) and s.infoid = i.id $search  GROUP BY s.infoid order by s.id desc LIMIT $pageNum,$numPerPage";
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


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"未消费客户列表");
	$smt->display('zhtj/zhtj_list4.htm');
	exit;
	}
//会员列表积分统计	
if($do=="list5"){
	If_rabc($action,$do); //检测权限
	//dump($_SESSION);
	//判断检索值
	$b=explode("#",$_POST[nt]);
	$b2=trim($_POST[nt]);
	if($_POST['nt']){$search .= " and (i.id='$b[1]' || i.name like '%$b2%' || i.tel like '%$b2%')";}
	if($_POST['levelid']){$search .= "and levelid = '$_POST[levelid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and i.created_at >=  '$_POST[time_start]' AND  i.created_at <=  '$_POST[time_over]'";
	}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT id FROM `cs_info` where levelid != 0 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数	

	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}

	//查询
	$sql="SELECT (SELECT sum(s.money_ss) FROM `cs_sell` as s where s.infoid = i.id  $search) as num1,(SELECT count(*) FROM `cs_info` as b where b.parentid = i.id  $search) as num2,(SELECT sum(s.money_ss) FROM `cs_sell` as s,`cs_info` as b where s.infoid=b.id and b.parentid = i.id $search) as num3,(SELECT sum(s.integ) FROM `cs_sell` as s where s.infoid = i.id  $search) as num4,i.name,i.levelid,i.tel,i.xb,i.id,i.visitnum,i.salesid FROM `cs_info` as i  where i.levelid != 0 $search order by i.id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	$integral = explode("|",$config['integral']);//积分获取
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
		$list[$key][integral1]=$list[$key][num1]*$integral[0];//消费积分
		$list[$key][integral3]=$list[$key][num3]*$integral[1];//下线积分
		$list[$key][integral4]=$list[$key][num4];//消费积分
		$list[$key][integral6]=$list[$key][integral1]+$list[$key][integral3];//总积分
		$list[$key][integral5]=$list[$key][integral6]-$list[$key][integral4];//剩余积分
		$list[$key][sms]=$list[$key][integral6].','.$list[$key][integral4].','.$list[$key][integral5];
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


	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","级别选择"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));	
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"客户列表");
	$smt->display('member_list.htm');
	exit;
	
}
//会员下线查看
if($do=="list5show"){
	$smt = new smarty();smarty_cfg($smt);
	//查询
	$sql="SELECT * FROM `cs_info` where parentid='$id'";
	$db->query($sql);
	$list=$db->fetchAll();	

	
	//模版
	$smt->assign('list',$list);
	$smt->assign('title',"明细");
	$smt->display('member_show.htm');
	exit;
}

//关键词统计
if($do=="list6"){	
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and i.created_at >=  '$_POST[time_start]' AND  i.created_at <=  '$_POST[time_over]'";
	}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT COUNT(*) as dd,keyword FROM `cs_info` where keyword !='' $search GROUP BY keyword ORDER BY dd DESC");//当前频道条数
	
	$total=mysql_num_rows($info_num);//总条数	

				
	//查询
	$sql="SELECT (SELECT count(*) FROM `cs_info` as s where s.keyword=i.keyword  $search) as dj_n,(SELECT count(*) FROM `cs_info` as s where s.keyword=i.keyword and s.visitnum>=1 $search) as ly_n,(SELECT count(*) FROM `cs_info` as s where s.keyword=i.keyword and s.zlnum>=1 $search) as pd_n,(SELECT sum(b.money_ss) FROM `cs_sell` as b,`cs_info` as s where s.keyword=i.keyword and b.infoid=s.id $search) as je_n,keyword FROM `cs_info` as i where i.keyword !='' GROUP BY i.keyword ORDER BY dj_n DESC LIMIT $pageNum,$numPerPage"; 
	$db->query($sql);
	$list=$db->fetchAll();
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('title',"按关键字统计");
	$smt->display('zhtj/zhtj_list6.htm');
	exit;
	
}
//治疗项目统计
if($do=="list7"){
	if($_POST['zxxm']){$search .= " && zxxm like '%$_POST[zxxm]%'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " and created_at >=  '$_POST[time_start]' AND  created_at <=  '$_POST[time_over]'";
	}
	//设置排序
	$px='x_num';if($orderField){$px=$orderField;}
	//设置分页
	
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT COUNT(zxxm) as x_num,sum(visitnum>=1) as dy,sum(visitnum=0) as wdy,sum(visitnum>=1)/COUNT(zxxm) as dyl,zxxm FROM `cs_info` where zxxm !='' $search GROUP BY zxxm ORDER BY $px DESC");//当前频道条数
	
	$total=mysql_num_rows($info_num);//总条数	

				 
	//查询
	$sql="SELECT COUNT(zxxm) as x_num,sum(visitnum>=1) as dy,sum(visitnum=0) as wdy,sum(visitnum>=1)/COUNT(zxxm) as dyl,zxxm FROM `cs_info` where zxxm !='' $search GROUP BY zxxm ORDER BY $px DESC LIMIT $pageNum,$numPerPage"; 
	$db->query($sql);
	$list=$db->fetchAll();
	foreach($list as $key=>$val){
	$list[$key][dyl2]=round($list[$key][dyl],4)*100;
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('orderField',$orderField);
	$smt->assign('time_start',$_POST[time_start]); //开始时间
	$smt->assign('time_over',$_POST[time_over]); //结束时间
	$smt->assign('zxxm',$_POST[zxxm]); //预约项目
	$smt->assign('title',"按预约项目统计");
	$smt->display('zhtj/zhtj_list7.htm');
	exit;
	
}
//重复数据电话	
if($do=="sjjs"){
	$ms=$_POST[ms];
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT COUNT(*) as dd,id,tel,name,created_at FROM `cs_info` where  GROUP BY $ms ORDER BY dd");//当前频道条数
	
	$total=mysql_num_rows($info_num);//总条数	


	//查询
	$sql="SELECT COUNT(*) as dd,id,tel,name,created_at FROM `cs_info`  GROUP BY $ms ORDER BY dd DESC LIMIT $pageNum,$numPerPage"; 
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][xm] =urlencode($list[$key][name]);

	}

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	if($_POST[ms]=='tel'){$smt->assign('title',"按电话检索重复数据");$smt->display('sjjs_list.htm');}
	elseif($_POST[ms]=='name'){$smt->assign('title',"按姓名检索重复数据");$smt->display('sjjs_x_list.htm');}
	exit;
	
}

if($do=="sjjs2"){
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="50";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT id,tel,name,created_at FROM `cs_info` where name='$name' || tel='$tel'");//当前频道条数
	
	$total=mysql_num_rows($info_num);//总条数
	//用户
	$sql_user="SELECT id,username FROM `cs_user` ";
	$db->query($sql_user);
	$user_arr=$db->fetchAll();
	foreach($user_arr as $key=>$val){
		$user_list[$user_arr[$key][id]]=$user_arr[$key][username];	
	}
	
	//查询
	$name2=htmlentities(urlencode($name));
	if($tel!=''){$sql="SELECT id,tel,name,created_at,visitnum,salesid FROM `cs_info` where tel='$tel'";}
	else{$sql="SELECT id,tel,name,created_at,visitnum,salesid FROM `cs_info` where name='$name'";}
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
	$list[$key][salesid_txt] = $user_list[$list[$key][salesid]];
	}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('total',$total);
	$smt->assign('title',"重复数据详细");
	$smt->display('sjjs_list2.htm');
	exit;
	
}
//重复数据检索提交
if($do=="sjjs_tj"){
	$smt = new smarty();smarty_cfg($smt);

	//模版
	$smt->assign('title',"数据检索");
	$smt->display('sjjs_tj.htm');
	exit;
}
//首页快捷信息提示
if($do=="cue_yy"){
	$smt = new smarty();smarty_cfg($smt);
	$today=date("Y-m-d", time());
	//查询
	$sql="SELECT id FROM `cs_info` where yy_at='$today' ";
	$db->query($sql);
	$row=$db->fetchRow();
	$row[jryy]=mysql_num_rows(mysql_query($sql));
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"快捷统计");
	
	$smt->display('cue/cue_yy.htm');
	
	exit;
}
//首页快捷信息展示
if($do=="cuelist"){
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$today=date("Y-m-d", time());
	//查询
	$sql="SELECT id FROM `cs_info` where yy_at='$today' ";
	$db->query($sql);
	$row=$db->fetchRow();
	
	//模版
	$smt->assign('row',$row);
	$smt->assign('title',"编辑");
	
	$smt->display('info_edit.htm');
	
	exit;
}
?>