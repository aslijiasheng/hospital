<?php
while(date('Y-m-d')>'2016/3/1')die('本程序使用权限已过期！技术联系QQ:13011103');?>
<?php 
if(!defined('CORE'))exit("error!"); 
$db    = new mysql($mt["host"],$mt["user"],$mt["pass"],$mt["name"]);
$succeed="<script>alert(\"成功!\");history.back(-1);</script>"; 
$error="<script>alert(\"失败!\");history.back(-1);</script>"; 
$lang_cn =array( 
"rabc_error"=>"<script>alert(\"权限不足!\");window.location=\"index.php\";</script>", 
"rabc_error_mobile"=>"<script>alert(\"权限不足!\");window.location=\"index.php\";</script>", 
"rabc_is_login"=>"<script>window.location=\"index.php?action=user&do=login\";</script>", 
"rabc_is_mobile_login"=>"<script>window.location=\"mobile.php?do=login\";</script>", 
"rabc_login_ok"=>"<script>window.location=\"index.php\";</script>", 
"rabc_login_mobile_ok"=>"<script>window.location=\"mobile.php\";</script>",
"rabc_login_dj"=>"<script>alert(\"用户已被冻结!请联系管理员\");window.location=\"index.php?action=user&do=login\";</script>",
"rabc_login_error"=>"<script>alert(\"用户密码错误!\");window.location=\"index.php?action=user&do=login\";</script>", 
"rabc_login_mobile_error"=>"<script>alert(\"用户密码错误!\");window.location=\"mobile.php?do=login\";</script>", 
"rabc_logout"=>"<script>alert(\"安全退出!\");window.location=\"index.php?action=user&do=login\";</script>",
"rabc_logout_repeat"=>"<script>alert(\"该账号在其他地方登入，你被强行退出了!\");window.location=\"index.php?action=user&do=login\";</script>", 
"rabc_logout_mobile"=>"<script>alert(\"安全退出!\");window.location=\"mobile.php?do=login\";</script>", 
"validate"=>"<script>alert(\"请输入账号信息!\");history.back(-1);</script>", 
"validate_mobile"=>"<script>alert(\"请输入账号信息!\");window.location=\"mobile.php?do=login\";</script>", 
"if_username"=>"<script>alert(\"此用户已存在,返回填写!\");history.back(-1);</script>" 
); 
$type_cn =array("areaid"=>"客户区域","typeid"=>"预约方式","levelid"=>"客户级别","productid"=>"科室设置","doctorid"=>"医生选择","doctid"=>"公告文档"); 
$action_cn=array( 
1=>"客户登记选项：",
"info"=>"客户列表", 
"infonew"=>"客户添加", 
"infoedit"=>"客户修改",
"infodel"=>"删除客户",
"infogiveup"=>"放弃客户",
"infoshow"=>"客户明细",
"infolog"=>"客户日志查看",
"infointroadd"=>"备注补充",
"infodate"=>"数据导出xls",

2=>"挂号选项：",
"sell"=>"挂号列表",
"infovisit"=>"挂号登记", 
"selledit"=>"挂号修改",
"selldel"=>"删除挂号",
"sellshow"=>"挂号明细",

3=>"图片选项：",
"selltpad"=>"录入图片",
"sellpicdel"=>"图片删除",

4=>"科室登记选项：",
"section"=>"科室列表",
"sectionadd"=>"科室档案创建",
"sectiondel"=>"科室档案删除",
"sectionupdata"=>"科室档案修改",

5=>"派单管理选项：",
"zhiliao"=>"派单列表",
"zhiliaoadd"=>"派单写入",
"zhiliaoedit"=>"派单修改",
"zhiliaodel"=>"派单删除",

6=>"插件管理选项：",
"plugcoupondel"=>"优惠券删除",

7=>"会员选项：",
"infoagent"=>"设置会员",
"zhtjlist5"=>"会员列表",

8=>"短信电话邮件选项：",
"smsmailsms"=>"短信发送",
"smsmails_list"=>"短信记录",
"smsmailsend"=>"邮件发送",
"visits"=>"回访列表",
"visitsnew"=>"新建回访",
"visitsshow"=>"回访明细",
"visitsedit"=>"修改回访",

9=>"办公选项：",
"doc"=>"文档列表", 
"docnew"=>"新建文档",  
"docedit"=>"编辑文档",  
"docdel"=>"删除文档", 
"docshow"=>"文档明细",
"docreply"=>"文档回复",
"docwork"=>"报告列表",
"docwork_new"=>"新建报告",
"docwork_show"=>"报告明细",
"docwork_edit"=>"编辑报告",
"docwork_audit"=>"审核报告",
"docwork_del"=>"删除报告",
"smsmailmesslist"=>"信息列表",
"smsmailmessshow"=>"信息浏览",
"smsmailmessnew"=>"发送信息",
"smsmailmessdel"=>"删除信息",

10=>"财务管理选项：",
"money"=>"金额管理表",
"moneylist2"=>"客户消费表",
"moneypay"=>"收费管理",
"moneypayadd"=>"收费写入",

11=>"用户管理选项：",
"user"=>"用户列表", 
"usernew"=>"新建用户", 
"useradd"=>"写入用户", 
"useredit"=>"编辑用户", 
"usereditpass"=>"修改密码", 
"userupdata"=>"更新用户", 
"userupdatapass"=>"更新密码", 
"userdel"=>"删除用户", 

12=>"后台系统配置选项：",
"userlistzx"=>"科室人员列表", 
"useraddzx"=>"科室人员创建", 
"userupdatazx"=>"修改科室人员",
"userdelzx"=>"删除科室人员",

"role"=>"用户组列表", 
"rolenew"=>"创建用户组",  
"roleedit"=>"修改用户组", 
"roledel"=>"删除用户组",
"userlistzx"=>"执行人员列表", 
"config"=>"配置列表", 
"confignew"=>"新建配置", 
"smsmailsz"=>"邮件设置",
"configedit"=>"编辑配置", 
"configupdata"=>"更新配置", 
"configdel"=>"删除配置",
"configsys"=>"系统配置列表",
"configsysupdata"=>"系统配置修改",
"configpricenew"=>"增加价格",
"configpricelist"=>"价格列表",
"configpriceedit"=>"价格修改",
"configpricedel"=>"价格删除",

13=>"数据统计选项：",
"zhtjlist1"=>"已到院客户",
"zhtjlist2"=>"未到院客户",
"zhtjlist3"=>"到院已消费",
"reportt1"=>"区域统计表", 
"reportt2"=>"类型统计表", 
"reportt3"=>"科室统计表", 
"reportt5"=>"预约统计表",
"databackup"=>"数据备份", 
"databackupupdata"=>"数据备份更新", 
"datarecover"=>"数据恢复", 
"datarecoverupdata"=>"数据恢复更新", 
"datarecord"=>"日志列表",  
"dataexport"=>"数据导出"
); 
function _RunMagicQuotes(&$svar){ 
if(!get_magic_quotes_gpc())    { 
if( is_array($svar) ){ 
foreach($svar as $_k =>$_v) $svar[$_k] = _RunMagicQuotes($_v); 
}else{ 
$svar = addslashes($svar); 
} 
} 
return $svar; 
} 
function smarty_cfg($self){ 
global $mt; 
global $css; 
$self->template_dir='./template'; 
$self->cache_dir='./temp/cache'; 
$self->compile_dir    ='./temp/compile'; 
$self->assign('mt',$mt); 
$self->assign('css',$css); 
} 
function message($message=array()){ 
global $mt; 
$smarty=new smarty(); 
$smarty->template_dir='./template'; 
$smarty->cache_dir='./temp/cache'; 
$smarty->compile_dir='./temp/compile'; 
$smarty->assign('mt',$mt); 
$smarty->assign('message',$message); 
$smarty->display('message.htm'); 
exit; 
} 
function strstrip( $s ){ 
$s = trim( $s ); 
$s = str_replace( '&#32;',' ',$s ); 
$s = str_replace( '&#60;','<',$s ); 
$s = str_replace( '&#92;','\\',$s ); 
$s = str_replace( '&#39;','\'',$s ); 
$s = str_replace( '&#37;','%',$s ); 
$s = str_replace( '&#34;','\"',$s ); 
$s = str_replace( '"','\'',$s); 
$s = str_replace( '\\','',$s ); 
$s=stripslashes($s); 
return $s; 
} 
foreach(Array('_GET','_POST','_COOKIE') as $_request){ 
foreach($$_request as $_k =>$_v) ${$_k}= _RunMagicQuotes($_v); 
} 
function check_rabc($role){ 
global $db; 
if(isset($_SESSION['user'],$_SESSION['pass'],$_SESSION['role'])){ 
//$sql="select u_user,u_pass,u_role from mi_user where u_user = '$_SESSION[user]' and u_pass = '$_SESSION[pass]'"; cs注掉
$db->query($sql); 
if($row=$db->fetchRow()){ 
if($row['u_role']==$role ||$row['u_role']>$role ){}else{ 
exit("<script>alert(\"权限不足!\");history.back(-1);</script>"); 
} 
}else{ 
exit("<script>alert(\"帐号密码有问题!\");window.location=\"login.php\";</script>"); 
} 
}else{ 
exit("<script>alert(\"登录超时!\");window.location=\"login.php\";</script>"); 
} 
} 
function select_user(){ 
global $db; 
$sql="select u_name,u_id from mi_user where u_role  = '1'"; 
$db->query($sql); 
$row=$db->fetchAll(); 
$select .= "<select name=\"userid\">"; 
foreach($row as $k){ 
$select .= "<option value=\"".$k['u_id']."\">".$k['u_name']."</option>"; 
} 
$select .= "</select>"; 
return $select; 
} 
function dump($array){ 
echo "<pre>"; 
print_r($array); 
echo "<pre>"; 
} 
function cnString($text,$length){ 
if(strlen($text) <= $length){ 
return $text; 
} 
$str = substr($text,0,$length) .chr(0) ; 
return $str; 
} 
function select($arr,$name,$self="",$cn_name="选择",$class="required"){ 
$slt .= "<select name=\"".$name."\" class=\"input ".$class."\" >"; 
$slt .= "<option value=\"\" selected=\"selected\">".$cn_name."</option>"; 
foreach($arr as $key=>$val){ 
if($key==$self){ 
$slt .= "    <option value=\"".$key."\" selected=\"selected\">".$val."</option>"; 
}else{ 
$slt .= "    <option value=\"".$key."\">".$val."</option>"; 
} 
} 
$slt .= "</select>"; 
return $slt; 
}
//cs定义函数
function radio($arr,$name,$self="",$custom){
foreach($arr as $key=>$val){
if($key==$self){
$cra .="<input type=\"radio\" name=\"".$name."\" value=\"".$key."\" ".$custom." checked=\"checked\"/>".$val."";
}else{
$cra .="<input type=\"radio\" name=\"".$name."\" value=\"".$key."\" ".$custom." />".$val."";
}}
return $cra; 
}
function checkbox($arr,$curarr){ 
$action=explode(',',$curarr); 
foreach($arr as $key=>$val){ 
if(in_array($key,$action)){ 
$cbox .="<input name=\"productid[]\" type=\"checkbox\" value=\"$key\" checked=\"checked\" />$val\n"; 
}else{ 
$cbox .= "<input name=\"productid[]\" type=\"checkbox\" value=\"$key\" />$val\n"; 
}
} 
return $cbox; 
} 
function checkbox2($arr,$curarr){ 
$action=explode(',',$curarr); 
foreach($arr as $key=>$val){ 
if(in_array($key,$action)){ 
$cbox .="<input name=\"doctorid[]\" type=\"checkbox\" value=\"$key\" checked=\"checked\" />$val\n"; 
}else{ 
$cbox .= "<input name=\"doctorid[]\" type=\"checkbox\" value=\"$key\" />$val\n"; 
}
} 
return $cbox; 
} 
function checkbox_mobile($arr,$curarr){ 
$action=explode(',',$curarr); 
foreach($arr as $key=>$val){ 
if(in_array($key,$action)){ 
$cbox .= "<input type=\"checkbox\" name=\"productid[]\" id=\"checkbox-".$key."\" class=\"custom\" value=\"".$key."\" checked=\"checked\"/>"; 
$cbox .= "<label for=\"checkbox-".$key."\">$val</label>"; 
}else{ 
$cbox .= "<input type=\"checkbox\" name=\"productid[]\" id=\"checkbox-".$key."\" class=\"custom\" value=\"".$key."\" />"; 
$cbox .= "<label for=\"checkbox-".$key."\">$val</label>"; 
} 
} 
return $cbox; 
} 
function myreaddir($dir) { 
$handle=opendir($dir); 
$i=0; 
while($file=readdir($handle)){ 
if ($file!="."&&$file!=".."&&!is_dir($file)){ 
$list[$i]=$file; 
$i=$i+1; 
} 
} 
closedir($handle); 
rsort($list); 
return $list; 
} 
function extend($file_name){ 
$extend =explode(".",$file_name); 
return end($extend); 
} 
function checkbox_role_action($row_action){ 
global $action_cn; 
$action=explode(',',$row_action); 
$i=1; 
foreach($action_cn as $key=>$val){
//增加判断数字，不显示选项
if(intval($key)){$cbox .="<div class=\"divider\">divider</div><label style=\"float:left;width:100%\"><b>$val</b></label>\n";}else{
if($key!="0"){ 
if(in_array($key,$action)){ 
$cbox .="<span style=\"float:left;width:150px\"><input name=\"action[]\" type=\"checkbox\" value=\"$key\" checked=\"checked\" />$val</span>\n"; 
}else{ 
$cbox .= "<span style=\"float:left;width:150px\"><input name=\"action[]\" type=\"checkbox\" value=\"$key\" />$val</span>\n"; 
} 
}} 
if($i==8){$cbox .="";} 
$i++; 
} 
return $cbox; 
} 
function array_add($arr1,$arr2){ 
foreach ($arr2 as $k =>$v){ 
if (array_key_exists($k,$arr1)){$arr1[$k] += $v;} 
else{$arr1[$k] = $v;} 
} 
return $arr1; 
} 
function If_rabc($action,$do){ 
global $lang_cn; 
global $db; 
if(!isLogin()){exit($lang_cn['rabc_is_login']);} 
$c_action=$action.$do; 
$userid=$_SESSION['userid']; 
$sql="SELECT r.action FROM `cs_user` as u,`cs_role` as r 
    where u.id='$userid' and u.roleid = r.id LIMIT 1"; 
$db->query($sql); 
$row=$db->fetchRow(); 
$r_action = explode(',',$row['action']); 
$m_action = array("userlogin","userloginok"); 
$h_action = array_merge($r_action,$m_action); 
if(!in_array($c_action,$h_action)){ 
echo "{\"statusCode\":\"300\",\"message\":\"权限不足，无法查看\"}";exit;
} 
} 
function isLogin(){ 
if(!empty($_SESSION['isLogin'])) 
return 1; 
else 
return 0; 
} 
function Ifvalidate($arr){ 
global $lang_cn; 
foreach($arr as $val){ 
if(!$val){exit($lang_cn['validate']);} 
} 
} 
function Ifvalidate_mobile($arr){ 
global $lang_cn; 
foreach($arr as $val){ 
if(!$val){exit($lang_cn['validate_mobile']);} 
} 
} 
function Ifusername($user,$tel){ 
global $db; 
global $lang_cn; 
$sql="SELECT id FROM `cs_info` where name='$user' or tel='$tel' LIMIT 1"; 
$db->query($sql); 
$row=$db->fetchRow(); 
if($row['id']){exit($lang_cn['if_username']);} 
} 
function my_json_encode($phparr){ 
if(function_exists("json_encode")){ 
return json_encode($phparr); 
}else{ 
require_once 'json.php'; 
$json = new Services_JSON; 
return $json->encode($phparr); 
} 
} 
function get_url(){ 
return $_SERVER["REQUEST_URI"]; 
}
//日志写入
function infolog($infoid,$intro,$type){ 
global $db;
$created=date("Y-m-d H:i:s");
$sql="INSERT INTO `cs_log` (`infoid`,`salesid`,`type`,`intro`,`created_at`) VALUES ('$infoid','$_SESSION[userid]','$type','$intro','$created');";
$db->query($sql);
}
//用户唯一登入判断
function onlylogin(){ 
global $db;
global $lang_cn; 
$sql2="SELECT id,active FROM `cs_user` where id='$_SESSION[userid]' LIMIT 1"; 
$db->query($sql2); 
$row=$db->fetchRow(); 
if($row['active']!=$_SESSION['active']){exit($lang_cn['rabc_logout_repeat']);}
}

//每天操作次数限制
function o_limit($type,$value){
	global $db;
	$created=date("Y-m-d");
	$sql="SELECT id FROM `cs_log` where type='$type' && salesid='$_SESSION[userid]' && created_at >=  '$created 00:00:00' &&  created_at <=  '$created 23:59:59' ";
	$db->query($sql);
	$num=$db->recordCount();
	if($num>=$value){echo "{\"statusCode\":\"300\",\"message\":\"操作错误,本操作当日不能超过{$value}次，请联系管理员!\"}";exit;}
}
?>