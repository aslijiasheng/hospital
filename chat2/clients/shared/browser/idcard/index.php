<?php

include("../../../../base/inc/config.inc.php");
include("../../../../base/inc/init.inc.php");
include("../../../../base/inc/functions.inc.php");
include("../../../../base/inc/api.inc.php");
include("../../../../base/inc/inputvalidation.inc.php");

$arsc_api = new arsc_api_Class;

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 $arsc_user = arsc_validateinput($_GET["arsc_user"], $arsc_api->getSimpleUserlist($arsc_my["room"]), NULL, 1, 64, __FILE__, __LINE__);
 if ($arsc_my["user"] == $arsc_user)
 {
  header("Location: admin.php?arsc_sid=".$arsc_my["sid"]);
  die();
 }
 else
 {
  header("Location: view.php?arsc_sid=".$arsc_my["sid"]."&arsc_user=".urlencode($arsc_user));
  die();
 }
}
?>