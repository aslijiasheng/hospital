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
<script src="javascripts/jquery.SuperSlide.2.1.js"  type="text/javascript"></script>
<script src="chajian/xheditor/xheditor-1.1.14-zh-cn.min.js" type="text/javascript"></script>
<script src="uploadify/scripts/swfobject.js" type="text/javascript"></script>
<script src="uploadify/scripts/jquery.uploadify.v2.1.0.js" type="text/javascript"></script>

 <script src="bin/dwz.min.js" type="text/javascript"></script> 
  <script src="javascripts/dwz.regional.zh.js" type="text/javascript"></script>
  <script src="javascripts/dwz.database.js" type="text/javascript"></script>
  
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
//关闭页面提示
if ($.browser.msie) {
	window.setInterval("CollectGarbage();", 10000);
}
    window.onbeforeunload = function (e) {
        e = e || window.event;
        var y = e.clientY
        if (y <= 0
        || y >= Math.max(document.body.clientHeight, document.documentElement.clientHeight)
        )
            e.returnValue = "你唠叨确认关闭浏览器窗口？！！";
    }
</script>


</head>

<body  >
<style type="text/css">
<!--
.nLi{position:relative; z-index:1;}
.sub1 div{background:#fff;height: 25px;color:#999;}
.sub1 div a{height: 25px;width:104px;display:block;line-height:25px;padding:0 8px;}
.sub1 div a span{float:right;display:block;width: 12px;height: 12px;margin-top:7px;}
.sub1 div a:hover{background:#f5f5f5;text-decoration:none;}
-->
</style>
	<div id="layout">
		<div id="header">
			<div class="headerNav">
				<a class="logo" href="javascript:void(0)"><img src="<?php echo $this->_var['row']['syslogo']; ?>" /></a>
				<ul class="nav">
					<li><a href="<?php echo $this->_var['row']['fzgj']; ?>" target="navTab" rel="page1"><b>辅助工具</b></a></li>
					<li class="nLi" ><a href="javascript:" >用户:<?php echo $_SESSION['username']; ?></a>
						<ul class="sub1" style="left:-38px; top:12px;  position:absolute;border:none;width:120px;background:transparent;padding-top:10px;">
							<div style="margin-top:5px;"><a style="line-height:25px;color:#999;" href="index.php?action=user&do=editpass&id=<?php echo $_SESSION['userid']; ?>" target="dialog"><span class="useredit"></span>用户设置</a></div>
							<div><a href="index.php?action=user&do=logout" style="line-height:25px;color:#999;"><span class="userlogout"></span>退出</a></div>
						</ul>
					</li>
					<li ><a href="index.php?action=smsmail&do=messlist" target="navTab" rel="messlist">消息</a></li>
					<li class="nLi"><a href="javascript:">帮助？</a>
						<ul class="sub1" style="left:-65px; top:12px;  position:absolute;border:none;width:120px;background:transparent;padding-top:10px;">
							<div style="margin-top:5px;"><a style="line-height:25px;color:#999;" href="http://bbs.33c33.com/index.php/article/cate/id-1" target="navTab" rel="help"><span class="jiaocheng"></span>使用教程</a></div>
							<div><a style="line-height:25px;color:#999;" href="http://www.33c33.com/?post=39" target="navTab" rel="help"><span class="shengji"></span>系统升级</a></div>
							<div><a style="line-height:25px;color:#999;" href="http://bbs.33c33.com/index.php/group/show/id-2" target="navTab" rel="help"><span class="wenti"></span>问题反馈</a></div>
						</ul>
					</li>
					
					<li ><a href="index.php?action=user&do=logout">退出</a></li>
				</ul>
				<script  type="text/javascript">
				jQuery(".nav").slide({type:"menu",titCell:".nLi", targetCell:".sub1", effect:"slideDown", delayTime:300 ,triggerTime:0, returnDefault:false});
				</script>
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
									<li><a href="index.php?action=info" target="navTab" rel="info">我的客户</a></li>
									<li><a href="index.php?action=sell" target="navTab" rel="sell">挂号信息</a></li>
									<li><a >科室信息</a>
										<ul>
										<?php $_from = $this->_var['list2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_36826400_1393741923');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_36826400_1393741923']):
?>
											<li><a href="index.php?action=section&tid=<?php echo $this->_var['row_0_36826400_1393741923']['id']; ?>" target="navTab" rel="section"><?php echo $this->_var['row_0_36826400_1393741923']['title']; ?></a></li>
										<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
										</ul>
									</li>
									<li><a href="index.php?action=info&list=public" target="navTab" rel="public">公共客户</a></li>
									<li><a href="index.php?action=zhiliao" target="navTab" rel="zhiliao">现场咨询记录</a></li>
									<li><a href="?action=zhtj&do=list5" target="navTab" rel="member">会员记录</a></li>
									<li><a href="?action=plug&do=couponlist" target="navTab" rel="yhq">优惠券管理</a></li>
								</ul>
							</li>
							<li><a>办公管理</a>
								<ul>
									<li><a href="index.php?action=doc" target="navTab" rel="doc">公告文档</a></li>
									<li><a href="?action=doc&do=work&view=me" target="navTab" rel="work" >工作报告</a></li>
									<li><a href="index.php?action=smsmail&do=messlist" target="navTab" rel="messlist" >我的消息</a></li>
								</ul>
							</li>
							<li><a>回访记录</a>
								<ul>
									<li><a href="index.php?action=visits&type=0" target="navTab" rel="visits">电话记录</a></li>
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
									<li><a href="index.php?action=zhtj&do=list6" target="navTab" rel="keyword">关键词统计</a></li>
									<li><a href="index.php?action=zhtj&do=list7" target="navTab" rel="zlxm">预约项目统计</a></li>
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
							
							<li><a>配置管理</a>
								<ul>
									<li><a href="?action=config&do=sys" target="navTab" rel="sys">系统设置</a></li>
									<li><a href="index.php?action=config" target="navTab" rel="config">基础配置</a></li>
									<li><a href="index.php??action=config&do=sms" target="navTab" rel="sys">短信配置</a></li>
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
							<li><a href="?action=data&do=record&tid=" target="navTab" rel="record">日志&缓存</a></li>
							<li><a href="?action=info&do=log" target="navTab" rel="log">客户操作日志</a></li>
						</ul>
					</div>
					<?php endif; ?>
					<div class="accordionHeader">
						<h2><span>Folder</span>使用教程</h2>
					</div>
					<div class="accordionContent">
						<ul class="tree treeFolder ">
							
							<li><a href="http://www.33c33.com/main" target="navTab" rel="Course">基础教程</a>
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
							<li tabid="main" class="main"><a href="javascript:void(0)"><span><span class="home_icon">我的工作台</span></span></a></li>
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
						<div class="pageFormContent" layoutH="20" >
						<style type="text/css">
						<!--
						.richeng{float:left;width: 62%;margin-right:15px;position:relative;height: 432px;}
						.richeng a.work{position:absolute;display:block;width: 100px;top:5px;right:0;}
						.bj_rt{float:left;width: 33%;}
						.box{border:1px solid #B8D0D6;padding:5px;}
						.gg{margin-top:15px;}
						.box ul,.box li{list-style:none;padding:0;margin:0;}
						.box li{}
						.box li a.bt{font-weight:bold;text-indent:5px;padding-top:10px;display:block;}
						.box h2{height:35px;font-size:14px;font-weight:bold;line-height:35px;text-indent:35px;background:url(images/cs_tb.png) 4px 4px no-repeat;}
						.box h2.b2{background-position:4px -32px;}
						.box .zz{color:#767467;height: 30px;line-height:30px;text-indent:15px;}
						.box .qt{height: 30px;line-height:30px;border-top:1px solid #eee;position:relative;text-indent:10px;}
						.qt .prev,.qt .next{display:block;  width:9px; height:5px; overflow:hidden; cursor:pointer; background:url(images/cs_tb.png) -9px -312px no-repeat;position:absolute;top:15px;right:19px;}
						.qt .next{background-position:0 -312px;top:15px;right:10px;}
						.tx{padding-bottom:15px;}
						.qt .pageState{position:absolute;right:35px;top:12px;}
						.tx li{height: 28px;line-height:28px;padding-top:3px;font-weight:bold;margin-left:5px;border-bottom:1px solid #eee;background:url(images/cs_tb.png) no-repeat;text-indent:10px;}
						.tx li.l1{color:#ff3131;background-position:0 -117px;}
						.tx li.l2{color:#008000;background-position:0 -156px;}
						.tx li.l3{color:#005097;background-position:0 -195px;}
						.tx li.l4{color:#000;background-position:0 -275px;}
						.tx li a{color:#767467;font-size:12px;font-weight:400;}
						.box .info{text-indent:2em;color:#005097;margin:10px 15px 0 15px;line-height:22px;height: 85px;overflow:hidden;}
						-->
						</style>
						<div class="richeng"><a href="?action=doc&do=work_new" target="dialog" height="400" width="600" class="work">新建工作报告</a><iframe width="100%" height="432"  frameborder="0" scrolling="no" src="wdCalendar/"></iframe></div>
						<div class="bj_rt">
								<div class="box tx"><h2 class="b2">便捷提醒111111：</h2>
								<li class="l1">今日有<font style="color:#f00;" >(<?php echo $this->_var['row']['jryy']; ?>)</font>个预约客人可能到院；<a href="index.php?action=info&yyat=<?php echo $this->_var['row']['today']; ?>" target="navTab" rel="cue"> 》》查看</a></li>
								<li class="l2" >昨天有<font style="color:#f00;" >(<?php echo $this->_var['row']['jrsms']; ?>)</font>条回复短信未处理；<a href="?action=smsmail&do=smshf&yesterday=<?php echo $this->_var['row']['yesterday']; ?>" target="navTab" rel="cue"> 》》查看</a></li>
								<li class="l3" >今日有<font style="color:#f00;" >(<?php echo $this->_var['row']['jrvisits']; ?>)</font>个客户需要再回访；<a href="?action=visits&type=1&hfat=<?php echo $this->_var['row']['today']; ?>" target="navTab" rel="cue"> 》》查看</a></li>
								<li class="l4" >今日有<font style="color:#f00;" >(<?php echo $this->_var['row']['jrzhiliao']; ?>)</font>个客户预约治疗（派单）；<a href="?action=zhiliao&zhiliaoat=<?php echo $this->_var['row']['today']; ?>" target="navTab" rel="cue"> 》》查看</a></li>
								</div>

								<div class="box gg" ><h2>公告：</h2>
								    <ul class="listgg">
							<?php $_from = $this->_var['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'row_0_36945100_1393741923');if (count($_from)):
    foreach ($_from AS $this->_var['row_0_36945100_1393741923']):
?>
									<li><a class="bt" href="?action=doc&do=show&id=<?php echo $this->_var['row_0_36945100_1393741923']['id']; ?>" target="navTab" rel="docsee"><?php echo $this->_var['row_0_36945100_1393741923']['title']; ?></a><br/>
									<div class="info"><?php echo $this->_var['row_0_36945100_1393741923']['intro_txt']; ?></div>
									<div class="zz">发布者：<?php echo $this->_var['row_0_36945100_1393741923']['salesid_txt']; ?> 发布时间：<?php echo $this->_var['row_0_36945100_1393741923']['created_at']; ?></div>
									</li>	
							<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
									</ul>
									<div class="qt">暂无数据：
										<a class="next"></a>
										<a class="prev"></a>
										<span class="pageState"></span>
										</div>
									<script type="text/javascript">
										jQuery(".gg").slide({mainCell:" ul",autoPage:true,effect:"top",autoPlay:true,scroll:1,vis:1,trigger:"click",interTime:10000});
									</script>
								</div>
								
						</div></div>
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
	
	<a class="button" href="?action=plug&do=publicshow&src=<?php echo $this->_var['row']['mapsrc']; ?>" target="dialog" rel="page1" max="true" ><span>地图查找</span></a>
	<a class="button" href="tpl/price/price_search.htm" target="dialog" rel="price" height="160" ><span>价格查询</span></a>
	<a class="button" href="?action=plug&do=publicshow&src=http://xiuxiu.web.meitu.com/?xiuxiu" target="dialog" rel="page2" max="true" ><span>美图秀秀11111</span></a>
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
