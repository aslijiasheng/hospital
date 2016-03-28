<?php

include("../../../base/inc/config.inc.php");
include("../../../base/inc/init.inc.php");
include("../../../base/inc/functions.inc.php");
include("../../../base/inc/inputvalidation.inc.php");
include("../../../base/inc/api.inc.php");

$arsc_api = new arsc_api_Class;

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 include("../../../languages/".$arsc_my["language"].".inc.php");

 if ($arsc_api->userIsValid($arsc_my["user"]))
 {
  header("Expires: Wed, 4 Oct 1978 09:32:45 GMT");
  header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-Type: text/html");
  header("Refresh: ".ARSC_PARAMETER_ROOMLIST_REFRESH."; URL=roomlist.php?arsc_sid=".$arsc_my["sid"]);

  echo $arsc_api->parseLayoutTemplate("roomlist");
 }
}
?>
