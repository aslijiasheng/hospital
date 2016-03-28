<?php

include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");

$arsc_api = new arsc_api_Class;

function arsc_mysql_query($query)
{
 GLOBAL $arsc_error_count;
 mysql_query($query, ARSC_PARAMETER_DB_LINK);
 if (mysql_error(ARSC_PARAMETER_DB_LINK) <> "")
 {
  $arsc_error_count++;
  echo '<br><font face="Arial" color="#FF0000">A MySQL error occured!</font><br><font face="Arial">I said:<br><font color="#999999" size="1">'.htmlspecialchars($query).'</font><br>but MySQL said: <font color="#FF0000">'.mysql_error(ARSC_PARAMETER_DB_LINK).'</font><br><br>';
 }
}
?>
<html>
 <head>
  <title>ARSC installation</title>
 </head>
 <body>
  <?php
  if(ARSC_PARAMETER_BASEURL <> "ARSC_PARAMETER_BASEURL")
  {
   echo '<font face="Arial"><b>This ARSC setup has already been installed!</b></font><br>';
   echo '</body></html>';
   die();
  }
  echo '<font face="Arial"><b>Step 1: Reading MySQL Dump...</b></font><br>';
  $arsc_fp = fopen("install.sql", "r");
  $arsc_sqlqueries = fread($arsc_fp, filesize("install.sql"));
  $arsc_sqlquery = explode(";\n", $arsc_sqlqueries);
  echo '<font face="Arial"><b>...done.</b></font><br><br>';
  
  echo '<font face="Arial"><b>Step 2: Creating MySQL tables...</b></font><br>';
  while(list($arsc_key, $arsc_query) = each($arsc_sqlquery))
  {
   $arsc_query = trim(str_replace("\n", "", $arsc_query));
   if($arsc_query <> "")
   {
    arsc_mysql_query($arsc_query);
   }
  }
  echo '<font face="Arial"><b>...done.</b></font><br><br>';
  
  echo '<font face="Arial"><b>Step 3: Setting parameters according to your environment...</b></font><br>';
  $arsc_basedir = str_replace("base/install/index.php", "", $_SERVER["PHP_SELF"]);
  arsc_mysql_query("UPDATE arsc_parameters SET value = '".$_SERVER["SERVER_NAME"]."' WHERE name = 'socketserver_adress'");
  arsc_mysql_query("UPDATE arsc_parameters SET value = 'http://".$_SERVER["SERVER_NAME"].$arsc_basedir."base/pic/smilies/' WHERE name = 'smilies_path'");
  arsc_mysql_query("UPDATE arsc_parameters SET value = 'webmaster@".$_SERVER["SERVER_NAME"]."' WHERE name = 'register_owner_email'");
  arsc_mysql_query("UPDATE arsc_parameters SET value = 'http://".$_SERVER["SERVER_NAME"].$arsc_basedir."' WHERE name = 'register_homepage'");
  arsc_mysql_query("UPDATE arsc_parameters SET value = 'http://".$_SERVER["SERVER_NAME"].$arsc_basedir."' WHERE name = 'baseurl'");
  echo '<font face="Arial"><b>...done.</b></font><br><br>';
  
  if($_GET["arsc_automatedinstall"] <> 1)
  {
   echo '<font face="Arial"><b>Step 4: Setting account passwords...</b></font><br>';
   mt_srand((double)microtime()*1000000);
   $arsc_password = substr(sha1(mt_rand(0, mt_getrandmax())), 0, 8);
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1($arsc_password)."' WHERE user = 'Administrator'");
   echo '<font face="Arial"><i>Administrator:</i> '.$arsc_password.'</font><br>';
   $arsc_password = substr(sha1(mt_rand(0, mt_getrandmax())), 0, 8);
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1($arsc_password)."' WHERE user = 'Display'");
   echo '<font face="Arial"><i>Display:</i> '.$arsc_password.'</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Arial" color="#FF0000">Please write these down!</font><br>';
   $arsc_password = substr(sha1(mt_rand(0, mt_getrandmax())), 0, 8);
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1($arsc_password)."' WHERE user = 'Moderator'");
   echo '<font face="Arial"><i>Moderator:</i> '.$arsc_password.'</font><br>';
   $arsc_password = substr(sha1(mt_rand(0, mt_getrandmax())), 0, 8);
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1($arsc_password)."' WHERE user = 'VIP'");
   echo '<font face="Arial"><i>VIP:</i> '.$arsc_password.'</font><br>';
   echo '<font face="Arial"><b>...done.</b></font><br><br>';
  }
  else
  {
   echo '<font face="Arial"><b>Step 4: [AUTOMATED INSTALL] Setting accounts and parameters...</b></font><br>';
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1(mysql_escape_string($_GET["arsc_automatedinstallusers"]["administrator_password"]))."' WHERE user = 'Administrator'");
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1(mysql_escape_string($_GET["arsc_automatedinstallusers"]["display_password"]))."' WHERE user = 'Display'");
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1(mysql_escape_string($_GET["arsc_automatedinstallusers"]["moderator_password"]))."' WHERE user = 'Moderator'");
   arsc_mysql_query("UPDATE arsc_registered_users SET password = '".sha1(mysql_escape_string($_GET["arsc_automatedinstallusers"]["vip_password"]))."' WHERE user = 'VIP'");
   while(list($arsc_key, $arsc_val) = each($_GET["arsc_automatedinstallparameters"]))
   {
    arsc_mysql_query("UPDATE arsc_parameters SET value = '".mysql_escape_string($arsc_val)."' WHERE name = '".mysql_escape_string($arsc_key)."'");
   }
   while(list($arsc_key, $arsc_val) = each($_GET["arsc_automatedinstalldeleterooms"]))
   {
    $arsc_api->deleteRoom($arsc_val);
   }
   echo '<font face="Arial"><b>...done.</b></font><br><br>';
  }
  
  ?>
  <font face="Arial">
   <b>
    ARSC Installation finished
    <?php
    if($arsc_error_count > 0)
    {
     echo '<font color="#FF0000"> with errors</font>!</b> Your installation might not work!<b>';
    }
    else
    {
     echo '<font color="#009900"> without errors</font>.</b> Your installation should work.<b>';
    }
    ?>
   </b>
   <br>
   <br>
   If something went wrong, you might want to <a href="http://sourceforge.net/forum/forum.php?forum_id=102858" target="_blank">visit the ARSC help forum by clicking here</a>.
   <br>
   <br>
   You can now:
   <br>
   <li>
    <a href="../../">Go to the chat homepage</a>
   </li>
   <li>
    <a href="../admin/">Go to the chat admin interface</a> (log in with the <i>Administrator</i> account listed above).
   </li>
  </font>
  <br>
 </body>
</html>
