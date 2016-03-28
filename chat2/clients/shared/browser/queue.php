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
 if ($arsc_api->userIsValid($arsc_my["user"]) AND $arsc_my["level"] >= 20)
 {
  $arsc_delqueueid = arsc_validateinput($_GET["arsc_delqueueid"], NULL, "/[^0-9]/", 1, 32, __FILE__, __LINE__);
  if($arsc_delqueueid <> "")
  {
   $arsc_api->deleteFromQueue($arsc_delqueueid);
  }
  $arsc_sendanswer = arsc_validateinput($_GET["arsc_sendanswer"], NULL, "/[^0-9]/", 1, 1, __FILE__, __LINE__);
  $arsc_answerqueueid = arsc_validateinput($_GET["arsc_answerqueueid"], NULL, "/[^0-9]/", 1, 32, __FILE__, __LINE__);
  if($arsc_sendanswer == 1)
  {
   if($arsc_answerqueueid <> "")
   {
    $arsc_answerqueueentry = $arsc_api->getQueueEntry($arsc_answerqueueid);
    $arsc_user_values = $arsc_api->getUserValuesByName($arsc_answerqueueentry["user"]);
    $arsc_user_sid = $arsc_user_values["sid"];
    if($arsc_user_sid == "")
    {
     $arsc_user_sid = $arsc_my["sid"];
     $arsc_answerqueueentry["message"] = $arsc_answerqueueentry["user"].": ".$arsc_answerqueueentry["message"];
    }
    $arsc_api->handleReceivedMessage($arsc_user_sid, arsc_validateinput($arsc_answerqueueentry["message"], NULL, NULL, 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__), "../../../", 1);
    $arsc_api->deleteFromQueue($arsc_answerqueueid);
   }
   $arsc_answer = arsc_validateinput(htmlspecialchars($_GET["arsc_answer"], ENT_NOQUOTES), NULL, NULL, 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__);
   if (get_magic_quotes_gpc() == 1 OR get_magic_quotes_runtime() == 1)
   {
    $arsc_answer = stripslashes($arsc_answer);
   }
   $arsc_api->handleReceivedMessage($arsc_my["sid"], $arsc_answer, "../../../", 0);
   header("Location: queue.php?arsc_sid=".$arsc_my["sid"]);
   die();
  }
  if($arsc_answerqueueid >= 1)
  {
   $arsc_answerqueueentry = $arsc_api->getQueueEntry($arsc_answerqueueid);
   $arsc_current["answerqueuemessage"] = $arsc_answerqueueentry["user"].": ".$arsc_answerqueueentry["message"];
   $arsc_current["answerqueueid"] = $arsc_answerqueueid;
   $arsc_current["queueentries"] = "";
  }
  else
  {
   $arsc_current["answerqueueid"] = "";
   $arsc_current["answerqueuemessage"] = "";
   header("Expires: Wed, 4 Oct 1978 10:32:45 GMT");
   header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
   header("Cache-Control: no-cache, must-revalidate");
   header("Pragma: no-cache");
   header("Content-Type: text/html");
   header("Refresh: ".ARSC_PARAMETER_QUEUE_REFRESH."; URL=queue.php?arsc_sid=".$arsc_my["sid"]."&arsc_rand=".rand(0, 100));
   $arsc_current["queueentries"] = "";
   $arsc_api->getRoomId($arsc_my["room"]);
   $arsc_queueentries = $arsc_api->getQueueEntries($arsc_api->getRoomId($arsc_my["room"]));
   if(is_array($arsc_queueentries))
   {
    krsort($arsc_queueentries);
    reset($arsc_queueentries);
    while(list($arsc_key, $arsc_val) = each($arsc_queueentries))
    {
     $arsc_current["queueentries"] .= '<small>[<a href="queue.php?arsc_sid='.$arsc_my["sid"].'&arsc_delqueueid='.$arsc_val["id"].'">'.$arsc_lang["moderatorqueue_delete"].'</a>]</small> '.$arsc_val["user"].': <a href="queue.php?arsc_sid='.$arsc_my["sid"].'&arsc_answerqueueid='.$arsc_val["id"].'">'.$arsc_val["message"].'</a><br>
     
     ';
    }
   }
  }
  echo $arsc_api->parseLayoutTemplate("queue");
 }
}
else
{
 die();
}
?>
