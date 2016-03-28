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
 include("../../languages/".$arsc_my["language"].".inc.php");
 
 if($arsc_my["lastmessageping"] == 0)
 {
  $arsc_my["lastmessageping"] = $arsc_api->setLastMessagePing($arsc_my);
 }
 
 if($_GET["dummy"] == "")
 {
  $arsc_api->setLastMessagePing($arsc_my);
  $arsc_my = $arsc_api->getUserValuesBySID($arsc_my["sid"]);
  $arsc_api->postMessage($arsc_my["room"], "arsc_user_enter~~".$arsc_my["user"]."~~".$arsc_api->getReadableRoomname($arsc_my["room"]), "System", date("H:i:s"), arsc_microtime(), 0);
 }
 header("Expires: Sun, 28 Dec 1997 09:32:45 GMT");
 header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
 header("Cache-Control: no-cache, must-revalidate");
 header("Pragma: no-cache");
 header("Refresh: 4; URL=chatmsg.php?arsc_sid=".$arsc_my["sid"]."&dummy=".time()."#end");
 header("Content-Type: text/html");

 $arsc_messages = $arsc_api->getMessages($arsc_my["lastmessageping"], $arsc_my["room"], $arsc_my["template"], "ASC");
 //$arsc_my["lastmessageping"] = $arsc_api->setLastMessagePing($arsc_my);
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
 <html>
  <head>
   <title>
    <?php echo ARSC_PARAMETER_TITLE; ?>
   </title>
  </head>
  <body>
   <?php
   set_magic_quotes_runtime(0);
   echo $arsc_messages[0];
   $arsc_template_varname = "arsc_template_".$arsc_my["template"];
   if($_GET["dummy"] == "")
   {
    if(ARSC_PARAMETER_WELCOME_MESSAGE <> "") echo arsc_filter_posting("System", date("H:i:s"), "/msg ".$arsc_my["user"]." ".ARSC_PARAMETER_WELCOME_MESSAGE, $arsc_my["room"], 0, 0, 0, $$arsc_template_varname);
    echo arsc_filter_posting("System", date("H:i:s"), "/msg ".$arsc_my["user"]." ".str_replace("{title}", ARSC_PARAMETER_TITLE, $arsc_lang["welcome"]), $arsc_my["room"], 0, 0, 0, $$arsc_template_varname);
   }
   $arsc_api->setUserValueByName("lastping", time(), $arsc_my["user"]);
   $arsc_api->setUserValueByName("ip", getenv("REMOTE_ADDR"), $arsc_my["user"]);
   ?>
   <a name="end"></a>
  </body>
 </html>
 <?php
}
?>
