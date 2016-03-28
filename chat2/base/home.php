<?php

include("inc/config.inc.php");
include("inc/init.inc.php");
include("inc/functions.inc.php");
include("inc/api.inc.php");
include("inc/inputvalidation.inc.php");

$arsc_language = arsc_validateinput($_GET["arsc_language"], NULL, "/[^a-z\-]/", 0, 64, __FILE__, __LINE__);
if ($arsc_language == "") $arsc_language = ARSC_PARAMETER_DEFAULT_LANGUAGE;
if (!is_file("../languages/".$arsc_language.".inc.php")) arsc_error_log(ARSC_ERRORLEVEL_FATAL, "Could not open language file. Something is really messed up!", __FILE__, __LINE__);
include("../languages/".$arsc_language.".inc.php");

// $arsc_user = arsc_validateinput($_GET["arsc_user"], NULL, "/[^a-zA-Z0-9_]/", 0, 64, __FILE__, __LINE__);
$arsc_user = "";       // Don't accept input parameter, make flooder learn scripting.
$arsc_error = arsc_validateinput($_GET["arsc_error"], NULL, "/[^a-zA-Z0-9_]/", 0, 30, __FILE__, __LINE__);

$arsc_api = new arsc_api_Class;

// Delete empty private rooms
$arsc_query1 = mysql_query("SELECT roomname FROM arsc_rooms WHERE type = 1", ARSC_PARAMETER_DB_LINK);
while ($arsc_result1 = mysql_fetch_array($arsc_query1))
{
 $arsc_query2 = mysql_query("SELECT COUNT(user) AS cnt FROM arsc_users WHERE room = '".mysql_escape_string($arsc_result1["roomname"])."'", ARSC_PARAMETER_DB_LINK);
 $arsc_result2 = mysql_fetch_array($arsc_query2);
 if ($arsc_result2["cnt"] == 0)
 {
  mysql_query("DROP TABLE arsc_room_".mysql_escape_string($arsc_result1["roomname"]), ARSC_PARAMETER_DB_LINK);
  mysql_query("DELETE FROM arsc_rooms WHERE roomname = '".mysql_escape_string($arsc_result1["roomname"])."'", ARSC_PARAMETER_DB_LINK);
 }
}
$arsc_query1 = mysql_query("SHOW TABLES LIKE 'arsc\_room\_%'", ARSC_PARAMETER_DB_LINK);
while ($arsc_result1 = mysql_fetch_array($arsc_query1))
{
 $arsc_queryroomname = substr($arsc_result1[0], 10);
 $arsc_query2 = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_rooms WHERE roomname = '".mysql_escape_string($arsc_queryroomname)."'", ARSC_PARAMETER_DB_LINK);
 $arsc_result2 = mysql_fetch_array($arsc_query2);
 if ($arsc_result2["cnt"] == 0)
 {
  mysql_query("DROP TABLE ".$arsc_result1[0], ARSC_PARAMETER_DB_LINK);
 }
}

$arsc_current["user"] = $arsc_user;
$arsc_current["error"] = $arsc_lang["error_".$arsc_error];
$arsc_current["language"] = $arsc_language;

echo $arsc_api->parseLayoutTemplate("home");

?>
