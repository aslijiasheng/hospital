<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");

if($arsc_sent == 1)
{
 $arsc_query = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users WHERE level = '99' AND user = '".mysql_escape_string($arsc_user)."' AND password = '".mysql_escape_string(sha1($arsc_password))."'", ARSC_PARAMETER_DB_LINK);
 $arsc_result = mysql_fetch_array($arsc_query);
 if($arsc_result["cnt"] <> 1)
 {
  header("Location: login.php?arsc_message=Login+failed!");
  die();
 }
 mt_srand((double)microtime()*1000000);
 $arsc_admin_sessionid = sha1(mt_rand(0, mt_getrandmax()));
 mysql_query("UPDATE arsc_registered_users SET admin_sessionid = '".mysql_escape_string($arsc_admin_sessionid)."' WHERE user = '".mysql_escape_string($arsc_user)."'", ARSC_PARAMETER_DB_LINK);
 setcookie("arsc_cookie_user", $arsc_user, time()+60*60*24);
 setcookie("arsc_cookie_admin_sessionid", $arsc_admin_sessionid, time()+60*60*24);
 header("Location: index.php");
 die();
}
else
{
 ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
 <head>
  <title>
   <?php echo ARSC_PARAMETER_TITLE; ?> Administration Login
  </title>
 </head>
 <body bgcolor="#FFFFFF">
  <font face="Arial" color="#FF0000">
   <b>
    <?php echo $arsc_message; ?>
   </b>
  </font>
  <form action="login.php" method="POST">
   <input type="hidden" name="arsc_sent" value="1">
   <h2>
    <font face="Arial">
     Login
    </font>
   </h2>
   <font face="Arial" size="2">
    Use an administrator account in order to log in.
    <br>
    An account named 'Administrator' was created upon install.
    <p>
    <b>Cookies must be enabled</b> for the login to work.
   </font>
   <br>
   <br>
   <font face="Arial" size="2">Username:</font>
   <br>
   <input type="text" name="arsc_user">
   <br>
   <font face="Arial" size="2">Password:</font>
   <br>
   <input type="password" name="arsc_password">
   <br>
   <br>
   <input type="submit" value="Log in">
  </form>
 <?php
}

?>
