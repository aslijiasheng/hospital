-- MySQL dump 10.16  Distrib 10.1.12-MariaDB, for osx10.11 (x86_64)
--
-- Host: localhost    Database: kskf
-- ------------------------------------------------------
-- Server version	10.1.9-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cs_config`
--

DROP TABLE IF EXISTS `cs_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL COMMENT '描述',
  `value` text NOT NULL COMMENT '值',
  `value2` text,
  `type` varchar(20) NOT NULL,
  `intro` text NOT NULL COMMENT '说明',
  `varname` varchar(50) NOT NULL COMMENT '名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_doc`
--

DROP TABLE IF EXISTS `cs_doc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_doc` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '标题',
  `doctid` int(11) NOT NULL COMMENT '类型ID',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '内容',
  `salesid` int(11) NOT NULL COMMENT '发布人id',
  `sx` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '属性',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新日期',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_doc_reply`
--

DROP TABLE IF EXISTS `cs_doc_reply`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_doc_reply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `title_r` text CHARACTER SET utf8 NOT NULL COMMENT '标题',
  `docid` int(11) NOT NULL COMMENT '主题ID',
  `intro_r` text CHARACTER SET utf8 NOT NULL COMMENT '回复内容',
  `salesid` int(11) NOT NULL COMMENT '发布人id',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_info`
--

DROP TABLE IF EXISTS `cs_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(60) NOT NULL COMMENT '客户名称',
  `xb` varchar(10) NOT NULL COMMENT '客户性别',
  `nl` varchar(10) NOT NULL COMMENT '年龄',
  `address` varchar(60) NOT NULL COMMENT '客户地址',
  `qq` int(11) NOT NULL COMMENT 'QQ号',
  `tel` varchar(60) NOT NULL COMMENT '客户电话',
  `mail` varchar(60) NOT NULL COMMENT '客户邮箱',
  `Identity` varchar(60) NOT NULL COMMENT '身份证号',
  `card` varchar(60) NOT NULL COMMENT '会员卡号',
  `clerk` int(11) NOT NULL COMMENT '数量',
  `areaid` int(11) NOT NULL COMMENT '地区',
  `salesid` int(11) NOT NULL COMMENT '销售',
  `levelid` int(11) NOT NULL COMMENT '客户级别',
  `typeid` int(11) NOT NULL COMMENT '客户类型',
  `parentid` int(11) NOT NULL COMMENT '上级渠道',
  `productid` varchar(200) NOT NULL COMMENT '登记产品',
  `doctorid` varchar(200) NOT NULL COMMENT '预约医生',
  `zxxm` varchar(60) NOT NULL COMMENT '整形项目',
  `visitnum` int(11) NOT NULL COMMENT '拜访次数',
  `zlnum` int(11) NOT NULL COMMENT '治疗次数',
  `hfnum` int(11) NOT NULL COMMENT '回访次数',
  `intro` text NOT NULL COMMENT '备注',
  `yy_at` varchar(20) NOT NULL COMMENT '预约时间',
  `money` varchar(20) NOT NULL COMMENT '余额',
  `moneyqf` int(11) NOT NULL COMMENT '欠费信息',
  `keyword` varchar(60) NOT NULL COMMENT '关键词',
  `word` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17685 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_jqcalendar`
--

DROP TABLE IF EXISTS `cs_jqcalendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_jqcalendar` (
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
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_log`
--

DROP TABLE IF EXISTS `cs_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_log` (
  `id` int(21) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `infoid` int(11) DEFAULT NULL,
  `salesid` int(11) NOT NULL,
  `type` int(10) DEFAULT NULL,
  `intro` text NOT NULL COMMENT '内容',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7373 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_mail`
--

DROP TABLE IF EXISTS `cs_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `infoid` int(11) NOT NULL COMMENT '客户id',
  `salesid10` int(11) NOT NULL COMMENT '操作人id',
  `title` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '标题',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '邮件内容',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_meirong`
--

DROP TABLE IF EXISTS `cs_meirong`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_meirong` (
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `sellid` int(11) NOT NULL COMMENT '就诊ID',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '拜访描述',
  `zdjg` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '诊断结果',
  `zlff` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '治疗方法',
  `zlcs` int(11) NOT NULL COMMENT '治疗次数',
  `zzys` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '主治医生id',
  `zxr` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '执行人',
  `created_at` date NOT NULL,
  `salesid_mr` int(11) NOT NULL COMMENT '操作人ID',
  `typeid` int(11) NOT NULL DEFAULT '11'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_message`
--

DROP TABLE IF EXISTS `cs_message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_message` (
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
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_money`
--

DROP TABLE IF EXISTS `cs_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '拜访ID',
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `sellid` int(11) NOT NULL COMMENT '拜访id',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '拜访描述',
  `money_ss` int(11) NOT NULL COMMENT '本次销量',
  `yepay` int(11) NOT NULL COMMENT '余额消费',
  `money_qf` int(11) NOT NULL COMMENT '欠费金额',
  `money_hk` int(11) NOT NULL COMMENT '还款金额',
  `created_at` date NOT NULL,
  `salesid3` int(11) NOT NULL COMMENT '用户ID',
  `money_ad` int(11) NOT NULL COMMENT '充值',
  `money_all` int(11) NOT NULL COMMENT '余额',
  `money_dj` int(11) NOT NULL COMMENT '定金',
  `money_tk` int(11) NOT NULL COMMENT '退款',
  `money_tk2` int(11) NOT NULL COMMENT '账户退款',
  `integ` int(11) NOT NULL COMMENT '积分消费',
  `zuofei` int(11) NOT NULL COMMENT '作废',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3934 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_price`
--

DROP TABLE IF EXISTS `cs_price`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_price` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `item` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '项目',
  `price` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '价格',
  `typeid` int(11) NOT NULL COMMENT '类型ID',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '内容',
  `word` varchar(500) DEFAULT NULL,
  `created_at` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=324 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_role`
--

DROP TABLE IF EXISTS `cs_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `action` varchar(1500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_section`
--

DROP TABLE IF EXISTS `cs_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '美容id',
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `sellid` int(11) NOT NULL COMMENT '就诊ID',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '拜访描述',
  `zdjg` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '诊断结果',
  `zlff` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '治疗方法',
  `zlcs` int(11) NOT NULL COMMENT '治疗次数',
  `zzys` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '主治医生id',
  `zxr` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '执行人',
  `created_at` date NOT NULL,
  `salesid_ks` int(11) NOT NULL COMMENT '操作人ID',
  `typeid` int(11) NOT NULL DEFAULT '11' COMMENT '科室类型',
  `zlid` varchar(10) NOT NULL COMMENT '治疗id',
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20392 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_sell`
--

DROP TABLE IF EXISTS `cs_sell`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_sell` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '拜访ID',
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '拜访描述',
  `productid` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '科室选择',
  `doctorid` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '医生选择',
  `item` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `money_ss` int(11) NOT NULL COMMENT '收款金额',
  `money_qf` int(11) NOT NULL COMMENT '欠费金额',
  `yepay` int(11) NOT NULL COMMENT '余额支付',
  `money_tk` int(11) NOT NULL COMMENT '退款',
  `integ` int(11) NOT NULL COMMENT '积分消费',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `salesid2` int(11) NOT NULL COMMENT '用户ID',
  `fz` int(11) NOT NULL DEFAULT '3' COMMENT '复诊',
  `tp` text CHARACTER SET utf8 NOT NULL COMMENT '图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28810 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_sms_intro`
--

DROP TABLE IF EXISTS `cs_sms_intro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_sms_intro` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '内容',
  `typeid` int(11) NOT NULL DEFAULT '0' COMMENT '栏目id',
  `userid` int(11) NOT NULL COMMENT '创建人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_type`
--

DROP TABLE IF EXISTS `cs_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `xs` int(11) NOT NULL DEFAULT '0' COMMENT '是否显示',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=98 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_type_alone`
--

DROP TABLE IF EXISTS `cs_type_alone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_type_alone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `type` varchar(20) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_type_smsmail`
--

DROP TABLE IF EXISTS `cs_type_smsmail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_type_smsmail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `type` varchar(20) NOT NULL,
  `userid` int(11) NOT NULL COMMENT '创建人id',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_user`
--

DROP TABLE IF EXISTS `cs_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `roleid` int(11) NOT NULL,
  `free` int(11) NOT NULL DEFAULT '0' COMMENT '冻结账号',
  `tel` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `active` int(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_user_zx`
--

DROP TABLE IF EXISTS `cs_user_zx`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_user_zx` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `zxname` varchar(60) NOT NULL,
  `typeid` int(11) NOT NULL,
  `free` int(11) NOT NULL DEFAULT '0' COMMENT '冻结账号',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_visits`
--

DROP TABLE IF EXISTS `cs_visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '拜访ID',
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '拜访描述',
  `pingjia` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '评价',
  `created_at` date NOT NULL,
  `type` int(10) DEFAULT '0',
  `salesid5` int(11) NOT NULL COMMENT '回访人ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20664 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_yhq`
--

DROP TABLE IF EXISTS `cs_yhq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_yhq` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `infoid` int(11) NOT NULL COMMENT '客户id',
  `salesid_yhq` int(11) NOT NULL COMMENT '发信人id',
  `salesid_czr` int(11) NOT NULL COMMENT '操作人',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '邮件内容',
  `tel` text NOT NULL COMMENT '手机号',
  `lx` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '类型',
  `yhq` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '优惠券号',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '使用时间',
  `expire_at` datetime NOT NULL COMMENT '到期时间',
  `handle` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_yhq2`
--

DROP TABLE IF EXISTS `cs_yhq2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_yhq2` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `infoid` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '客户id',
  `salesid_yhq` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '发信人id',
  `salesid_czr` int(11) NOT NULL COMMENT '操作人',
  `tel` text NOT NULL COMMENT '手机号',
  `lx` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '类型',
  `yhq` varchar(60) CHARACTER SET utf8 NOT NULL COMMENT '优惠券号',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `expire_at` datetime NOT NULL COMMENT '到期时间',
  `intro` text CHARACTER SET utf8 NOT NULL,
  `handle` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_zhengxing`
--

DROP TABLE IF EXISTS `cs_zhengxing`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_zhengxing` (
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `sellid` int(11) NOT NULL COMMENT '就诊ID',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '拜访描述',
  `zdjg` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '诊断结果',
  `zlff` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '治疗方法',
  `zlcs` int(11) NOT NULL COMMENT '治疗次数',
  `zzys` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '主治医生id',
  `zxr` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '执行人',
  `created_at` date NOT NULL,
  `salesid_mr` int(11) NOT NULL COMMENT '操作人ID',
  `typeid` int(11) NOT NULL DEFAULT '12'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_zhiliao`
--

DROP TABLE IF EXISTS `cs_zhiliao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_zhiliao` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '拜访ID',
  `infoid` int(11) NOT NULL COMMENT '拜访客户',
  `sellid` int(11) NOT NULL COMMENT '来访ID',
  `intro` text CHARACTER SET utf8 NOT NULL COMMENT '拜访描述',
  `intro2` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '派单备注',
  `productid` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '科室选择',
  `doctorid` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '医生选择',
  `zxxm` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '整形项目',
  `created_at` date NOT NULL,
  `zhiliao_at` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '派单治疗时间',
  `updated_at` datetime NOT NULL,
  `salesid` int(11) NOT NULL COMMENT '派单人ID',
  `state` int(11) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7308 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `cs_zhiliao_pd`
--

DROP TABLE IF EXISTS `cs_zhiliao_pd`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cs_zhiliao_pd` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文档ID',
  `infoid` int(20) NOT NULL COMMENT '客户ID',
  `sellid` int(20) NOT NULL COMMENT '来访id',
  `title` varchar(200) CHARACTER SET utf8 NOT NULL COMMENT '标题',
  `salesid` int(11) NOT NULL COMMENT '发布人id',
  `pdid` int(20) NOT NULL COMMENT '派单id',
  `num` int(10) NOT NULL DEFAULT '1' COMMENT '疗程次数',
  `num_z` int(10) NOT NULL COMMENT '已治疗次数',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5376 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `msg_failedbox`
--

DROP TABLE IF EXISTS `msg_failedbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg_failedbox` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `OriginMsgID` int(4) NOT NULL,
  `ExpressLevel` int(4) NOT NULL,
  `Sender` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Receiver` varchar(200) CHARACTER SET utf8 NOT NULL,
  `MsgType` int(4) NOT NULL,
  `MsgTitle` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `MMSContentLocation` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `SendTime` datetime NOT NULL,
  `CommPort` int(4) NOT NULL,
  `ActualSendTime` datetime NOT NULL,
  `FailedReason` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PRIMARY_MSG_FAILEDBOX` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=413 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `msg_inbox`
--

DROP TABLE IF EXISTS `msg_inbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg_inbox` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `Sender` varchar(100) CHARACTER SET utf8 NOT NULL,
  `MsgType` int(4) NOT NULL,
  `MsgTitle` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `MMSUrl` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `MMSContentLocation` varchar(5000) CHARACTER SET utf8 DEFAULT NULL,
  `MsgArrivedTime` datetime NOT NULL,
  `MMSDownloadedTime` datetime DEFAULT NULL,
  `MMSDownloadedState` int(4) NOT NULL DEFAULT '0',
  `CommPort` int(4) NOT NULL,
  `handle` varchar(11) CHARACTER SET utf8 NOT NULL DEFAULT '0' COMMENT '处理',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PRIMARY_MSG_INBOX` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3954 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `msg_outbox`
--

DROP TABLE IF EXISTS `msg_outbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg_outbox` (
  `MsgID` int(4) NOT NULL AUTO_INCREMENT,
  `ExpressLevel` int(4) NOT NULL DEFAULT '2',
  `Sender` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Receiver` varchar(200) CHARACTER SET utf8 NOT NULL,
  `MsgType` int(4) NOT NULL DEFAULT '1',
  `MsgTitle` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `MMSContentLocation` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `SendTime` datetime NOT NULL,
  `CommPort` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`MsgID`),
  UNIQUE KEY `PRIMARY_MSG_OUTBOX` (`MsgID`)
) ENGINE=MyISAM AUTO_INCREMENT=17399 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `msg_sentbox`
--

DROP TABLE IF EXISTS `msg_sentbox`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `msg_sentbox` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `OriginMsgID` int(4) NOT NULL,
  `ExpressLevel` int(4) NOT NULL,
  `Sender` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `Receiver` varchar(200) CHARACTER SET utf8 NOT NULL,
  `MsgType` int(4) NOT NULL,
  `MsgTitle` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `MMSContentLocation` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `SendTime` datetime NOT NULL,
  `CommPort` int(4) NOT NULL,
  `ActualSendTime` datetime NOT NULL,
  `ReceiveMMSTime` datetime DEFAULT NULL,
  `MMSMessageID` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `PRIMARY_MSG_SENTBOX` (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17765 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-07 19:53:23
