<?php

include("../../base/inc/config.inc.php");
include("../../base/inc/init.inc.php");
include("../../base/inc/functions.inc.php");
include("../../base/inc/inputvalidation.inc.php");
include("../../base/inc/api.inc.php");
include("../../base/inc/filter.inc.php");

$arsc_api = new arsc_api_Class;

if($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 if($arsc_my["lastmessageping"] == 0)
 {
  $arsc_my["lastmessageping"] = $arsc_api->setLastMessagePing($arsc_my);
 }
 include("../../languages/".$arsc_my["language"].".inc.php");
 $arsc_messages = $arsc_api->getMessages($arsc_my["lastmessageping"], $arsc_my["room"], $arsc_my["template"], "ASC");
 $arsc_my["lastmessageping"] = $arsc_api->setLastMessagePing($arsc_my);
 if($arsc_messages[0] != "")
 {
  if(ARSC_PARAMETER_SMILIES == "yes" AND $arsc_api->checkCommandAllowed($arsc_my["level"], "smilies"))
  {
   reset($arsc_smilies);
   $arsc_messages[0] = arsc_smilies_replace($arsc_messages[0], $arsc_smilies, ARSC_PARAMETER_SMILIES_PATH);
  }
  echo $arsc_messages[0];
 }
}

?>