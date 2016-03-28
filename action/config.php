<?php
if(!defined('CORE'))exit("error!"); 
include(CORE."include/cfgqt.php");		  //配置类 
//列表	
if($do==""){
	If_rabc($action,$do); //检测权限
	
	if($_POST['title']){$search .= "and title like '%$_POST[title]%'";}	
	if($_POST['type']){$search .= "and type = '$_POST[type]'";}

	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_type` where 1=1 $search ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询
	$sql="SELECT * FROM `cs_type` where 1=1 $search order by type desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	foreach($type_cn as $key=>$val){
		$row1[type].="<li><a href=\"?action=config&do=list&id={$key}\" target=\"ajax\" rel=\"confingBox\">{$val}</a></li>";
	} 

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][type_cn]=$type_cn[$list[$key][type]];
		$xs1=array('1'=>'<font style=color:#ccc; >不可用</font>','0'=>'可用');
		$list[$key][xs_cn] = strtr($list[$key][xs],$xs1);
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('list',$list);
	$smt->assign('row1',$row1);
	$smt->assign('total',$total);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('select_type_cn',select($type_cn,"type","","选择类型","required"));
	$smt->assign('title',"配置列表");
	$smt->display('config/config_list.htm');
	exit;
	
}
//列表2	
if($do=="list"){

	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_type` where type='$id' ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	
	//查询
	$sql="SELECT * FROM `cs_type` where type='$id' order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	
	

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][type_cn]=$type_cn[$list[$key][type]];
		$xs1=array('1'=>'<font style=color:#ccc; >不可用</font>','0'=>'可用');
		$list[$key][xs_cn] = strtr($list[$key][xs],$xs1);
	}
	$row1[lmid]=$id;
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('list',$list);
	$smt->assign('row1',$row1);
	$smt->assign('total',$total);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('select_type_cn',select($type_cn,"type","","选择类型","required"));
	$smt->assign('title',"配置列表");
	$smt->display('config/config_list2.htm');
	exit;
	
}
//新建	
if($do=="new"){
	if(isset($_POST['title'])){
	$created_at=date("Y-m-d H:i:s", time());
	$sql="INSERT INTO `cs_type` (`title` ,`type` ,`created_at` )
	VALUES ( '$_POST[title]','$_POST[type]', '$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"config\",\"callbackType\":\"closeCurrent\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config\"}";}	
	exit;}//写入结束
	If_rabc($action,$do); //检测权限
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('select_type_cn',select($type_cn,"type",$lmid,"选择类型","required"));
	$smt->assign('title',"新建配置");
	$smt->display('config/config_new.htm');
	exit;
}

//编辑	
if($do=="edit"){	
	If_rabc($action,$do); //检测权限
	
	//查询
	$sql="SELECT * FROM `cs_type` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	if($row[xs]==0){$row[checked0]='checked';}else{$row[checked1]='checked';}
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('select_type_cn',select($type_cn,"type",$row[type],"选择类型","required"));
	$smt->assign('row',$row);
	$smt->assign('title',"编辑配置");
	$smt->display('config/config_edit.htm');
	exit;
}


//更新
if($do=="updata"){
	If_rabc($action,$do); //检测权限
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_POST['id'];

	$sql="UPDATE `cs_type` SET 
	`title`  = '$_POST[title]',
	`type`  = '$_POST[type]',
	`xs`  = '$_POST[xs]',
	`updated_at` = '$updated_at' WHERE `cs_type`.`id` ='$id' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config\"}";}		
	exit;
}

//是否显示
if($do=="xs"){
	$updated_at=date("Y-m-d H:i:s", time());
	$id=$_POST['id'];

	$sql="UPDATE `cs_type` SET 
	`xs`  = '$_POST[xs]',
	`updated_at` = '$updated_at' WHERE `cs_type`.`id` ='$id' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config\"}";}		
	exit;
}
//删除
if($do=="del"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `cs_type` where `cs_type`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config\"}";}	
	exit;
}

//价格栏目写入
if($do=="pricecoladd"){
	$created_at=date("y-m-d", time());
	$sql="INSERT INTO `cs_type_alone` (`title` ,`type`,`created_at` )
	VALUES ('$_POST[title]','priceid','$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config&do=pricelist\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}
	exit;
}
//价格栏目修改
if($do=="pricecoledit"){
	if(isset($_POST[title])){
	$created_at=date("y-m-d", time());
	$sql="UPDATE `cs_type_alone` SET 
	`title`  = '$_POST[title]' WHERE `cs_type_alone`.`id` ='$id' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config&do=pricelist\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}
	}
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('title',"项目栏目修改");
	$smt->display('price/price_col_edit.htm');
	exit;
}
//增加价格	
if($do=="pricenew"){
	If_rabc($action,$do); //检测权限
	 if(isset($_POST['pricenew'])){
	include(CORE."include/pinyin.php");		  //拼音
	$py=iconv("utf-8","gbk",$_POST[item]);
	$word=$PingYing->getFirstPY($py)." ".$PingYing->getAllPY($py);
	$created_at=date("y-m-d h:i:s", time());
	$sql="INSERT INTO `cs_price` (`item`,`intro`,`price`,`typeid`,`word`,`created_at`)
	VALUES ('$_POST[item]','$_POST[intro]','$_POST[price]','$_POST[typeid]','$word','$created_at');";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"pricesz\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作失败!\"}";}
	exit;
	 }else{

	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('priceid_cn',select($priceid,"typeid","$lmid","所属栏目","required"));
	$smt->assign('list',$list);
	$smt->assign('title',"增加价格");
	$smt->display('price/price_new.htm');
	exit;}
}
//价格修改
if($do=="priceedit"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['id'])){
	$id=$_POST['id'];
	include(CORE."include/pinyin.php");		  //拼音
	$py=iconv("utf-8","gbk",$_POST[item]);
	$word=$PingYing->getFirstPY($py)." ".$PingYing->getAllPY($py);

	$sql="UPDATE `cs_price` SET 
	`item`  = '$_POST[item]',
	`price`  = '$_POST[price]',
	`typeid`  = '$_POST[typeid]',
	`intro` = '$intro',
	`word` = '$word' WHERE `cs_price`.`id` ='$id' LIMIT 1 ;";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作失败!\"}";}
	exit;
	 }else{
	//价目栏目查询
	$sql_type="SELECT * FROM `cs_price` where id='$id'";
	$db->query($sql_type);
	$row=$db->fetchRow();
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('priceid_cn',select($priceid,"typeid",$row[typeid],"所属栏目","required"));
	$smt->assign('title',"价格修改");
	$smt->display('price/price_edit.htm');}
	exit;
}
//价格修改留着备份参考
if($do=="priceedit2"){
	If_rabc($action,$do); //检测权限
	$id='{$_POST["id"]}';
	$sql="UPDATE `cs_price` SET 
	`item`  = '{$_POST["item"]}',`price`  = '{$_POST["price"]}',`intro`  = '{$_POST["intro"]}' WHERE `cs_price`.`id` ='{$_POST["id"]}' LIMIT 1 ;";
	if($db->query($sql)){ 
	echo "修改成功"; 
	}else{ 
	echo "权限不足保存失败"; 
	}		
	exit;
}

//价目列表	
if($do=="pricelist"){
	If_rabc($action,$do); //检测权限
	if($_POST['item']){$search .= "and item like '%$_POST[item]%' || word like '%$_POST[item]%'";}	
	if($_POST['typeid']){$search .= "and typeid = '$_POST[typeid]'";}
	
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="30";
	}else{	
		$numPerPage=$_POST[numPerPage];
	}
	if($tid!=""){$idt="typeid=$tid";$mb="price/price_list2.htm";}else{$idt="1=1";$mb="price/price_list.htm";}
	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_price` where $idt $search ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	$sql="SELECT * FROM `cs_price` where $idt $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//查询栏目
	$sql2="SELECT * FROM `cs_type_alone` where type='priceid' order by id desc";
	$db->query($sql2);
	$list2=$db->fetchAll();

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
	}
	$list2[lmid]=$tid;
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('list',$list);	
	$smt->assign('list2',$list2);
	$smt->assign('priceid_cn',select($priceid,"typeid","","所属栏目",""));
	$smt->assign('total',$total);
	$smt->assign('title',"价目列表");
	$smt->display($mb);
	exit;
}
//价目列表	
if($do=="pricelistmb"){
	if($_POST['item']){$search .= "and item like '%$_POST[item]%' || word like '%$_POST[item]%'";}	
	if($_POST['typeid']){$search .= "and typeid = '$_POST[typeid]'";}
	
	//显示
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT * FROM `cs_price` where 1=1 $search");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数

	$sql="SELECT * FROM `cs_price` where 1=1 $search order by id desc LIMIT $pageNum,$numPerPage";
	$db->query($sql);
	$list=$db->fetchAll();
	//查询栏目
	$sql2="SELECT * FROM `cs_type_alone` where type='priceid' order by id desc ";
	$db->query($sql2);
	$list2=$db->fetchAll();

	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
	}
	$list2[lmid]=$tid;
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('list',$list);	
	$smt->assign('list2',$list2);
	$smt->assign('priceid_cn',select($priceid,"typeid","","所属栏目",""));
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"价目列表");
	$smt->display('price/price_list_mb.htm');
	exit;
}
//一键拼音
if($do=="pinyin"){
	include(CORE."include/pinyin.php");		  //拼音
	
	$sql="SELECT item FROM `cs_price` ";
	$db->query($sql);
	$row=$db->fetchAll();
	foreach($row as $key=>$val){
		$item=$row[$key][item];
		$py=iconv("utf-8","gbk",$item);
		$word=$PingYing->getFirstPY($py)." ".$PingYing->getAllPY($py);
		$sql="UPDATE `cs_price` SET  `word` = '$word' where `cs_price`.`item`='$item'";
		$db->query($sql);
		echo $row[$key][item]."----成功</br>";	
	}
exit;
}
//价格删除
if($do=="pricedel"){
	If_rabc($action,$do); //检测权限
	$sql="delete from `cs_price` where `cs_price`.`id`=$id limit 1";
	if($db->query($sql)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=config&do=pricelist\"}";}else{echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\"}";}	
	exit;
}
//系统设置列表	
if($do=="sys"){
	If_rabc($action,$do); //检测权限
	if($_POST['title']){$search .= "and title like '%$_POST[title]%'";}	
	if($_POST['type']){$search .= "and type = '$_POST[type]'";}
	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="20";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$info_num=mysql_query("SELECT id FROM `cs_config` where type!='smssz' $search ");//当前频道条数
	$total=mysql_num_rows($info_num);//总条数
	//查询
	$sql="SELECT * FROM `cs_config` where type!='smssz' $search order by type desc";
	$db->query($sql);
	$list=$db->fetchAll();
	//格式化输出数据
	foreach($list as $key=>$val){
		if($key%2==0){
			$list[$key][rowcss]="listOdd";
		}else{
			$list[$key][rowcss]="listEven";
		}
		$list[$key][canshu]="";
		if($list[$key][varname]=='financepass'){$list[$key][value]='**********';}
		if($list[$key][type]=='print'){$list[$key][canshu]='height="550" width="900"';}
	}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('total',$total);
	$smt->assign('title',"配置列表");
	$smt->display('config/sys_list.htm');
	exit;	
}

//系统设置编辑
if($do=="sysupdata"){
	If_rabc($action,$do); //检测权限
	if(isset($_POST['id'])){
	$id2=$_POST['id'];
	$value=$_POST[value];
	
	if($_POST[varname]=='financepass'){$value=md5($_POST[value]);}
	if($_POST[dy]=='printsell'){$value="{$_POST[mar_u]}|{$_POST[mar_d]}|{$_POST[mar_l]}|{$_POST[mar_r]}|{$_POST[p_u]}|{$_POST[p_d]}|{$_POST[p_m]}";}
	$sql2="UPDATE `cs_config` SET 
	`value`  = '$value',`value2`  = '$_POST[value2]' WHERE `cs_config`.`id` ='$id2' LIMIT 1 ;";
	if($db->query($sql2)){echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"sys\",\"callbackType\":\"closeCurrent\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作失败!\"}";}
	exit;
	 }
	$sql="SELECT * FROM `cs_config` where id='$id' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$mb='config/sys_edit.htm';
	if($row[varname]=='financepass'){$row[value]='';}
	if($row[varname]=='sms_dztp'||$row[varname]=='syslogo'){$mb='config/sys_edit_upload.htm';}
	if($row[type]=='print'){$mb='config/sys_edit_print.htm';
	$print_cs = explode("|",$row[value]);
	$row[mar_u]=$print_cs[0];$row[mar_d]=$print_cs[1];$row[mar_l]=$print_cs[2];$row[mar_r]=$print_cs[3];
	$row[p_u]=$print_cs[4];$row[p_d]=$print_cs[5];$row[p_m]=$print_cs[6];}
	if($row[p_m]==0){$row[checked0]='checked';}else{$row[checked1]='checked';}
	
	//模版
	$smt = new smarty();smarty_cfg($smt);	
	$smt->assign('row',$row);
	$smt->assign('title',"配置列表");
	$smt->display($mb);
	exit;
}
//短信模式设置
if($do=="sms"){

	if($_POST['title']){$search .= "and title like '%$_POST[title]%'";}	
	if($_POST['type']){$search .= "and type = '$_POST[type]'";}
	
	//查询
	$sql="SELECT * FROM `cs_config` where varname='sms_ms' LIMIT 1";
	$db->query($sql);
	$row=$db->fetchRow();
	$smsval=explode(",",$row[value]);
	if($smsval[0]=='2'){$row[dqms]='短信平台通道模式';}else{$row[dqms]='彩信猫模式';}
	$row[ms]=$smsval[0];
    $row[username]=$smsval[1];
	$row[password]=$smsval[2];
	$row[pm]=md5($smsval[2]);

	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('row',$row);
	$smt->assign('list',$list);
	$smt->assign('title',"短信配置");
	$smt->display('config/config_sms.htm');
	exit;	
}
//短信设置更改
if($do=="sms_sz"){
    $value=$_POST["ms"].",".$_POST["username"].",".$_POST["password"];
	$sql="UPDATE `cs_config` SET 
	`value`  = '$value' WHERE `cs_config`.`varname` ='sms_ms' LIMIT 1 ;";
	if($db->query($sql)){ 
	echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"sys\"}";}
	else{echo "{\"statusCode\":\"300\",\"message\":\"操作失败!\"}";}
	exit;
}
?>