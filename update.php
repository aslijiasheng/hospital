<?php
header("Content-type: text/html; charset=utf-8");
@define("CORE",dirname(__FILE__)."/"); 	  //根目录
require_once("include/mysql.php");        //数据类
require_once("include/conn.php");         //核心类
require_once("include/inc.php");          //核心类
require_once("include/pinyin.php");		  //拼音
set_time_limit(0);
if(empty($cs)){$cs = "";echo "1,<a href=\"update.php?cs=date\" target=\"_blank\">升级数据库》》</a></br>2,<a href=\"update.php?cs=py\" target=\"_blank\">更新拼音库，可以拼音简写搜索》》</a>";exit;}
if($cs=='py'){
echo "<font style=\"color:#f00;\"> 开始更新^-^，，</font></br>";
sleep(2);
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
echo "</br><font style=\"color:#f00;\">价格拼音库更新完毕-------请勿关闭浏览器--正在更新客户拼音库(数据多的速度很慢，耐心等候)</font></br>";
print str_pad("",10000);
sleep(3);
	$sql2="SELECT id,name FROM `cs_info` order by id";
	$db->query($sql2);
	$list=$db->fetchAll();
	foreach($list as $key=>$val){
		$name=$list[$key][name];
		$py=iconv("utf-8","gbk",$name);
		$word=$PingYing->getFirstPY($py)." ".$PingYing->getAllPY($py);
		$sql2a="UPDATE `cs_info` SET  `word` = '$word' where `cs_info`.`name`='$name'";
		$db->query($sql2a);
		echo $list[$key][name].$list[$key][id]."----生成</br>";
		print str_pad("...",1000);
	}
	

	echo "</br><font style=\"color:#f00;\">拼音库更新完毕-------</font></br>现在可以关闭浏览器了，谢谢使用蜜桃客户系统";
print str_pad("",10000);
exit;
}
if($cs=='date'){
echo "</br><font style=\"color:#f00;\">开始升级数据库-------请勿关闭浏览器--升级完毕后请删除update.php文件</font></br>";
print str_pad("",10000);
sleep(2);
$date="
alter table `cs_info` add `word` varchar(100) DEFAULT NULL after keyword;;
alter table `cs_sell` add `item` varchar(200) CHARACTER SET utf8 DEFAULT NULL after 
doctorid;;
UPDATE `cs_sell` set `fz` = '3' WHERE fz='0';;
alter table `cs_sell` alter `fz` set default '3';;

CREATE TABLE IF NOT EXISTS `cs_jqcalendar` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Subject` varchar(1000) DEFAULT NULL COMMENT '日程标题',
  `Location` varchar(200) DEFAULT NULL COMMENT '地点',
  `title` varchar(500) DEFAULT NULL,
  `Description` text COMMENT '描述',
  `StartTime` datetime DEFAULT NULL COMMENT '开始时间',
  `EndTime` datetime DEFAULT NULL COMMENT '结束时间',
  `IsAllDayEvent` smallint(6) NOT NULL COMMENT '是否全天日程',
  `Color` varchar(200) DEFAULT NULL COMMENT '日程颜色',
  `RecurringRule` varchar(500) DEFAULT NULL COMMENT '循环规则',
  `upsalesid` int(11) NOT NULL COMMENT '更新人id',
  `levelid` int(10) DEFAULT NULL,
  `style` int(10) NOT NULL DEFAULT '0',
  `score1` int(10) DEFAULT NULL COMMENT '评分',
  `score2` int(10) DEFAULT NULL COMMENT '评分',
  `state` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=93 ;;

CREATE TABLE IF NOT EXISTS `cs_log` (
  `id` int(21) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `infoid` int(11) DEFAULT NULL,
  `salesid` int(11) NOT NULL,
  `type` int(10) DEFAULT NULL,
  `intro` text NOT NULL COMMENT '内容',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=107 ;;

CREATE TABLE IF NOT EXISTS `cs_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `tid` int(20) NOT NULL DEFAULT '0',
  `sender` int(11) NOT NULL DEFAULT '0' COMMENT '客户id',
  `address` varchar(11) CHARACTER SET latin1 NOT NULL DEFAULT '0' COMMENT '收件人id',
  `intro` varchar(500) NOT NULL COMMENT '邮件内容',
  `type` int(5) NOT NULL DEFAULT '1',
  `isread` longtext NOT NULL,
  `isdel` longtext CHARACTER SET latin1 NOT NULL,
  `created_at` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;;

alter table `cs_user` add  `tel` varchar(50) DEFAULT NULL after free;;
alter table `cs_user` add  `active` int(20) DEFAULT NULL after updated_at;;
INSERT INTO `cs_user` (`id`, `username`, `password`, `roleid`, `free`, `tel`, `created_at`, `updated_at`) VALUES(99, '公共', '', 0, 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');;
alter table `cs_price` add  `word` varchar(500) DEFAULT NULL after intro;;

alter table `cs_config` add  `value2` text after value;;
UPDATE `cs_config` set `value` = '#{mt:id}#{mt:name}:网站：http://www.33c33.com/' WHERE varname='sms_ewm';;

INSERT INTO `cs_config` (`id`, `title`, `value`, `value2`, `type`, `intro`, `varname`) VALUES
(17, '挂号打印单设置', '5|0|5|0|||0', '<style type=\"text/css\"><!--\r\n*{padding:0;margin:0;font-size:12px;}\r\n#print{width: 453px;height: 286px;position:relative;overflow:hidden;}\r\n.info{position:absolute;width: 290px;height: 115px;top:115px;left:45px;}\r\nimg{float:left;border:0;}\r\n.ewm{width: 60px;height: 60px;position:absolute;left:340px;top:155px;z-index:5;}\r\n--></style><div id=\"print\"><img alt=\"\" src=\"images/gh.png\" /><img class=\"ewm\" title=\"二维码\" alt=\"\" src=\"{mt:ewm}\" /><div class=\"info\"><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=\"290\" height=\"113\"><tbody><tr height=\"18\"><td width=\"70\">就诊号码：</td><td width=\"70\">{mt:id}</td><td width=\"70\">&nbsp;</td><td width=\"70\">&nbsp;</td></tr><tr height=\"18\"><td>姓&nbsp;&nbsp;名：</td><td>{mt:name}</td><td>姓&nbsp;&nbsp;别：</td><td>{mt:sex}</td></tr><tr height=\"18\"><td>年&nbsp;&nbsp;龄：</td><td>{mt:age}</td><td>联系电话：</td><td>{mt:tel}</td></tr><tr height=\"18\"><td>挂号日期：</td><td colspan=\"3\">{mt:time_cn}</td></tr></tbody></table></div></div>', 'print', '<h3>参数说明：</h3>\r\n就诊号：{mt:id}<br/>\r\n预约号：{mt:infoid}<br/>\r\n客户姓名：{mt:name}<br/>\r\n客户电话：{mt:tel}<br/>\r\n客户年龄：{mt:age}<br/>\r\n客户性别：{mt:sex}<br/>\r\n初复诊：{mt:fz}<br/>\r\n挂号时间：{mt:time_cn}<br/>\r\n挂号项目：{mt:item}<br/>\r\n操作人：{mt:user}<br/>\r\n登记人：{mt:user2}<br/>\r\n渠道来源：{mt:canal}<br/>\r\n会员级别：{mt:vip}<br/>\r\n科室：{mt:department}<br/>\r\n医生：{mt:doctor}<br/>\r\n二维码地址：{mt:ewm}', 'printsell'),
(18, '限制用户每天可以对客户修改操作的次数', '6', '', 'o_limit', '限制用户每天可以对客户的修改次数，达到次数后就不能修改了，写数字就可以了', 'limit_info_edit'),
(19, '限制用户每天可以对客户删除操作的次数', '2', '', 'o_limit', '限制用户每天可以对客户删除操作的次数，操作次数超过后，当天就不能操作了，写数字就可以了。', 'limit_info_del');;

alter table `cs_visits` drop visits_at;;
alter table `cs_visits` add `type` int(10) DEFAULT '0' after created_at;;";
$dates = explode(';;', $date);
foreach($dates as $val){
			if($val){
			$db->query($val);
			}
		}
sleep(2);
echo "</br><font style=\"color:#f00;\">数据库升级完毕----谢谢使用蜜桃客户系统</font>";
print str_pad("",10000);
echo "</br><font style=\"color:#f00;\"> <a href=\"update.php?cs=py\" target=\"_blank\">需要更新拼音库的点这里》》</a>--更新后客服表可以按拼音简写搜索--数据量大的会很久，耐心等候^-^，，</font></br>";
print str_pad("",10000);

exit;}
?>