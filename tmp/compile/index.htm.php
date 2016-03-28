<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<title><?php echo $this->_var['row']['webtitle']; ?><?php echo $this->_var['cfg']['edition']; ?></title>

<link href="themes/default/style.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="themes/ico.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="themes/css/core.css" rel="stylesheet" type="text/css" media="screen"/>
<link href="themes/css/print.css" rel="stylesheet" type="text/css" media="print"/>
<!--[if IE]>
<link href="themes/css/ieHack.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script src="javascripts/speedup.js" type="text/javascript"></script>
 <script src="javascripts/jquery-1.7.1.js" type="text/javascript"></script>
<script src="javascripts/jquery.cookie.js" type="text/javascript"></script>
<script src="javascripts/jquery.validate.js" type="text/javascript"></script>
<script src="javascripts/jquery.bgiframe.js" type="text/javascript"></script>

<script src="chajian/xheditor/xheditor-1.1.14-zh-cn.min.js" type="text/javascript"></script>
<script src="uploadify/scripts/swfobject.js" type="text/javascript"></script>
<script src="uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>

 <script src="bin/dwz.min.js" type="text/javascript"></script> 
  <script src="javascripts/dwz.regional.zh.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
	DWZ.init("dwz.frag.xml", {
//		loginUrl:"loginsub.html", loginTitle:"登录",	// 弹出登录对话框
		loginUrl:"login.html",	// 跳到登录页面
		statusCode:{ok:200, error:300, timeout:301}, //【可选】
		pageInfo:{pageNum:"pageNum", numPerPage:"numPerPage", orderField:"orderField", orderDirection:"orderDirection"}, //【可选】
		debug:false,	// 调试模式 【true|false】
		callback:function(){
			initEnv();
			$("#themeList").theme({themeBase:"themes"});
		}
	});
});
//清理浏览器内存,只对IE起效,FF不需要
if ($.browser.msie) {
	window.setInterval("CollectGarbage();", 10000);
}
</script>
 
<script language="javascript">
function download1()
{
document.form1.text1.value=ActiveXDown.bOpenUsb20Video(); 
return;
}
</script>

<script   language="JavaScript"   for="ActiveXDown"   Event="OnRecvBar">  
   document.form1.nt.value=ActiveXDown.sGetBarData(); 
</script>
 

</head>

<body  >

	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="javascript:void(0)"><img src="<?php echo $this->_var['row']['syslogo']; ?>" /></a>
				<ul class="nav">
					<li><a href="<?php echo $this->_var['row']['fzgj']; ?>" target="navTab" rel="page1"><b>辅助工具</b></a></li>
					<li><a href="#">用户:<?php echo $_SESSION['username']; ?></a></li>
					<li><a href="index.php?action=user&do=editpass" target="dialog">修改密码</a></li>
					<li><a href="index.php?action=user&do=logout">退出</a></li>
				</ul>
				<ul class="themeList" id="themeList">
					<li theme="default"><div class="selected">蓝色</div></li>
					<li theme="green"><div>绿色</div></li>
					<!--<li theme="red"><div>红色</div></li>-->
					<li theme="purple"><div>紫色</div></li>
					<li theme="silver"><div>银色</div></li>
					<li theme="azure"><div>天蓝</div></li>
				</ul>
			</div>
		</div>

		<div id="leftside">
			<div id="sidebar_s">
				<div class="collapse">
					<div class="toggleCollapse"><div></div></div>
				</div>
			</div>
			<div id="sidebar">
				<div class="toggleCollapse"><h2>主菜单</h2><div>收缩</div></div>

				<div class="accordion" fillSpace="sidebar">
					<div class="accordionHeader">
						<h2><span>Folder</span>常用操作</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder">
							
							<li><a>基础数据</a>
								<ul>								
									<li><a href="index.php?action=info" target="navTab" rel="info">客户信息</a></li>
									<li><a href="index.php?action=sell" target="navTab" rel="daoyuan">来访信息</a></li>
									<li><a >科室信息</a>
										<ul>
										<?php $_from = $this->_var['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_78125100_1366608130');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_78125100_1366608130']):
?>
											<li><a href="index.php?action=section&tid=<?php echo $this->_var['row_0_78125100_1366608130']['id']; ?>" target="navTab" rel="section"><?php echo $this->_var['row_0_78125100_1366608130']['title']; ?></a></li>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										</ul>
									</li>
									<li><a href="index.php?action=zhiliao" target="navTab" rel="zhiliao">现场咨询记录</a></li>
									<li><a href="?action=zhtj&do=list5" target="navTab" rel="member">会员记录</a></li>
									<li><a href="?action=plug&do=couponlist" target="navTab" rel="yhq">优惠券管理</a></li>
								</ul>
							</li>
							<li><a>办公管理</a>
								<ul>
									<li><a href="finder/browse.php" target="navTab" rel="share" external="true">文件共享</a></li>
									<li><a href="index.php?action=doc" target="navTab" rel="doc">公告文档</a></li>
								</ul>
							</li>
							<li><a>回访记录</a>
								<ul>
									<li><a href="index.php?action=visits" target="navTab" rel="visits">电话记录</a></li>
									<li><a href="?action=smsmail&do=s_list" target="navTab" rel="sms">短信记录</a></li>
									<li><a href="?action=smsmail&do=m_list" target="navTab" rel="mail">邮件记录</a></li>
								</ul>
							</li>
							<li><a>财务报表</a>
								<ul>
									<li><a href="?action=money&do=list2" target="navTab" rel="money">客户消费记录</a></li>
									<li><a href="index.php?action=money" target="navTab" rel="money">金额操作记录</a></li>
								</ul>
							</li>
							<li><a>综合统计</a>
								<ul>
									<li><a href="?action=zhtj&do=list1" target="navTab" rel="zhtj">已到院客户</a></li>
									<li><a href="?action=zhtj&do=list2" target="navTab" rel="zhtj">未到院客户</a></li>
									<li><a href="?action=zhtj&do=list3" target="navTab" rel="zhtj">到院已消费客户</a></li>
									<!--<li><a href="?action=zhtj&do=list4" target="navTab" rel="zhtj">到院未消费客户</a></li>-->
								</ul>
							</li>
							<li><a>统计报表</a>
								<ul>
									<li><a href="index.php?action=report&do=t1" target="navTab" rel="reportt1">区域统计表</a></li>
									<li><a href="index.php?action=report&do=t2" target="navTab" rel="reportt2">渠道统计表</a></li>
									<li><a href="index.php?action=report&do=t5" target="navTab" rel="reportt5">预约统计表</a></li>
									<li><a href="?action=zhtj&do=list6" target="navTab" rel="keyword">关键词统计</a></li>
								</ul>
							</li>
							
						</ul>
					</div>
					<?php if ($_SESSION['roleid'] == "1"): ?>	
					<div class="accordionHeader">
						<h2><span>Folder</span>系统管理</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder ">
							
							<li><a>11111配置管理</a>
								<ul>
									<li><a href="?action=config&do=sys" target="navTab" rel="sys">系统设置</a></li>
									<li><a href="index.php?action=config" target="navTab" rel="sys">基础配置</a></li>
									<li><a href="?action=config&do=sms" target="navTab" rel="sys">短信配置</a></li>
									<li><a href="?action=config&do=pricelist" target="navTab" rel="sys">价格设置</a></li>
								</ul>
							</li>
							 <li><a>用户管理</a>
								<ul>
									<li><a href="index.php?action=role" target="navTab" rel="role">用户组设定</a></li>
									<li><a href="index.php?action=user" target="navTab" rel="user">用户列表</a></li>
									<li><a href="?action=user&do=listzx" target="navTab" rel="userzx">执行人员</a></li>		
								</ul>
							</li>
							<li><a>数据管理</a>
								<ul>
									<li><a href="index.php?action=data&do=backup" target="navTab" rel="backup">数据备份</a></li>
									<li><a href="index.php?action=data&do=recover" target="navTab" rel="backup">数据下载</a></li>
									<li><a href="?action=data&do=export&id=1" target="dialog">数据导出</a></li>
								</ul>
							</li>
							<li><a href="?action=data&do=record&tid=" target="navTab" rel="record">日志文件</a></li>
						</ul>
					</div>
					<?php endif; ?>
					<div class="accordionHeader">
						<h2><span>Folder</span>使用教程</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder ">
							
							<li><a href="http://bbs.33c33.com/index.php/article/cate/id-1" target="navTab" rel="Course">基础教程</a>
						</ul>
					</div>
				</div>

			</div>
		</div>
		<div id="container">

			<div id="navTab" class="tabsPage">
				<div class="tabsPageHeader">
					<div class="tabsPageHeaderContent">
						<ul class="navTab-tab">
							<li tabid="main" class="main"><a href="javascript:void(0)"><span><span class="home_icon">我的主页</span></span></a></li>
						</ul>
					</div>
					<div class="tabsLeft">left</div>
					<div class="tabsRight">right</div>
					<div class="tabsMore">more</div>
				</div>
				<ul class="tabsMoreList">
					<li><a href="javascript:void(0)">主页</a></li>
				</ul>
				<div class="navTab-panel tabsPageContent layoutBox">
					<div class="page unitBox">
						<div class="accountInfo">
							<div class="alertInfo">
							<?php echo $this->_var['row']['sm']; ?>
							</div>
						</div>
						<div class="pageFormContent" layoutH="80" style="margin-right:20%">
						<style type="text/css">
						<!--
						ul.listgg{font-size:12px;padding:0;margin:0;}
						ul.listgg li {list-style:none;line-height:22px;}
						
						-->
						</style>
						<ul class="listgg">
							<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_78166700_1366608130');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_78166700_1366608130']):
?>
							<li><a style="<?php echo $this->_var['row_0_78166700_1366608130']['sx1']; ?><?php echo $this->_var['row_0_78166700_1366608130']['sx2']; ?><?php echo $this->_var['row_0_78166700_1366608130']['sx3']; ?>" href="?action=doc&do=show&id=<?php echo $this->_var['row_0_78166700_1366608130']['id']; ?>" target="navTab" rel="docsee"><?php echo $this->_var['row_0_78166700_1366608130']['title']; ?></a> /<?php echo $this->_var['row_0_78166700_1366608130']['salesid_txt']; ?> /<?php echo $this->_var['row_0_78166700_1366608130']['created_at']; ?></li>	
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
						</ul>
						<div class="divider">divider</div>
						<p>今日有<font style="color:#f00;" >(<?php echo $this->_var['row']['jryy']; ?>)</font>个预约客人可能到院；<a href="index.php?action=info&yyat=<?php echo $this->_var['row']['today']; ?>" target="navTab" rel="cue"> 》》查看</a></p>
						<p>昨天有<font style="color:#f00;" >(<?php echo $this->_var['row']['jrsms']; ?>)</font>条回复短信未处理；<a href="?action=smsmail&do=smshf&yesterday=<?php echo $this->_var['row']['yesterday']; ?>" target="navTab" rel="cue"> 》》查看</a></p>
						<p>今日有<font style="color:#f00;" >(<?php echo $this->_var['row']['jrvisits']; ?>)</font>个客户需要再回访；<a href="?action=visits&hfat=<?php echo $this->_var['row']['today']; ?>" target="navTab" rel="cue"> 》》查看</a></p>
						<p>今日有<font style="color:#f00;" >(<?php echo $this->_var['row']['jrzhiliao']; ?>)</font>个客户预约治疗（派单）；<a href="?action=zhiliao&zhiliaoat=<?php echo $this->_var['row']['today']; ?>" target="navTab" rel="cue"> 》》查看</a></p>
						</div>
						
						<div style="width:20%;position: absolute;top:60px;right:0" layoutH="80">
							<iframe width="98%" height="430" class="share_self"  frameborder="0" scrolling="no" src="?action=doc&do=chaxun1&id=5"></iframe>
						</div>
					</div>
					
				</div>
						</div>
					</div>
					
				</div>
				
			</div>
		</div>

		<div id="taskbar" style="left:0px; display:none;">
			<div class="taskbarContent">
				<ul></ul>
			</div>
			<div class="taskbarLeft taskbarLeftDisabled" style="display:none;">taskbarLeft</div>
			<div class="taskbarRight" style="display:none;">taskbarRight</div>
		</div>
		<div id="splitBar"></div>
		<div id="splitBarProxy"></div>
	</div>

	<div id="footer">
	
	<a class="button" href="?action=plug&do=publicshow&src=<?php echo $this->_var['row']['mapsrc']; ?>" target="dialog" rel="page1" max="true" ><span>地图查找1</span></a>
	<a class="button" href="tpl/price/price_search.htm" target="dialog" rel="price" height="160" ><span>价格查询</span></a>
	<a class="button" href="?action=plug&do=publicshow&src=http://xiuxiu.web.meitu.com/?xiuxiu" target="dialog" rel="page2" max="true" ><span>美图秀秀</span></a>
	<a class="button" href="?action=zhtj&do=cue_yy" target="dialog" rel="yj"  ><span>预计</span></a>
	<?php echo $this->_var['row']['webtitle']; ?></div>


	<div class="resizable"></div>

	<div class="shadow" style="width:508px; top:148px; left:296px;">
		<div class="shadow_h">
			<div class="shadow_h_l"></div>
			<div class="shadow_h_r"></div>
			<div class="shadow_h_c"></div>
		</div>
		<div class="shadow_c">
			<div class="shadow_c_l" style="height:296px;"></div>
			<div class="shadow_c_r" style="height:296px;"></div>
			<div class="shadow_c_c" style="height:296px;"></div>
		</div>
		<div class="shadow_f">
			<div class="shadow_f_l"></div>
			<div class="shadow_f_r"></div>
			<div class="shadow_f_c"></div>
		</div>
	</div>
	
	<div id="alertBackground" class="alertBackground"></div>
	<div id="dialogBackground" class="dialogBackground"></div>

	<div id='background' class='background'></div>
	<div id='progressBar' class='progressBar'>数据加载中，请稍等...</div>
</body>
</html>
