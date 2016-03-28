<?php

include("../../../base/inc/config.inc.php");
include("../../../base/inc/init.inc.php");
include("../../../base/inc/functions.inc.php");
include("../../../base/inc/api.inc.php");
include("../../../base/inc/inputvalidation.inc.php");

include("../../../base/inc/message_preprocessing.inc.php");
// FIXME include("../../../base/inc/message_postprocessing.inc.php");

$arsc_api = new arsc_api_Class;

$arsc_api->addTraffic("incoming", strlen($arsc_message));
if($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 $arsc_api->setUserValueByName("lastping", time(), $arsc_my["user"]);
 $arsc_api->setUserValueByName("flag_idle", 0, $arsc_my["user"]);
 /*
  Now this one is difficult: How can we filter user messages without being too restrictive?
  A whitelist filter is not possible - just think of all the Umlauts in all those languages in the world,
  or what if people chat about MySQL commands etc.?
  Thus, we will hope that mysql_escape_string() and htmlspecialchars() do their jobs.
 */
 $arsc_message = arsc_validateinput(htmlspecialchars($_GET["arsc_message"], ENT_NOQUOTES), NULL, NULL, 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__);
 if (get_magic_quotes_gpc() == 1 OR get_magic_quotes_runtime() == 1)
 {
  $arsc_message = stripslashes($arsc_message);
 }
 // User Preprocessing
 $arsc_message = arsc_message_preprocessing($arsc_message, $arsc_my["room"], $arsc_api->getRoomType($arsc_my["room"]));
 // Message queueing
 if($_GET["arsc_toqueue"] != "") $arsc_toqueue = arsc_validateinput($_GET["arsc_toqueue"], array("0", "1"), NULL, 1, 1, __FILE__, __LINE__);
 if($arsc_toqueue == 1 AND $arsc_my["level"] >= 30)
 {
  $arsc_api->addToQueue($arsc_api->getRoomId($arsc_my["room"]), $_GET["arsc_moderate_user"], stripslashes($_GET["arsc_message"]));
 }
 else
 {
  // Check for moderated message acknowledged by VIP or Moderator FIXME: Do we still need this?
  $arsc_message_sid = $arsc_my["sid"];
  $arsc_flag_moderated = 0;
  if($_GET["arsc_moderate_sid"] != "") $arsc_moderate_sid = arsc_validateinput($_GET["arsc_moderate_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__);
  if($arsc_moderate_sid <> "")
  {
   if($arsc_my["level"] >= 20)
   {
    $arsc_message_sid = $arsc_moderate_sid;
    $arsc_flag_moderated = 1;
   }
  }
  if ($arsc_api->handleReceivedMessage($arsc_message_sid, $arsc_message, "../../../", $arsc_flag_moderated))
  {
   $arsc_chatversion = arsc_validateinput($_GET["arsc_chatversion"], array("browser_push", "browser_xmlhttprequest", "browser_socket", "browser_refresh", "browser_text"), NULL, NULL, NULL, __FILE__, __LINE__);
   if ($arsc_chatversion == "browser_refresh")
   {
    header("Location: input.php?arsc_sid=".$arsc_my["sid"]);
    die();
   }
   elseif ($arsc_chatversion == "browser_text")
   {
    header("Location: ../../".$arsc_chatversion."/index.php?arsc_sid=".$arsc_my["sid"]);
    die();
   }
   header("Location: empty.php");
   die();
  }
  else
  {
   header("Location: empty.php");
   die();
  }
 }
 header("Location: empty.php");
 die();
}
header("Location: empty.php");
die();

?>
