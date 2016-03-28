<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
</head>

<body>
  <form action="save.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mytable">
  <tr class="table_title">
    <td colspan="2">优惠券</td>
  </tr>
  <tr>
    <td width="22%" align="right">姓名：</td>
    <td><input type="text" name="user" id="user" class="input" /></td>
  </tr>
  <tr>
    <td align="right">性别：</td>
    <td><input type="radio" name="sex" value="男" /> 男 <input type="radio" name="sex" value="女" /> 女</td>
  </tr>
  <tr>
    <td align="right">类型：</td>
    <td><input type="radio" name="lx" value="1" /> 优惠1<input type="radio" name="lx" value="2" /> 优惠2</td>
  </tr>
  <tr>
    <td align="right">手机号码：</td>
    <td><input type="text" name="phone" class="input required" /></td>
  </tr>
  <tr>
    <td align="right">E-mail：</td>
    <td><input type="text" name="email" class="input" /></td>
  </tr>
  <tr>
    <td height="42">&nbsp;</td>
    <td><input type="submit" class="btn" value="提 交" /> &nbsp; <input type="reset" class="btn" value="重 置" /></td>
  </tr>
</table>
</form>
</body>
</html>