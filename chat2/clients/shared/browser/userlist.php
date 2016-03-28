<?php

include("../../../base/inc/config.inc.php");
include("../../../base/inc/init.inc.php");
include("../../../base/inc/functions.inc.php");
include("../../../base/inc/inputvalidation.inc.php");
include("../../../base/inc/api.inc.php");

$arsc_current_room = arsc_validateinput($_GET["arsc_current_room"], NULL, "/[^a-z0-9_]/", 0, 32, __FILE__, __LINE__);

$arsc_api = new arsc_api_Class;

if($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 include("../../../languages/".$arsc_my["language"].".inc.php");

 if ($arsc_api->userIsValid($arsc_my["user"]))
 {
  if (isset($_GET["arsc_enter"]))
  {
   $arsc_api->postMessage($arsc_my["room"], "arsc_user_enter~~".$arsc_my["user"]."~~".$arsc_api->getReadableRoomname($arsc_my["room"]), "System", date("H:i:s"), arsc_microtime(), 0);
  }

  header("Expires: Wed, 4 Oct 1978 09:32:45 GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-Type: text/html");
  $arsc_current["random"] = time();
  header("Refresh: ".ARSC_PARAMETER_USERLIST_REFRESH."; URL=userlist.php?arsc_sid=".$arsc_my["sid"]."&arsc_current_room=".$arsc_my["room"]."&arsc_language=".$arsc_my["language"]."&arsc_random=".$arsc_current["random"]);
  $arsc_api->setUserValueByName("lastping", time(), $arsc_my["user"]);
  $arsc_api->setUserValueByName("flag_idle", 0, $arsc_my["user"]);
  $arsc_api->deleteIdleUsers();
  if ($arsc_current_room <> "" AND $arsc_current_room <> $arsc_my["room"]) $arsc_current["reloadallframes"] = 1; else $arsc_current["reloadallframes"] = 0;
  
  echo $arsc_api->parseLayoutTemplate("userlist");
 }
 else
 {
  $arsc_current["user_got_kicked"] = 1;
  echo $arsc_api->parseLayoutTemplate("userlist");
 }
}
else
{
 $arsc_current["user_got_kicked"] = 2;
 echo $arsc_api->parseLayoutTemplate("userlist");
}
?>
