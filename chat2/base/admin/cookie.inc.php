<?php

// Login and cookie handling

if((!isset($arsc_cookie_user) OR !isset($arsc_cookie_admin_sessionid)) OR ($arsc_cookie_user == "" OR $arsc_cookie_admin_sessionid == ""))
{
 header("Location: login.php");
 die();
}
else
{
 $arsc_query = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users WHERE user = '".mysql_escape_string($arsc_cookie_user)."' AND admin_sessionid = '".mysql_escape_string($arsc_cookie_admin_sessionid)."'", ARSC_PARAMETER_DB_LINK);
 $arsc_result = mysql_fetch_array($arsc_query);
 if($arsc_result["cnt"] <> 1)
 {
  header("Location: login.php");
  die();
 }
}

?>
