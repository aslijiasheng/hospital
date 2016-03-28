<?php

include("../../../../base/inc/config.inc.php");
include("../../../../base/inc/init.inc.php");
include("../../../../base/inc/functions.inc.php");
include("../../../../base/inc/api.inc.php");
include("../../../../base/inc/inputvalidation.inc.php");

$arsc_api = new arsc_api_Class;

$arsc_text = arsc_validateinput(htmlspecialchars($_POST["arsc_text"], ENT_NOQUOTES), NULL, NULL, 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__);
$arsc_user = arsc_validateinput($_POST["arsc_user"], $arsc_api->getSimpleUserlist($arsc_my["room"]), NULL, 1, 64, __FILE__, __LINE__);

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_POST["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 $arsc_api->userIsValid($arsc_my["user"]);
 include("../../../../languages/".$arsc_my["language"].".inc.php");
 $arsc_result = mysql_query("SELECT id FROM arsc_registered_users WHERE user = '$arsc_user'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if ($arsc_text <> "" AND mysql_query("INSERT INTO arsc_guestbooks (link_user, date, author, text) VALUES ('".$arsc_a["id"]."', '".date("Y-m-d")."', '".$arsc_my["user"]."', '".substr($arsc_text, 0, 500)."')", ARSC_PARAMETER_DB_LINK))
 {
  header("Location: view.php?arsc_sid=".$arsc_my["sid"]."&arsc_user=".$arsc_user."&arsc_message=".urlencode($arsc_lang["idcard_guestbook_add_ok"]."<br>"));
 }
 else
 {
  header("Location: view.php?arsc_sid=".$arsc_sid."&arsc_user=".$arsc_user."&arsc_message=".urlencode($arsc_lang["idcard_guestbook_add_no"]."<br>"));
 }
}
else
{
 header("Location: ../empty.php");
 die();
}

?>
