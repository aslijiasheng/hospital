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
  if($arsc_my["version"] == "browser_refresh")
  {
   echo $arsc_api->parseLayoutTemplate("input_nojavascript");
  }
  else
  {
   echo $arsc_api->parseLayoutTemplate("input");
  }
 }
}
?>