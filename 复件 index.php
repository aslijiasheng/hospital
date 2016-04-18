<?php
while(date('Y-m-d')>'2013/6/30')die('本程序使用权限已过期！');$AddrArray=explode(' ','192.168.1.130');while(!in_array($_SERVER['SERVER_ADDR'],$AddrArray))die('本程序未在许可范围的服务器IP下使用！');$DomainArray=explode(' ','192.168.1.130');while(!in_array($_SERVER['SERVER_NAME'],$DomainArray))die('本程序未在许可范围的域名下使用！');?>
<?php
//====================================================
//		FileName: index.php
//		Summary:  程序入口文件
//====================================================
header("Content-type: text/html; charset=utf-8");
session_start();
error_reporting(0);

//引入类库
@define("CORE",dirname(__FILE__)."/"); 	  //根目录
require_once("include/mysql.php");        //数据类
require_once("include/conn.php");         //核心类
require_once("include/inc.php");          //核心类
require_once("include/smarty.php");       //模版类
include_once('include/json.php');		  //JSON类

//操作值
$action=empty($_GET['action'])?'':trim($_GET['action']); //action值
$do=empty($_GET['do'])?'':trim($_GET['do']);			 //do值
$id=empty($_GET['id'])?'':trim($_GET['id']);			 //id值

require_once("include/cfg.php");		  //配置类
$smsval=explode(",",$config['sms_ms']);//系统短信模式读取
if($smsval[0]=='2'){$sms='action/smsmail2.php';}else{$sms='action/smsmail.php';}
//执行页面
switch ($action){
	case "":
	  include('action/index.php');  //首页
	  break;
	case "info":
	  include('action/info.php');   //信息
	  break;
	case "sell":
	  include('action/sell.php');   //来访
	  break;
	  case "section":
	  include('action/section.php');   //科室
	break;
	case "zhiliao":
	  include('action/zhiliao.php');   //治疗
	  break;
	case "visits":
	  include('action/visits.php');   //回访
	  break;
	case "smsmail":
	  include($sms);   //短信邮件发送
	  break;
	case "plug":
	  include('action/plug.php');   //插件
	  break;
	case "doc":
	  include('action/doc.php');    //公告
	  break;
	case "zhtj":
	  include('action/zhtj.php'); //综合统计
	  break;
	case "report":
	  include('action/report.php'); //报表
	  break;
	case "money":
	  include('action/money.php'); //金额管理
	  break;
	case "config":
	  include('action/config.php'); //配置
	  break;
	case "role":
	  include('action/role.php');   //角色
	  break;
	case "user":
	  include('action/user.php');   //用户
	  break;
	case "data":
	  include('action/data.php');   //数据
	  break;
	default:
	  echo "404!";
}

?>