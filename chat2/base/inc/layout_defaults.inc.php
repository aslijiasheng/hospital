<?php

$arsc_result = mysql_query("SELECT roomname, roomname_nice FROM arsc_rooms WHERE owner = '-1' ORDER BY type", ARSC_PARAMETER_DB_LINK);
while ($arsc_a = mysql_fetch_array($arsc_result))
{
 $arsc_room = $arsc_a["roomname"];
 $arsc_option .= "<option value=\"".$arsc_room."\">".$arsc_a["roomname_nice"]." </option>\n";
}
$arsc_layout["room_selection"] = '
<select name="arsc_room">
'.$arsc_option.'
</select>
';

$arsc_layout["chatversion_selection"] = '
<select name="arsc_chatversion">
';
if (ARSC_PARAMETER_SOCKETSERVER_USE == "yes")
{
 $arsc_layout["chatversion_selection"] .= '
 <option value="browser_socket">'.$arsc_lang["version_browser_socket"].'</option>
';
}
$arsc_selected = "";
if(eregi("Lynx|w3m|links", $_SERVER["HTTP_USER_AGENT"])) $arsc_textselected = " selected";
if (ARSC_PARAMETER_DISABLE_BROWSER_PUSH != "yes")
{
 $arsc_layout["chatversion_selection"] .= '
 <option value="browser_push"'.$arsc_pushselected.'>'.$arsc_lang["version_browser_push"].'</option>
';
}
$arsc_layout["chatversion_selection"] .= '
 <option value="browser_xmlhttprequest">'.$arsc_lang["version_browser_xmlhttprequest"].'</option>
 <option value="browser_refresh">'.$arsc_lang["version_browser_refresh"].'</option>
 <option value="browser_text"'.$arsc_textselected.'>'.$arsc_lang["version_browser_text"].'</option>
</select>
';
$arsc_selected = "";


$arsc_roomlist = $this->getInternalRoomlist();
while (list($arsc_key, $arsc_val) = each($arsc_roomlist))
{
 $arsc_userlist = $this->getUserlist($arsc_val);
 if (is_array($arsc_userlist))
 {
  while (list($arsc_keyu, $arsc_valu) = each($arsc_userlist))
  {
   $arsc_line .= "<tr>\n<td width=\"50%\" valign=\"top\">\n<font face=\"".$arsc_layout["default_font_face"]."\" size=\"".$arsc_layout["default_font_size"]."\" color=\"".$arsc_layout["default_font_color"]."\">\n";
   $arsc_line .= $arsc_keyu;
   if($arsc_valu["flag_idle"] == 1) $arsc_line .= "*";
   $arsc_line .= "</font>\n</td>\n<td width=\"50%\" valign=\"top\">\n<font face=\"".$arsc_layout["default_font_face"]."\" size=\"".$arsc_layout["default_font_size"]."\" color=\"".$arsc_layout["default_font_color"]."\">\n";
   $arsc_line .= $this->getReadableRoomname($arsc_val);
   $arsc_line .= "</font>\n</td>\n</tr>\n";
  }
 }
}
$arsc_layout["usersinchat_table"] = "<table width=\"100%\">".$arsc_line."</table>";


if ($arsc_my["version"] == "browser_socket" OR $arsc_my["version"] == "browser_push" OR $arsc_my["version"] == "browser_xmlhttprequest")
{
 $arsc_layout["scrolling_form"] = '
<form name="scrollform">
 <input type="checkbox" name="scrollcheck" value="true" OnClick="scrolling()" checked>
 <font face="'.$arsc_layout["default_font_face"].'" size="'.$arsc_layout["default_font_size"].'" color="'.$arsc_layout["default_font_color"].'">
  '.$arsc_lang["scroll_active"].'
 </font>
</form>
';
}
else $arsc_layout["scrolling_form"] = '';


if ($arsc_my["version"] == "browser_socket" OR $arsc_my["version"] == "browser_push" OR $arsc_my["version"] == "browser_xmlhttprequest")
{
 $arsc_layout["scrolling_script"] = '
<script language="JavaScript">
 <!--
  function scrolling()
  {
   if (document.scrollform.scrollcheck.checked)
   {
    parent.msg.scroll_active=true;
   }
   else
   {
    parent.msg.scroll_active=false;
   }
  }
 //-->
</script>
';
}
else $arsc_layout["scrolling_script"] = '';


if ($arsc_my["version"] == "browser_socket" OR $arsc_my["version"] == "browser_push" OR $arsc_my["version"] == "browser_xmlhttprequest")
{
 $arsc_layout["help_script"] = '
<script language="JavaScript">
 <!--
  function open_help()
  {
   window.open(\'./help.php?arsc_sid='.$arsc_my["sid"].'\', \'Help\', \'toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=500,height=500\');
  }
 //-->
</script>
';
 $arsc_layout["help_link"] = '
<a href="javascript:open_help();">'.$arsc_lang["helplink"].'</a>
';
}
else
{
 $arsc_layout["help_script"] = '';
 $arsc_layout["help_link"] = '
<a href="./help.php?arsc_sid='.$arsc_my["sid"].'" target="_blank">'.$arsc_lang["helplink"].'</a>
';
}


// FIXME(?)
$arsc_layout["drawboard_script"] = '';
$arsc_layout["drawboard_link"] = '';


$arsc_layout["currentroom"] = $this->getReadableRoomname($arsc_my["room"]);


if ($arsc_current["reloadallframes"] == 1)
{
 $arsc_layout["reloadallframes_script"] = '
<script language="JavaScript">
<!--
  for (var i=0;i<reloadableFrames.length;i++)
  {
   for (var j=0;j<top.frames.length;j++)
   {
    if (top.frames[j].name == reloadableFrames[i])
    top.frames[j].location.reload();
   }
  }
//-->
</script>
';
}
else $arsc_layout["reloadallframes_script"] = '';


if ($arsc_current["user_got_kicked"] > 0)
{
 $arsc_layout["kickuser_script"] = '
<script language="JavaScript">
<!--
 top.location.href = "'.ARSC_PARAMETER_BASEURL.'base/why.php?arsc_code='.$arsc_current["user_got_kicked"].'&arsc_language='.arsc_validateinput($_GET["arsc_language"], NULL, "/[^a-z\-]/", 0, 64, __FILE__, __LINE__).'";
//-->
</script>
';
}
else $arsc_layout["kickuser_script"] = '';


if ($arsc_my["version"] == "browser_socket" OR $arsc_my["version"] == "browser_push" OR $arsc_my["version"] == "browser_xmlhttprequest")
{
 $arsc_layout["idcard_script"] = '
<script language="JavaScript">
<!--
 function idcard(arsc_user)
 {
  window.open(\'./idcard/index.php?arsc_sid='.$arsc_my["sid"].'&arsc_user=\' + arsc_user, \''.rand().'\', \'toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=300,height=500\');
 }
//-->
</script>
';
}
else $arsc_layout["idcard_script"] = '';


if ($this->checkCommandAllowed($arsc_my["level"], "userlist"))
{
 $arsc_layout["userlist"] = '<table width="100%">';
 $arsc_userlist = $this->getSimpleUserlistWithRights($arsc_my["room"]);
 if (is_array($arsc_userlist))
 {
  reset($arsc_userlist);
  while (list($arsc_key, $arsc_val) = each($arsc_userlist))
  {
   $arsc_layout["userlist"] .= '<tr> <td bgcolor="'.$arsc_layout["default_foreground_color"].'"> ';
   $arsc_opstring = "";
   // ID Card
   $arsc_result = mysql_query("SELECT COUNT(user) AS cnt FROM arsc_registered_users WHERE user = '$arsc_key'", ARSC_PARAMETER_DB_LINK);
   $arsc_a = mysql_fetch_array($arsc_result);
   if ($arsc_a["cnt"] == 1)
   {
    $arsc_layout["userlist"] .= '<font face="'.$arsc_layout["small_font_face"].'" size="'.$arsc_layout["small_font_size"].'" color="'.$arsc_layout["small_font_color"].'">';
    if ($arsc_my["version"] == "browser_socket" OR $arsc_my["version"] == "browser_push" OR $arsc_my["version"] == "browser_xmlhttprequest")
    {
     $arsc_layout["userlist"] .= '<a href="javascript:idcard(\''.$arsc_key.'\');" title="'.$arsc_lang["cmd_idcard"].'">ID</a> ';
    }
    else
    {
     $arsc_layout["userlist"] .= '<a href="./idcard/index.php?arsc_sid='.$arsc_my["sid"].'" title="'.$arsc_lang["cmd_idcard"].'" target="_blank">ID</a> ';
    }
    $arsc_layout["userlist"] .= '</font>';
   }
   if ($arsc_val > 10)
   {
    $arsc_opstring = "<font face=\"".$arsc_layout["default_font_face"]."\" size=\"".$arsc_layout["default_font_size"]."\" color=\"".$arsc_layout["default_font_color"]."\">@";
   }
   elseif ($arsc_val == 99)
   {
    $arsc_opstring = "<font face=\"".$arsc_layout["default_font_face"]."\" size=\"".$arsc_layout["default_font_size"]."\" color=\"".$arsc_layout["default_font_color"]."\"><b>@</b>";
   }
   else
   {
    $arsc_opstring = "<font face=\"".$arsc_layout["default_font_face"]."\" size=\"".$arsc_layout["default_font_size"]."\" color=\"".$arsc_layout["default_font_color"]."\">";
   }
   if ($arsc_key == $arsc_my["user"])
   {
    $arsc_layout["userlist"] .= '<i>'.$arsc_opstring.$arsc_key.'</i></font> ';
   }
   else
   {
    if ($arsc_my["level"] >= 1)
    {
     $arsc_layout["userlist"] .= '<font face="'.$arsc_layout["small_font_face"].'" size="'.$arsc_layout["small_font_size"].'" color="'.$arsc_layout["small_font_color"].'">';
     // whois
     if ($this->checkCommandAllowed($arsc_my["level"], "whois")) $arsc_layout["userlist"] .= "<a href=\"chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode("/whois ".$arsc_key."")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"empty\" title=\"".$arsc_lang["opcmd_w"]."\">W</a> ";
     // kick
     if ($this->checkCommandAllowed($arsc_my["level"], "kick")) $arsc_layout["userlist"] .= "<a href=\"chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode("/kick ".$arsc_key."")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"empty\" title=\"".$arsc_lang["opcmd_k"]."\">K</a> ";
     // bann
     if ($this->checkCommandAllowed($arsc_my["level"], "bann")) $arsc_layout["userlist"] .= "<a href=\"input.php?arsc_sid=".$arsc_my["sid"]."&arsc_pretext=".urlencode("/bann ".$arsc_key." 120")."\" target=\"input\" title=\"".$arsc_lang["opcmd_b"]."\">B</a> ";
     // Lock (if registered)
     if ($this->checkCommandAllowed($arsc_my["level"], "lock")) $arsc_layout["userlist"] .= "<a href=\"chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode("/lock ".$arsc_key."")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"empty\" title=\"".$arsc_lang["opcmd_l"]."\">L</a> ";
     // R.I.P.
     if ($this->checkCommandAllowed($arsc_my["level"], "rip")) $arsc_layout["userlist"] .= "<a href=\"chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode("/rip ".$arsc_key."")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"empty\" title=\"".$arsc_lang["opcmd_r"]."\">R</a> ";
     // Un-R.I.P.
     if ($this->checkCommandAllowed($arsc_my["level"], "unrip")) $arsc_layout["userlist"] .= "<a href=\"chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode("/unrip ".$arsc_key."")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"empty\" title=\"".$arsc_lang["opcmd_u"]."\">U</a> ";
     // Give OP
     if ($this->checkCommandAllowed($arsc_my["level"], "op")) $arsc_layout["userlist"] .= "<a href=\"chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode("/op ".$arsc_key."")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"empty\" title=\"".$arsc_lang["opcmd_o"]."\">O</a> ";
     // DeOP
     if ($this->checkCommandAllowed($arsc_my["level"], "deop")) $arsc_layout["userlist"] .= "<a href=\"chatins.php?arsc_sid=".$arsc_my["sid"]."&arsc_message=".urlencode("/deop ".$arsc_key."")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"empty\" title=\"".$arsc_lang["opcmd_d"]."\">D</a> ";
     // Move
     if ($this->checkCommandAllowed($arsc_my["level"], "move")) $arsc_layout["userlist"] .= "<a href=\"input.php?arsc_sid=".$arsc_my["sid"]."&arsc_pretext=".urlencode("/move ".$arsc_key."")." room\" target=\"input\" title=\"".$arsc_lang["opcmd_m"]."\">M</a>";
     $arsc_layout["userlist"] .= "</font> ";
    }
    // Send a message
    $arsc_layout["userlist"] .= "<a href=\"input.php?arsc_sid=".$arsc_my["sid"]."&arsc_pretext=".urlencode("/msg ".$arsc_key." ")."&arsc_chatversion=".$arsc_my["version"]."\" target=\"input\" title=\"".$arsc_lang["cmd_m"]."\">".$arsc_opstring.$arsc_key."</a></font><br> ";
   }
   $arsc_layout["userlist"] .= "</td>";
   $arsc_layout["userlist"] .= "</tr>";
  }
  $arsc_layout["userlist"] .= '</table>';
 }
}
else
{
 $arsc_layout["userlist"] .= '';
}

if ($this->checkCommandAllowed($arsc_my["level"], "color"))
{
 $arsc_layout["colorselection_title"] = $arsc_lang["select_color"];
}

if ($this->checkCommandAllowed($arsc_my["level"], "color"))
{
 $arsc_layout["colorselection_table"] = '
<table width="100%" border="0" cellspacing="3" cellpadding="0" bgcolor="'.$arsc_layout["default_foreground_color"].'">
 <tr>
  <td width="15" bgcolor="#'.$arsc_my["color"].'"><img src="../../../base/pic/x.gif" border="2" width="15" height="20" alt="#'.$arsc_my["color"].'"></td>';
 $arsc_chatcolors = explode(",", ARSC_PARAMETER_CHATCOLORS);
 for ($arsc_chatcolor_i = 0; $arsc_chatcolor_i < count($arsc_chatcolors); $arsc_chatcolor_i++)
 {
  $arsc_layout["colorselection_table"] .='<td bgcolor="#'.$arsc_chatcolors[$arsc_chatcolor_i].'"><a href="changecolor.php?arsc_sid='.$arsc_my["sid"].'&arsc_color='.$arsc_chatcolors[$arsc_chatcolor_i].'"><img src="../../../base/pic/x.gif" border="0" width="5" height="20" alt="#'.$arsc_chatcolors[$arsc_chatcolor_i].'"></a></td>';
  if ($arsc_chatcolor_i == (round(count($arsc_chatcolors)/2)-1)) $arsc_layout["colorselection_table"] .= '</tr><tr><td>&nbsp;</td>';
 }
 $arsc_layout["colorselection_table"] .='</tr></table>';
} else $arsc_layout["colorselection_table"] = '';

if ($this->checkCommandAllowed($arsc_my["level"], "roomlist"))
{
 $arsc_currentroom = $this->getReadableRoomname($arsc_my["room"]);
 $arsc_roomlist = $this->getReadableRoomlist();
 while (list($arsc_key, $arsc_val) = each($arsc_roomlist))
 {
  if ($arsc_val == $arsc_currentroom) $arsc_selected = " selected"; else $arsc_selected = "";
  $arsc_roomlist_select .= "<option value=\"/room ".$arsc_val."\"".$arsc_selected.">".$arsc_val."</option> ";
 }

 $arsc_layout["roomlist_form"] = '
 <form action="chatins.php" target="empty">
  <font face="'.$arsc_layout["default_font_face"].'" size="'.$arsc_layout["default_font_size"].'" color="'.$arsc_layout["default_font_color"].'">
   <b>
    '.$arsc_lang["roomlist"].':
   </b>
  </font>
  <input type="hidden" name="arsc_sid" value="'.$arsc_my["sid"].'">
  <input type="hidden" name="arsc_chatversion" value="'.$arsc_my["version"].'">
  <select name="arsc_message">
   '.$arsc_roomlist_select.'
  </select>
  <input type="submit" value="'.$arsc_lang["go_room"].'">
 </form>';
}
else $arsc_layout["roomlist_form"] = '';


if (ARSC_PARAMETER_KEEP_SENDED_MESSAGE == "yes")
{
 $arsc_layout["msginput_script"] = '
<script language="Javascript">
 <!--
  scroll_active = true;
  function empty_field_and_submit()
  {
   document.fdummy.arsc_message.value=document.f.arsc_message.value;
   document.fdummy.arsc_random.value=Math.random();
   document.fdummy.submit();
   document.f.arsc_message.focus();
   document.f.arsc_message.select();
   return false;
  }
 // -->
</script>
';
 $arsc_layout["msginput_onload"] = 'document.f.arsc_message.focus();document.f.arsc_message.select();';

}
else
{
 $arsc_layout["msginput_script"] = '
<script language="Javascript">
 <!--
  scroll_active = true;
  function empty_field_and_submit()
  {
   document.fdummy.arsc_message.value=document.f.arsc_message.value;
   document.fdummy.arsc_random.value=Math.random();
   document.fdummy.submit();
   document.f.arsc_message.value=\'\';
   document.f.arsc_message.focus();
   return false;
  }
 // -->
</script>
';
 $arsc_layout["msginput_onload"] = 'document.f.arsc_message.focus();';
}

$arsc_layout["pretext"] = $_GET["arsc_pretext"]; //FIXME Check, and maybe even better use arsc_current where it is needed!
?>
