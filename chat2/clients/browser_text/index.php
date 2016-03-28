<?php

include("../../base/inc/config.inc.php");
include("../../base/inc/init.inc.php");
include("../../base/inc/functions.inc.php");
include("../../base/inc/inputvalidation.inc.php");
include("../../base/inc/api.inc.php");
include("../../base/inc/filter.inc.php");

$arsc_api = new arsc_api_Class;

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 include("../../languages/".$arsc_my["language"].".inc.php");
 
 if ($arsc_api->userIsValid($arsc_my["user"]))
 {
  if($arsc_my["lastmessageping"] == 0)
  {
   $arsc_my["lastmessageping"] = $arsc_api->setLastMessagePing($arsc_my);
  }
  $arsc_enter = arsc_validateinput($_GET["arsc_enter"], array("", "true"), NULL, 0, 4, __FILE__, __LINE__);
  if ($arsc_enter == "true")
  {
   $arsc_api->postMessage($arsc_my["room"], "arsc_user_enter~~".$arsc_my["user"]."~~".$arsc_api->getReadableRoomname($arsc_my["room"]), "System", date("H:i:s"), arsc_microtime(), 0);
  }
  header("Expires: Sun, 28 Dec 1997 09:32:45 GMT");
  header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache");
  header("Content-Type: text/html");

  // We get them messages twice, because of roomchanges
  $arsc_messages = $arsc_api->getMessages($arsc_my["lastmessageping"], $arsc_my["room"], $arsc_my["template"], "DESC");
  $arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__));
  $arsc_messages = $arsc_api->getMessages($arsc_my["lastmessageping"], $arsc_my["room"], $arsc_my["template"], "DESC");

  ?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
  <html>
   <head>
    <title>
     <?php echo ARSC_PARAMETER_TITLE; ?>
    </title>
   </head>
   <body>
    <form action="../shared/browser/chatins.php" METHOD="GET">
     <a href="index.php?arsc_sid=<?php echo $arsc_my["sid"]; ?>"><?php echo $arsc_lang["refreshmessages"]; ?></a>
     <input type="hidden" name="arsc_sid" value="<?php echo $arsc_my["sid"]; ?>">
     <input type="hidden" name="arsc_chatversion" value="<?php echo $arsc_my["version"]; ?>">
     <input type="text" name="arsc_message" size="30" maxlength="<?php echo ARSC_PARAMETER_INPUT_MAXSIZE; ?>" value="<?php echo arsc_validateinput($_GET["arsc_pretext"], NULL, NULL, 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__); ?>">
     <input type="submit" value="<?php echo $arsc_lang["sendmessage"]; ?>">
     <a href="../../base/logout.php?arsc_sid=<?php echo $arsc_my["sid"]; ?>&arsc_post_logout=true"><?php echo $arsc_lang["leave"]; ?></a>
    </form>
    <hr>
    <?php
    set_magic_quotes_runtime(0);
    echo $arsc_lang["usersinroom"]." ".$arsc_api->getReadableRoomname($arsc_my["room"]).": ";
    $arsc_userlist = $arsc_api->getSimpleUserlistWithRights($arsc_my["room"]);
    while(list($arsc_userlist_user, $arsc_userlist_level) = each($arsc_userlist))
    {
     $arsc_opstring = "";
     if ($arsc_userlist_level >= 10)
     {
      $arsc_opstring = "@";
     }
     if ($arsc_userlist_level >= 30)
     {
      $arsc_opstring = "<b>@</b>";
     }
     if ($arsc_userlist_user == $arsc_my["user"])
     {
      echo "<i>".$arsc_opstring.$arsc_userlist_user."</i>\n";
     }
     else
     {
      echo "<a href=\"index.php?arsc_sid=".$arsc_my["sid"]."&arsc_pretext=".urlencode("/msg ".$arsc_userlist_user." ")."\">".$arsc_opstring.$arsc_userlist_user."</a>\n";
     }
    }
    echo "<br>";
    echo $arsc_lang["roomlist"].": ";
    $arsc_roomlist = $arsc_api->getReadableRoomlist();
    while(list($arsc_roomlist_roomname, $arsc_roomlist_roomname_nice) = each($arsc_roomlist))
    {
     echo "[<a href=\"../shared/browser/chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_chatversion=".$arsc_my["version"]."&arsc_message=".urlencode("/room ".$arsc_roomlist_roomname_nice." ")."\">".$arsc_roomlist_roomname_nice."</a>]\n";
    }
    echo "<hr>";
    echo $arsc_messages[0];
    $arsc_template_varname = "arsc_template_".$arsc_my["template"];
    if($arsc_enter)
    {
     if(ARSC_PARAMETER_WELCOME_MESSAGE <> "") echo arsc_filter_posting("System", date("H:i:s"), "/msg ".$arsc_my["user"]." ".ARSC_PARAMETER_WELCOME_MESSAGE, $arsc_my["room"], 0, 0, 0, $$arsc_template_varname);
     echo arsc_filter_posting("System", date("H:i:s"), "/msg ".$arsc_my["user"]." ".str_replace("{title}", ARSC_PARAMETER_TITLE, $arsc_lang["welcome"]), $arsc_my["room"], 0, 0, 0, $$arsc_template_varname);
    }
    $arsc_api->setUserValueByName("lastping", time(), $arsc_my["user"]);
    $arsc_api->setUserValueByName("flag_idle", 0, $arsc_my["user"]);
    $arsc_api->setUserValueByName("ip", getenv("REMOTE_ADDR"), $arsc_my["user"]);
    ?>
   </body>
  </html>
  <?php
 }
}
else
{
 header("Location: ../../base/why.php?arsc_language=".$arsc_language);
 die();
}

?>
