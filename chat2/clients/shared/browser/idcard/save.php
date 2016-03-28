<?php

include("../../../../base/inc/config.inc.php");
include("../../../../base/inc/init.inc.php");
include("../../../../base/inc/functions.inc.php");
include("../../../../base/inc/api.inc.php");
include("../../../../base/inc/inputvalidation.inc.php");

$arsc_save_sex = arsc_validateinput($_POST["arsc_save_sex"], array(0, 1), NULL, 1, 1, __FILE__, __LINE__);
$arsc_save_location = arsc_validateinput(htmlspecialchars($_POST["arsc_save_location"], ENT_NOQUOTES), NULL, "/[^a-zA-Z0-9_\/\&\.;,\- ]/", 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__);
$arsc_save_color = arsc_validateinput($_POST["arsc_save_color"], NULL, "/[^a-fA-F0-9]/", 6, 6, __FILE__, __LINE__);
$arsc_save_hobbies = arsc_validateinput(htmlspecialchars($_POST["arsc_save_hobbies"], ENT_NOQUOTES), NULL, NULL, 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__);
$arsc_save_flag_guestbook = arsc_validateinput($_POST["arsc_save_flag_guestbook"], array(0, 1), NULL, 1, 1, __FILE__, __LINE__);

$arsc_api = new arsc_api_Class;

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_POST["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 $arsc_api->userIsValid($arsc_my["user"]);
 include("../../../../languages/".$arsc_my["language"].".inc.php");
 if (mysql_query("UPDATE arsc_registered_users SET sex = '$arsc_save_sex', location = '$arsc_save_location', color = '$arsc_save_color', hobbies = '".substr($arsc_save_hobbies, 0, 250)."', flag_guestbook = '$arsc_save_flag_guestbook' WHERE user = '".$arsc_my["user"]."'", ARSC_PARAMETER_DB_LINK))
 {
  header("Location: admin.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode($arsc_lang["idcard_save_ok"]."<br>"));
 }
 else
 {
  header("Location: admin.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode($arsc_lang["idcard_save_no"]."<br>"));
 }
}
else
{
 header("Location: ../empty.php");
 die();
}

?>
