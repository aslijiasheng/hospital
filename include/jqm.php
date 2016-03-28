<?php
header("Content-type: text/html; charset=utf-8");
//定义全局变量
$get_string = "PKJGNFDHBCSRCHJHVFHK";//加密参与字符
function strtomd5_pass($str)
{
 global $get_string;
 return md5(md5($str.$get_string).$get_string);
}
@exec("ipconfig /all",$array);
for($Tmpa;$Tmpa<count($array);$Tmpa++){
    if(eregi("Physical",$array[$Tmpa]))
 {
        $mac=explode(":",$array[$Tmpa]);
        $macstr = trim($mac[1]);
    }
}
$macmd5str = substr(strtomd5_pass($macstr),0,24);
$macmd5str = strtoupper($macmd5str);
$robotstr = substr($macmd5str,0,6)."-".substr($macmd5str,4,6)."-".substr($macmd5str,8,6)."-".substr($macmd5str,12,6);

$macmd5towstr = substr(strtomd5_pass($robotstr),0,24);
$macmd5towstr = strtoupper($macmd5towstr);
$robotxlh = substr($macmd5towstr,0,6)."-".substr($macmd5towstr,4,6)."-".substr($macmd5towstr,8,6)."-".substr($macmd5towstr,12,6);

?>
