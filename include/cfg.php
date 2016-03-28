<?php
header("Content-type: text/html; charset=utf-8");

//类型
$sql_tt="SELECT id,title,type FROM `cs_type` where xs=0 order by id asc ";
$db->query($sql_tt);
$type_cut=$db->fetchAll();
foreach ($type_cut as $key => $val) {
        $type_cut[$val[type]][$val[id]] = $val[title];
        unset($type_cut[$key]);
}

$areaid=$type_cut[areaid];
$typeid=$type_cut[typeid];
$levelid=$type_cut[levelid];
$productid=$type_cut[productid];
$doctid=$type_cut[doctid];
$doctorid=$type_cut[doctorid];


//销售
$sql_salesid="SELECT id,username FROM `cs_user`  order by id asc ";
$db->query($sql_salesid);
$salesid_arr=$db->fetchAll();
foreach($salesid_arr as $key=>$val){
	$salesid[$salesid_arr[$key][id]]=$salesid_arr[$key][username];	
}


//系统配置读取
$sql_config="SELECT * FROM `cs_config`  order by id asc ";
$db->query($sql_config);
$config_arr=$db->fetchAll();
foreach($config_arr as $key=>$val){
	$config[$config_arr[$key][varname]]=$config_arr[$key][value];	
}

?>
