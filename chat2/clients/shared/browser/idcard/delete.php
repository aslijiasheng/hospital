<?php

include("../../../../base/inc/config.inc.php");
include("../../../../base/inc/init.inc.php");
include("../../../../base/inc/functions.inc.php");
include("../../../../base/inc/api.inc.php");
include("../../../../base/inc/inputvalidation.inc.php");

$arsc_gbid = arsc_validateinput($_GET["arsc_gbid"], NULL, "/[^0-9]/", 1, 6, __FILE__, __LINE__);

$arsc_api = new arsc_api_Class;

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 $arsc_api->userIsValid($arsc_my["user"]);
 include("../../../../languages/".$arsc_my["language"].".inc.php");
 $arsc_result = mysql_query("SELECT id FROM arsc_registered_users WHERE user = '".$arsc_my["user"]."'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if (mysql_query("DELETE FROM arsc_guestbooks WHERE id = '$arsc_gbid' AND link_user = '".$arsc_a["id"]."'", ARSC_PARAMETER_DB_LINK))
 {
  header("Location: admin.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode($arsc_lang["idcard_guestbook_delete_ok"]."<br>"));
 }
 else
 {
  header("Location: admin.php?arsc_sid=".$arsc_sid."&arsc_message=".urlencode($arsc_lang["idcard_guestbook_delete_no"]."<br>"));
 }
}
else
{
 header("Location: ../empty.php");
 die();
}

?>
