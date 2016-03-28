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

$arsc_api = new arsc_api_Class;

$arsc_error = arsc_validateinput($_GET["arsc_error"], NULL, "/[^a-zA-Z0-9_]/", 3, 24, __FILE__, __LINE__);
$arsc_send = arsc_validateinput($_POST["arsc_send"], array("", "yes"), NULL, 0, 3, __FILE__, __LINE__);
if($arsc_send == "yes")
{
 $arsc_user = arsc_validateinput($arsc_api->makeCleanUsername($_POST["arsc_user"]), NULL, "/[^a-zA-Z0-9_\-]/", 1, 64, __FILE__, __LINE__);
 $arsc_password = arsc_validateinput($_POST["arsc_password"], NULL, "/[^a-zA-Z0-9_]/", 0, 64, __FILE__, __LINE__);
 $arsc_email = arsc_validateinput($_POST["arsc_email"], NULL, "/^[[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$]/", 5, 64, __FILE__, __LINE__);
}
else
{
 $arsc_email = arsc_validateinput($_GET["arsc_email"], NULL, "/^[[_a-z0-9+-]+(\.[_a-z0-9+-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$]/", 5, 64, __FILE__, __LINE__);
}

if ($arsc_send == "")
{
 $arsc_current["error"] = $arsc_lang["error_".$arsc_error];
 $arsc_current["language"] = $arsc_language;
 echo $arsc_api->parseLayoutTemplate("register");
}
else
{
 $arsc_query = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users WHERE user = '".mysql_escape_string($arsc_user)."'", ARSC_PARAMETER_DB_LINK);
 $arsc_result = mysql_fetch_array($arsc_query);
 if ($arsc_result["cnt"] == 0 AND $arsc_user <> "")
 {
  $arsc_location = "Location: home.php?arsc_language=".$arsc_language."&arsc_user=".$arsc_user;
  mail($arsc_email, str_replace("{title}", ARSC_PARAMETER_TITLE, $arsc_lang["register_emailtemplate_subject"]), str_replace("{chatowner}", ARSC_PARAMETER_REGISTER_OWNER, str_replace("{homepage}", ARSC_PARAMETER_REGISTER_HOMEPAGE, str_replace("{password}", $arsc_password, str_replace("{username}", $arsc_user, str_replace("{title}", ARSC_PARAMETER_TITLE, $arsc_lang["register_emailtemplate_body"]))))), "From: ".ARSC_PARAMETER_REGISTER_OWNER_EMAIL);
  mysql_query("INSERT INTO arsc_registered_users (user, password, email) VALUES ('".mysql_escape_string($arsc_user)."', '".mysql_escape_string(sha1($arsc_password))."', '".mysql_escape_string($arsc_email)."')", ARSC_PARAMETER_DB_LINK);
  header($arsc_location);
  die();
 }
 else
 {
  header("Location: register.php?arsc_email=".$arsc_email."&arsc_language=".$arsc_language."&arsc_error=register_double_user");
  die();
 }
}

?>
