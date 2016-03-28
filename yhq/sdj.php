<?php session_start();
$bt=array('5'=>'消费满3000减500','6'=>'皮肤美容优惠券','7'=>'消费满6000减1000','8'=>'消费满30000减5000');
$bt2=strtr($_GET['id'],$bt);
echo "sda ".$bt2.$_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>双蛋节抢购--昆山百达丽整形美容医院</title>

<link rel="stylesheet" type="text/css" href="../css/main.css" />
<style type="text/css">
body{margin:0;padding:0;}
.demo{width:550px;  background:#fff; color:#333;overflow:hidden;}
.input{width:220px; height:18px; padding:2px 2px 0 2px; border:1px solid #ccc}
.btn{width:68px; height:22px; border:none; background:url(images/btn.gif) no-repeat; cursor:pointer}
.mytable{width:550px; border:1px solid #ccc}
.mytable td{padding:4px 6px; border-bottom:1px dotted #d3d3d3; color:#333}
.mytable td p{line-height:16px; color:#999}
.table_title{height:30px; line-height:30px; background:#f7f7f7; font-weight:bold; font-size:14px}

label.error{color:#ea5200; margin-left:4px; padding:0px 20px; background:url(images/unchecked.gif) no-repeat 2px 0 }
label.right{margin-left:4px; padding-left:20px; background:url(images/checked.gif) no-repeat 2px 0}
</style>
<script type="text/javascript" src="http://www.100dali.com/templets/bdlsh/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="http://www.100dali.com/yhq/js/jquery.validate.js"></script>
<script type="text/javascript" src="http://www.100dali.com/yhq/js/validate-ex.js"></script>
<script type="text/javascript">
$(function(){	   
	var validate = $("#my").validate({
		rules:{
			user:{
				maxlength:16,
				minlength:2,
				userName:true
			},
			tel:{isTel:true},
			phone:{isMobile:true},
			url:{url:true},
			birthday:"dateISO",
			zipcode:"isZipCode",
			captcha:{
				remote:"process.php"
			}
		},
		messages:{
			phone:{
				remote:"该手机号已抢购过此类优惠券"
			},
			sex:"请选择性别！",
			captcha:{
				remote:"验证码错误！"
			},
			low:" "
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo ( element.parent() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.parent() );
			else if ( element.is("input[name=captcha]") )
				error.appendTo ( element.parent() );
			else
				error.insertAfter(element);
		},
	    		  
	});	
	
	$("#getcode").click(function(){
		$imgstr="getcode.php?randcode="+Math.random();
		$(this).attr("src",$imgstr);
	});
	$("input:reset").click(function(){
		validate.resetForm();
	});
});
</script>
</head>

<body>
<div id="main">
   <div class="demo">
<form action="savesdj.php" method="post" id="my" >
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mytable">
  <tr class="table_title">
    <td colspan="2"><?php echo $bt2;?></td>
  </tr>
  <tr>
    <td width="22%" align="right">姓名：</td>
    <td><input type="text" name="user" id="user" class="input" /></td>
  </tr>
  <tr style="display:none;">
    <td align="right">性别：</td>
    <td><input type="radio" name="sex" value="男" /> 男 <input type="radio" name="sex" value="女" /> 女</td>
  </tr>
  <tr style="display:none;">
    <td align="right">类型：</td>
    <td><input type="text" name="lx" id="user" class="input" value="<?php echo $_GET['id'];?>" /></td>
  </tr>
  <tr>
    <td align="right">手机号码：</td>
    <td><input type="text" name="phone" class="input required" /></td>
  </tr>
  <tr  style="display:none;">
    <td align="right">E-mail：</td>
    <td><input type="text" name="email" class="input" /></td>
  </tr>
  <tr>
    <td align="right">验证码：</td>
    <td><input type="text" name="captcha" class="input required" style="width:80px;" />
    <img src="getcode.php" id="getcode"  alt="看不清，点击换一张" align="absmiddle" style="cursor:pointer" />
    </td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td><input type="submit" class="btn" value="提 交" /> &nbsp; <input type="reset" class="btn" value="重 置" /></td>
  </tr>
</table>
</form>
</div>
</div>
<?php
echo $_GET['id'];
?>

</body>
</html>
