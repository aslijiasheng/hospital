<!DOCTYPE HTML>
<html dir="ltr" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_var['cfg']['webtitle']; ?><?php echo $this->_var['cfg']['edition']; ?></title>
 <link href="zhuomian/css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="login">
	<div class="menus">
    	<div class="public"><a href="http://192.168.1.130:81/index.asp" >OA报告登入</a><a href="#" target="_blank">使用帮助</a></div>
    </div>
    <div class="box png">
        <form accept-charset="utf-8" action="?action=user&do=loginok" method="post">
        <div class="header2">
            <h2 class="logo png"><a href="/" target="_blank"></a></h2>
            <span class="alt"><input name="remember" type="checkbox"  <?php echo $this->_var['row']['rbr']; ?> />记住密码</span>
        </div>
        <ul>
            <li style="padding-top:0;"><label>用户名</label><input name="username" type="text" class="text" value="<?php echo $this->_var['row']['user']; ?>" /></li>
            <li><label>密　码</label><input name="password" type="password" class="text"  value="<?php echo $this->_var['row']['pwd']; ?>"/></li>
            <li class="submits"><input class="submit" type="submit" value="登录" /></li>
        </ul>
        <div class="copyright">&copy; 2010 - 2012 | <a href="http://100dali.net" target="_blank" title="百达丽整形美容">BaiDaLi.</a> |
            <a title="百达丽微博" href="#" target="_blank" class="百达丽微博">百达丽微博</a>
        </div>
        </form>
    </div>
    <div class="air-balloon ab-1 png"></div><div class="air-balloon ab-2 png"></div>
    <div class="footer"></div>
</div>
<script src="javascripts/jquery-1.7.1.js" type="text/javascript"></script>
<script type="text/javascript" src="zhuomian/js/fun.base.js"></script>
<script type="text/javascript" src="zhuomian/js/login.js"></script>

 <!--[if lt IE 8]>
<script src="zhuomian/jslib/PIE.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
    if (window.PIE && ( $.browser.version >= 6 && $.browser.version < 10 )){
        $('input.text,input.submit').each(function(){
            PIE.attach(this);
        });
    }
});
</script>
<![endif]-->

<!--[if IE 6]>
<script src="zhuomian/jslib/DD_belatedPNG.js" type="text/javascript"></script>
<script>DD_belatedPNG.fix('.png')</script>
<![endif]-->

<script type="text/javascript" charset="utf-8" src="http://julying.com/lab/weather/get/jquery.weather!&zIndex=13&move=true&autoDrop=true&jquery=false&style=default&area=client&city=101190401"></script>
</body>
</html>
