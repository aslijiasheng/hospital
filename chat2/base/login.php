<?php

include("inc/config.inc.php");
include("inc/init.inc.php");
include("inc/functions.inc.php");
include("inc/api.inc.php");
include("inc/inputvalidation.inc.php");

$arsc_language = arsc_validateinput($_POST["arsc_language"], NULL, "/[^a-z\-]/", 0, 64, __FILE__, __LINE__);
if ($arsc_language == "") $arsc_language = ARSC_PARAMETER_DEFAULT_LANGUAGE;
if (!is_file("../languages/".$arsc_language.".inc.php")) arsc_error_log(ARSC_ERRORLEVEL_FATAL, "Could not open language file. Something is really messed up!", __FILE__, __LINE__);

$arsc_api = new arsc_api_Class;

$arsc_user = arsc_validateinput($arsc_api->makeCleanUsername($_POST["arsc_user"]), NULL, "/[^a-zA-Z0-9_\-]/", 1, 64, __FILE__, __LINE__);
$arsc_password = arsc_validateinput($_POST["arsc_password"], NULL, "/[^a-zA-Z0-9]/", 0, 64, __FILE__, __LINE__);
$arsc_room = arsc_validateinput($_POST["arsc_room"], NULL, "/[^a-z0-9_]/", 0, 32, __FILE__, __LINE__);
$arsc_chatversion = arsc_validateinput($_POST["arsc_chatversion"], array("browser_push", "browser_socket", "browser_xmlhttprequest", "browser_refresh", "browser_text"), 0, 64, __FILE__, __LINE__);
$arsc_template = arsc_validateinput($_POST["arsc_template"], array("html", "html_moderator", "xml"), 0, 64, __FILE__, __LINE__); // FIXME: get available templates

$arsc_ip = getenv("REMOTE_ADDR");
$arsc_level = 0;
$arsc_color = "000000";

if ($arsc_user == "")
{
 header ("Location: home.php?arsc_error=no_name&arsc_language=".$arsc_language);
 die();
}
if (strstr($arsc_user, "<") OR strstr($arsc_user, ">"))
{
 header ("Location: home.php?arsc_error=bad_name&arsc_language=".$arsc_language);
 die();
}
$arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_users WHERE user = '".mysql_escape_string($arsc_user)."'", ARSC_PARAMETER_DB_LINK);
$arsc_a = mysql_fetch_array($arsc_result);
if ($arsc_a["cnt"] > 0 OR $arsc_user == "System" OR $arsc_user == "system" OR $arsc_user == "-1")
{
 // Kick if registered user and password is the same
 $arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users WHERE user = '".mysql_escape_string($arsc_user)."' AND password = '".mysql_escape_string(sha1($arsc_password))."'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if ($arsc_a["cnt"] == 1)
 {
  mysql_query("DELETE FROM arsc_users WHERE user = '".mysql_escape_string($arsc_user)."'", ARSC_PARAMETER_DB_LINK);
 }
 else
 {
  // Check if he/she/it is trying to log into an idle user, with the very same IP
  $arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_users WHERE user = '".mysql_escape_string($arsc_user)."' AND ip = '".mysql_escape_string($_SERVER["REMOTE_ADDR"])."' AND flag_idle = '1'", ARSC_PARAMETER_DB_LINK);
  $arsc_a = mysql_fetch_array($arsc_result);
  if ($arsc_a["cnt"] == 1)
  {
   mysql_query("DELETE FROM arsc_users WHERE user = '".mysql_escape_string($arsc_user)."'", ARSC_PARAMETER_DB_LINK);
  }
  else
  {
   header ("Location: home.php?arsc_error=double_user&arsc_language=".$arsc_language);
   die();
  }
 }
}
$arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users WHERE user = '".mysql_escape_string($arsc_user)."'", ARSC_PARAMETER_DB_LINK);
$arsc_a = mysql_fetch_array($arsc_result);
if ($arsc_a["cnt"] > 0)
{
 $arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users WHERE user = '".mysql_escape_string($arsc_user)."' AND password = '".mysql_escape_string(sha1($arsc_password))."' AND flag_locked = '0'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if ($arsc_a["cnt"] <> 1 OR $arsc_user == "System" OR $arsc_user == "system")
 {
  header ("Location: home.php?arsc_error=wrong_credentials&arsc_language=".$arsc_language);
  die();
 }
 $arsc_result = mysql_query("SELECT level, color, template, layout FROM arsc_registered_users WHERE user = '$arsc_user'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 $arsc_level = $arsc_a["level"];
 $arsc_color = $arsc_a["color"];
 if($arsc_a["template"] <> "")
 {
  $arsc_template = $arsc_a["template"];
 }
 if($arsc_a["layout"] <> "")
 {
  $arsc_layout = $arsc_a["layout"];
 }
}
elseif (ARSC_PARAMETER_REGISTER_FORCE == "yes")
{
 header ("Location: home.php?arsc_error=wrong_credentials&arsc_language=".$arsc_language);
 die();
}
$arsc_result = mysql_query("SELECT COUNT(*) AS cnt FROM arsc_bannlist WHERE ip = '$arsc_ip' AND until > '".time()."'", ARSC_PARAMETER_DB_LINK);
$arsc_a = mysql_fetch_array($arsc_result);
if ($arsc_a["cnt"] > 0)
{
 header ("Location: home.php?arsc_error=banned&arsc_language=".$arsc_language);
 die();
}
else
{
 $arsc_result = mysql_query("SELECT COUNT(*) AS cnt FROM arsc_users WHERE room = '$arsc_room'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if ($arsc_a["cnt"] == 0 AND ARSC_PARAMETER_FIRST_USER_GETS_OP == "yes" AND $arsc_level == 0)
 {
  $arsc_level = 10;
 }
 mt_srand((double)microtime()*1000000);
 $arsc_sid = sha1(mt_rand(0, mt_getrandmax()));
 $arsc_ping = time();
 // Some chars must be stripped out or replaced
 if ($arsc_chatversion == "applet")
 {
  header ("Location: ../clients/".$arsc_chatversion."/index.php?arsc_user=".urlencode($arsc_user)."&arsc_room=".urlencode($arsc_room)."&arsc_password=".urlencode($arsc_password)."&arsc_language=".urlencode($arsc_language));
  die();
 }
 $arsc_result = mysql_query("SELECT type FROM arsc_rooms WHERE roomname = '$arsc_room'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if ($arsc_a["type"] == ARSC_ROOMTYPE_MODERATED)
 {
  $arsc_template = "html_moderated";
 }
 if ($arsc_a["type"] == ARSC_ROOMTYPE_MODERATED AND $arsc_level >= 30)
 {
  $arsc_template = "html_moderator";
 }
 if($arsc_template == "")
 {
  $arsc_template = ARSC_PARAMETER_DEFAULT_TEMPLATE_NAME;
 }
 if($arsc_layout == "")
 {
  $arsc_layout = ARSC_PARAMETER_DEFAULT_LAYOUT_ID;
 }
 mysql_query("INSERT INTO arsc_users (user, color, lastping, ip, room, language, level, sid, version, template, layout, showsince) VALUES ('$arsc_user', '$arsc_color', '$arsc_ping', '$arsc_ip', '$arsc_room', '$arsc_language', '$arsc_level', '$arsc_sid', '$arsc_chatversion', '$arsc_template', '$arsc_layout', '".arsc_microtime()."')", ARSC_PARAMETER_DB_LINK);
 header ("Location: ../clients/".$arsc_chatversion."/index.php?arsc_sid=".$arsc_sid."&arsc_enter=true");
 die();
}

?>
