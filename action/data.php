<?php
while(date('Y-m-d')>'2016/3/1')die('本程序使用权限已过期！请联系QQ:13011103');?>
<?php
if(!defined('CORE'))exit("error!");
include(CORE."include/cfg.php");		  //配置类 电话数据导出用

//备份	
if($do=="backup"){	
	If_rabc($action,$do); //检测权限
		
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('title',"数据备份");
	$smt->display('data_backup.htm');
	exit;
}

//备份	
if($do=="backupupdata"){	
		If_rabc($action,$do); //检测权限
		
		$host = array($mt["host"],$mt["user"],$mt["pass"],$mt["name"]);
		$conn=mysql_connect($host[0],$host[1],$host[2]);
		mysql_select_db($host[3]);
		mysql_query("set names utf8");//注意编码
		$res=mysql_list_tables($host[3]);
		
		//得到数据库中所有的表
		while ($row = mysql_fetch_row($res))
		   $table[]=$row[0];
		
		//导出表的结构		   
		foreach ($table as $v){
			$sql.="DROP TABLE IF EXISTS `$v`;\n";   //如果导入是会先执行一段删除表.
			$create=mysql_query("SHOW CREATE TABLE $v");
			$rs = mysql_fetch_row($create);
			$tables =$rs[1].";\n\n";
		}
		//导出所有数据
		foreach ($table as $v){
			$res=mysql_query("select * from $v");
			while ($rs=mysql_fetch_array($res,MYSQL_NUM))
			{        
					foreach ($rs as $key => $val)
					$rs[$key] = mysql_escape_string($val);
					$inser = implode("','",$rs);
					$inse .= sprintf("INSERT INTO $v VALUES('%1s');",$inser)."\n";
			}
		}
		
		$path=CORE."/bak/".date('Y-m-d-h-m-s').'.sql';
		if(file_put_contents($path,$inse)){		
			echo "{\"statusCode\":\"200\",\"message\":\"数据备份成功,生成备份文件!".date('Y-m-d-h-m-s').'.sql'."\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=data&do=backup\"}";
		}else{
			echo  "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=data&do=backup\"}";
		}
		
	exit;
}

//恢复	
if($do=="recover"){	
	If_rabc($action,$do); //检测权限
	
	$dir = "./bak";
	$list=myreaddir($dir);
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('title',"恢复列表");
	$smt->display('data_recover.htm');
	exit;	
}

//恢复	
if($do=="recoverupdata"){
	$sql1="TRUNCATE TABLE `cs_info`";
	$sql3="TRUNCATE TABLE `cs_money`";
	$sql4="TRUNCATE TABLE `cs_role`";
	$sql5="TRUNCATE TABLE `cs_sell`";
	$sql6="TRUNCATE TABLE `cs_type`";
	$sql7="TRUNCATE TABLE `cs_user`";
	$sql8="TRUNCATE TABLE `cs_visits`";
	$sql9="TRUNCATE TABLE `cs_zhiliao`";
	if($db->query($sql1) && $db->query($sql3) && $db->query($sql4) && $db->query($sql5) && $db->query($sql6) && $db->query($sql7) && $db->query($sql8) && $db->query($sql9)){
		$file= "./bak/".$id;
		$data=file_get_contents($file);
		$data1=explode("\n", $data);
		foreach($data1 as $val){
			if($val){
			$db->query($val);
			}
		}
		echo "{\"statusCode\":\"200\",\"message\":\"恢复成功!".$_GET[id]."\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=data&do=recover\"}";
	}else{
		echo "{\"statusCode\":\"300\",\"message\":\"恢复失败!".$_GET[id]."\",\"navTabId\":\"\",\"callbackType\":\"forward\",	\"forwardUrl\":\"?action=data&do=recover\"}";
	}
	exit;
}


//删除	
if($do=="del"){	
	$file= "./bak/".$id;
	
    if(unlink($file)){
	//模版
	echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	}else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}		
	exit;	
}
//日志文件列表	
if($do=="record"){
	If_rabc($action,$do); //检测权限
	if($tid==""){$dir = "chajian/chat/rooms";$mb='record_list.htm';}
	elseif($tid=="khtp"){$dir = "uploadify/rizhi";$mb='record_list2.htm';}
	elseif($tid=="ewm"){$dir = "chajian/ewm/images";$mb='record_list2.htm';}
	elseif($tid=="mbfc"){$dir = "temp/compile";$mb='record_list2.htm';}
	else{$mb='record_list2.htm';}

	//设置分页
	if($_POST[numPerPage]==""){
		$numPerPage="10";
	}else{
		$numPerPage=$_POST[numPerPage];
	}

	if($_POST[pageNum]==""||$_POST[pageNum]=="0" ){$pageNum="0";}else{$pageNum=($_POST[pageNum]-1)*$numPerPage;}
	$list=myreaddir($dir);
	$arr = scandir($dir); 
    $total= count($list);//统计文件个数

	
	
	//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('numPerPage',$_POST[numPerPage]); //显示条数
	$smt->assign('pageNum',$_POST[pageNum]); //当前页数
	$smt->assign('dir',$dir);
	$smt->assign('total',$total);
	$smt->assign('title',"日志文件");
	$smt->display($mb);
	exit;	
}
//日志文件删除	
if($do=="recorddel"){
	$file= $id;
	
    if(unlink($file)){
	//模版
	echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"record\",\"callbackType\":\"forward\"}";
	}else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}		
	exit;	
}
//日志文件删除	
if($do=="recorddel2"){
	$ids=implode(',',$_POST[rz]);
	
	$del_num=count($_POST[rz]);
	for($i=0;$i<$del_num;$i++){
		$file= $_POST[rz][$i];
			$zxx=unlink($file);	
		}
	if($zxx){
	echo "{\"statusCode\":\"200\",\"message\":\"操作成功!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";
	}else{echo "{\"statusCode\":\"300\",\"message\":\"操作错误!\",\"navTabId\":\"\",\"callbackType\":\"forward\"}";}
	
	exit;	
}
//数据按条件导出
if($do=="export"){
If_rabc($action,$do); //检测权限
if(isset($_POST['mt'])){set_time_limit(0);
	//导出部分
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;filename=mtp.xls");
header('Cache-Control: max-age=0');
//条件搜索
	if($_POST['visitnum']){$search .= " && visitnum $_POST[visitnum] 1";}
	if($_POST['productid']){$search .= " && productid = '$_POST[productid]'";}
	if($_POST['tel']){$search .= " && tel != ''";}
	if($_POST['typeid']){$search .= " && typeid = '$_POST[typeid]'";}
	if($_POST['areaid']){$search .= " && areaid = '$_POST[areaid]'";}
	if($_POST['levelid']){$search .= " && levelid = '$_POST[levelid]'";}
	if($_POST['salesid']){$search .= " && salesid = '$_POST[salesid]'";}
	if($_POST['parentid']){$search .= " && parentid = '$_POST[parentid]'";}
	if($_POST['time_start']!="" && $_POST['time_over']!=""){
		$search .= " && `created_at` >=  '$_POST[time_start] 00:00:00' &&  `created_at` <=  '$_POST[time_over] 23:59:59'";
	}
	if($_POST['tel2']){$cf = "GROUP BY tel";}
	$sql="select * from cs_info where 1=1 $search $cf limit 0,5000";
	$db->query($sql);
	$list=$db->fetchAll();

//格式化输出数据
	foreach($list as $key=>$val){
	if($_POST[dc_tel]){$list[$key][dc_tel]=$list[$key][tel];}
	if($_POST[dc_name]){$list[$key][dc_name]=$list[$key][name];}
	if($_POST[dc_qq]){$list[$key][dc_qq]=$list[$key][qq];}
	if($_POST[dc_zxxm]){$list[$key][dc_zxxm]=$list[$key][zxxm];}
	}

	$smt = new smarty();
	$smt->assign('list',$list);
	$smt->display('info/date_list.htm');
	exit;}
//模版
	$smt = new smarty();smarty_cfg($smt);
	$smt->assign('list',$list);
	$smt->assign('typeid_cn',select($typeid,"typeid","","预约方式"));
	$smt->assign('areaid_cn',select($areaid,"areaid","","地区选择"));
	$smt->assign('levelid_cn',select($levelid,"levelid","","会员分类"));
	$smt->assign('salesid_cn',select($salesid,"salesid","","登记人"));
	$smt->assign('title',"电话数据导出");
	$smt->display('data_export.htm');
	exit;
}

?>