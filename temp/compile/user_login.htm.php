<!DOCTYPE HTML>
<html dir="ltr" lang="zh-CN">
<script src="javascripts/jquery-1.7.1.js" type="text/javascript"></script>
<script src="javascripts/jquery.cookie.js" type="text/javascript"></script>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_var['cfg']['webtitle']; ?><?php echo $this->_var['cfg']['edition']; ?></title>
 <link href="zhuomian/css/main.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript"> 
			$(function(){
				var username = $.cookie('username');
				var password  = $.cookie('password');
				if(username != null && username != '' && password !=null && password != ''){//将获取到的cookie填入输入框中
					$('#remember').attr('checked','checked');//这里写成$('#save_password').attr('checked',true);也可以
					$('#username').val(username);
					$('#password').val(password);
				}
				
				$('#btn_save').click(function(){
					var username = $('#username').val();
					var password = $('#password').val();
					if($('#remember').attr('checked') == 'checked'){//创建cookie保存密码！！！
						$.cookie('username',username, {expires:15,path:'/'});
						$.cookie('password',password, {expires:15,path:'/'});
					}else{//删除cookie
						$.cookie('username',username, {expires:-1,path:'/'});
						$.cookie('password',password, {expires:-1,path:'/'});
					}
				});
				
			});
			
		</script>
</head>
<body>
<div class="login">
	<div class="menus">
    	<div class="public"><a href="http://www.33c33.com/main" target="_blank">使用帮助</a></div>
    </div>
    <div class="box png">
        <form accept-charset="utf-8" action="?action=user&do=loginok" method="post">
        <div class="header2">
            <h2 class="logo png"><a href="/" target="_blank"></a></h2>
            <span class="alt"><input name="remember" type="checkbox"  id="remember" />记住登入</span>
        </div>
        <ul>
            <li style="padding-top:0;"><label>用户名</label><input name="username" id="username" type="text" class="text" /></li>
            <li><label>密　码</label><input name="password" type="password" class="text"  id="password" /></li>
            <li class="submits"><input class="submit" type="submit" value="登录" id="btn_save"/></li>
        </ul>
        <div class="copyright">&copy; 2012 - 2014 | <a href="http://www.33c33.com" target="_blank" title="">33c33.com..</a> |
            <a href="http://www.33c33.com" target="_blank" >虫圣微博</a>
        </div>
        </form>
    </div>
    <div class="air-balloon ab-1 png"></div><div class="air-balloon ab-2 png"></div>
    <div class="footer"></div>
</div>

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


</body>
</html>

