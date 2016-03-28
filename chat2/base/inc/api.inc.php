<?php

class arsc_api_Class // FIXME: All SQL queries must come here one day.
{

 function makeCleanUsername($user)
 {
  $user = str_replace(" ", "_", $user);
  $user = str_replace("ß", "ss", $user);
  $user = str_replace("\'", "", $user);
  $user = preg_replace("/['´`^|°\.:;<>=\!\"\?§²³#\*+~\/\%&\{\[\]\}]/", "", $user);
  $user = preg_replace("/[äÄáÁàÀâÂ]/", "a", $user);
  $user = preg_replace("/[éÉèÈêÊ]/", "e", $user);
  $user = preg_replace("/[íÍìÌîÎ]/", "i", $user);
  $user = preg_replace("/[öÖóÓòÒôÔ]/", "o", $user);
  $user = preg_replace("/[üÜúÚùÙûÛ]/", "u", $user);
  return($user);
 }

 function getUserValuesBySID($sid)
 {
  $query = mysql_query("SELECT user, lastping, ip, room, language, color, version, template, layout, level, flag_ripped, sid, lastmessageping, showsince FROM arsc_users WHERE sid = '".mysql_escape_string($sid)."'", ARSC_PARAMETER_DB_LINK);
  $result = mysql_fetch_array($query);
  if($result["sid"] != "")
  {
   return $result;
  }
  else
  {
   return FALSE;
  }
 }

 function getUserValuesByName($name)
 {
  if ($result = mysql_query("SELECT id, user, lastping, ip, room, language, version, template, layout, color, level, flag_ripped, sid, lastmessageping, showsince, flood_count, flood_lastmessage FROM arsc_users WHERE user = '".mysql_escape_string($name)."'", ARSC_PARAMETER_DB_LINK))
  {
   return mysql_fetch_array($result);
  }
  else
  {
   return FALSE;
  }
 }

 function getUserValueByName($value_name, $name)
 {
  if ($result = mysql_query("SELECT $value_name FROM arsc_users WHERE user = '$name'", ARSC_PARAMETER_DB_LINK))
  {
   $a = mysql_fetch_array($result);
   return $a[$value_name];
  }
  else
  {
   return FALSE;
  }
 }
 
 function getUserValueByValue($get_value_name, $find_value_name, $find_value_value)
 {
  if ($result = mysql_query("SELECT $get_value_name FROM arsc_users WHERE $find_value_name = '$find_value_value'", ARSC_PARAMETER_DB_LINK))
  {
   $a = mysql_fetch_array($result);
   return $a[$get_value_name];
  }
  else
  {
   return FALSE;
  }
 }
 
 function setUserValueByName($value_name, $value, $name)
 {
  if ($result = mysql_query("UPDATE arsc_users SET $value_name = '$value' WHERE user = '$name'", ARSC_PARAMETER_DB_LINK))
  {
   return TRUE;
  }
  else
  {
   return FALSE;
  }
 }
 
 function getRegisteredUserValuesByName($name)
 {
  if ($result = mysql_query("SELECT id, user, password, admin_sessionid, language, level, color, template, layout, email, sex, location, hobbies, flag_guestbook, flag_locked FROM arsc_registered_users WHERE user = '".mysql_escape_string($name)."'", ARSC_PARAMETER_DB_LINK))
  {
   return mysql_fetch_array($result);
  }
  else
  {
   return FALSE;
  }
 }
 
 function userIsValid($user)
 {
  $result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_users WHERE user = '".mysql_escape_string($user)."' AND level >= '0'", ARSC_PARAMETER_DB_LINK);
  $a = mysql_fetch_array($result);
  if ($a["cnt"] == 1)
  {
   return TRUE;
  }
  else
  {
   return FALSE;
  }
 }

 function userExists($user)
 {
  if($query = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_users WHERE user = '".mysql_escape_string($user)."'", ARSC_PARAMETER_DB_LINK))
  {
   $result = mysql_fetch_array($query);
   if($result["cnt"] == 1)
   {
    return TRUE;
   }
   else
   {
    return FALSE;
   }
  }
  else
  {
   return FALSE;
  }
 }

 function setLastMessagePing($my)
 {
  $query = mysql_query("SELECT room, lastmessageping FROM arsc_users WHERE user = '".mysql_escape_string($my["user"])."'", ARSC_PARAMETER_DB_LINK);
  $result = mysql_fetch_array($query);
  if($result["lastmessageping"] != -1)
  {
   $query = mysql_query("SELECT id FROM arsc_room_".mysql_escape_string($result["room"])." ORDER BY id DESC LIMIT 1", ARSC_PARAMETER_DB_LINK);
   $result = mysql_fetch_array($query);
   $this->setUserValueByName("lastmessageping", $result["id"], $my["user"]);
   return($result["id"]);
  }
  else
  {
   $this->setUserValueByName("lastmessageping", -2, $my["user"]);
   return(0);
  }
 }

 function createRoom($roomname_nice, $description, $owner, $password, $type, $layout_id)
 {
  $roomname = $this->makeInternalRoomname($roomname_nice);
  if ($roomname <> "")
  {
   $query = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_rooms WHERE roomname = '".$roomname."'", ARSC_PARAMETER_DB_LINK);
   $result = mysql_fetch_array($query);
   if($result["cnt"] == 0)
   {
    mysql_query("INSERT INTO arsc_rooms (roomname, roomname_nice, description, owner, password, type, layout_id) VALUES ('".$roomname."', '".$roomname_nice."', '".$description."', '".$owner."', '".$password."', '".$type."', '".$layout_id."')", ARSC_PARAMETER_DB_LINK);
    mysql_query("CREATE TABLE arsc_room_$roomname (id int(11) NOT NULL auto_increment,
                                                        message text NOT NULL,
                                                        user varchar(64) NOT NULL default '',
                                                        flag_ripped tinyint(4) NOT NULL default '0',
						                                                 	flag_gotmsg tinyint(4) NOT NULL default '0',
                                                        flag_moderated tinyint(4) NOT NULL default '0',
                                                        sendtime time NOT NULL default '00:00:00',
                                                        timeid bigint(20) NOT NULL default '0',
                                                        PRIMARY KEY (id),
                                                        KEY timeid (timeid),
                                                        KEY flag_ripped (flag_ripped)
                                                       )", ARSC_PARAMETER_DB_LINK);
    return(true);
   }
   else
   {
    return(false);
   }
  }
  else
  {
   return(false);
  }
 }
 
 function deleteRoom($id)
 {
  $query = mysql_query("SELECT roomname FROM arsc_rooms WHERE id = '".mysql_escape_string($id)."'", ARSC_PARAMETER_DB_LINK);
  $result = mysql_fetch_array($query);
  mysql_query("DELETE FROM arsc_rooms WHERE id = '".mysql_escape_string($id)."'", ARSC_PARAMETER_DB_LINK);
  mysql_query("DROP TABLE arsc_room_".mysql_escape_string($result["roomname"]), ARSC_PARAMETER_DB_LINK);
 }
 
 function getReadableRoomname($room)
 {
  $result = mysql_query("SELECT roomname_nice FROM arsc_rooms WHERE roomname = '$room'", ARSC_PARAMETER_DB_LINK);
  $a = mysql_fetch_array($result);
  return $a["roomname_nice"];
 }

 function getInternalRoomname($room)
 {
  $query = mysql_query("SELECT roomname FROM arsc_rooms WHERE roomname_nice = '".mysql_escape_string($room)."'", ARSC_PARAMETER_DB_LINK);
  $result = mysql_fetch_array($query);
  return $result["roomname"];
 }

 function getRoomId($room)
 {
  $query = mysql_query("SELECT id FROM arsc_rooms WHERE roomname = '".mysql_escape_string($room)."'", ARSC_PARAMETER_DB_LINK);
  $result = mysql_fetch_array($query);
  return $result["id"];
 }

 function makeInternalRoomname($room)
 {
  $room = trim(strtolower(str_replace(" ", "_", $room)));
  $disallowed = "/[^a-zA-Z0-9_]/";
  $replacement = "";
  $room = preg_replace($disallowed, $replacement, $room);
  if(trim($room) == "") $room = "";
  return(substr($room, 0, 32));
 }

 function getReadableRoomlist()
 {
  $result = mysql_query("SELECT roomname, roomname_nice, owner FROM arsc_rooms ORDER BY owner", ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   if ($a["owner"] == -1)
   {
    $return[$a["roomname"]] = $a["roomname_nice"];
   }
  }
  reset($return);
  return($return);
 }

 function getInternalRoomlist()
 {
  $result = mysql_query("SHOW tables LIKE 'arsc\_room\_%'", ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   if ($a[0] <> "")
   {
    $return[] = substr($a[0], 10);
   }
  }
  reset($return);
  return($return);
 }
 
 function getRoomType($roomname)
 {
  $query = mysql_query("SELECT type FROM arsc_rooms WHERE roomname = '".mysql_escape_string($roomname)."'", ARSC_PARAMETER_DB_LINK);
  $result = mysql_fetch_array($query);
  return($result["type"]);
 }

 function getUserlist($room)
 {
  $query = mysql_query("SELECT * FROM arsc_users WHERE room = '".mysql_escape_string($room)."' ORDER BY level DESC, user ASC", ARSC_PARAMETER_DB_LINK);
  while ($result = mysql_fetch_array($query))
  {
   $return[$result["user"]] = $result;
  }
  return($return);
 }

 function getSimpleUserlist($room)
 {
  $result = mysql_query("SELECT user FROM arsc_users WHERE room = '".mysql_escape_string($room)."' ORDER BY level DESC, user ASC", ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   $return[] = $a["user"];
  }
  return($return);
 }

 function getSimpleUserlistWithRights($room)
 {
  $result = mysql_query("SELECT user, level FROM arsc_users WHERE room = '".mysql_escape_string($room)."' ORDER BY level DESC, user ASC", ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   $return["{$a["user"]}"] = $a["level"];
  }
  return($return);
 }
 
 function getTemplatelist()
 {
  $result = mysql_query("SELECT DISTINCT template FROM arsc_templates", ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   $return[] = $a["template"];
  }
  reset($return);
  return($return);
 }

 function createLayout($name)
 {
  if(mysql_query("INSERT INTO arsc_layouts (name) VALUES ('".mysql_escape_string($name)."')", ARSC_PARAMETER_DB_LINK))
  {
   $query1 = mysql_query("SELECT id FROM arsc_layouts WHERE name = '".mysql_escape_string($name)."'", ARSC_PARAMETER_DB_LINK);
   $result1 = mysql_fetch_array($query1);
   $query2 = mysql_query("SELECT * FROM arsc_layouts WHERE id = '".mysql_escape_string(ARSC_PARAMETER_DEFAULT_LAYOUT_ID)."'", ARSC_PARAMETER_DB_LINK);
   $result2 = mysql_fetch_array($query2);
   while (list($arsc_key, $arsc_val) = each($result2))
   {
    if ($arsc_key <> "id" && $arsc_key <> "name" && !is_numeric($arsc_key))
    {
     $query .= $arsc_key." = '".$arsc_val."', ";
    }
   }
   $query = substr($query, 0, -2);
   mysql_query("UPDATE arsc_layouts SET ".$query." WHERE id = '".mysql_escape_string($result1["id"])."'", ARSC_PARAMETER_DB_LINK);
   return($result1["id"]);
  }
  else
  {
   return(false);
  }
 }

 function getLayoutlist()
 {
  $result = mysql_query("SELECT id, name FROM arsc_layouts", ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   $return["{$a["id"]}"] = $a["name"];
  }
  reset($return);
  return($return);
 }
 
 function getLayoutValues($id)
 {
  $result = mysql_query("SELECT * FROM arsc_layouts WHERE id = ".$id, ARSC_PARAMETER_DB_LINK);
  $a = mysql_fetch_array($result);
  return($a);
 }

 function createUser($user, $password, $room, $language, $template, $version, $ip)
 {
  mt_srand((double)microtime() * 1000000);
  $sid = md5(mt_rand(0, mt_getrandmax()));
  mysql_query("INSERT INTO arsc_users
               (user, lastping, ip, room, language, version, template, sid)
               VALUES
               ('$user', '".time()."', '$ip', '$room', '$language', '$version', '$template', '$sid')", ARSC_PARAMETER_DB_LINK);
  return $sid;
 }
 
 function deleteUser($name)
 {
  mysql_query("DELETE FROM arsc_users WHERE user = '$name'", ARSC_PARAMETER_DB_LINK);
  return TRUE;
 }

 function removeUserFromRoom($my)
 {
  if ($my["user"] <> "")
  {
   //mysql_query("DELETE FROM arsc_users WHERE sid = '".mysql_escape_string($my["sid"])."'", ARSC_PARAMETER_DB_LINK);
   mysql_query("INSERT INTO arsc_room_".mysql_escape_string($my["room"])." (message, user, sendtime, timeid) VALUES ('".mysql_escape_string("arsc_user_quit~~".$my["user"]."~~".$this->getReadableRoomname($my["room"]))."', 'System', '".mysql_escape_string(date("H:i:s"))."', '".mysql_escape_string(arsc_microtime())."')", ARSC_PARAMETER_DB_LINK);
  }
 }

 function getTemplate($template)
 {
  $result = mysql_query("SELECT name, value FROM arsc_templates WHERE template = '$template'", ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   $return["{$a["name"]}"] = $a["value"];
  }
  return $return;
 }

 function getMessages($since, $room, $template, $sort = "ASC")
 {
  $template_varname = "arsc_template_".$template;
  GLOBAL $$template_varname, $arsc_my;
  //echo "SELECT id, message, user, flag_ripped, flag_gotmsg, flag_moderated, sendtime, timeid FROM arsc_room_".mysql_escape_string($room)." USE INDEX(PRIMARY) WHERE id > '".mysql_escape_string($since)."' ORDER BY id ".mysql_escape_string($sort)."<br />";
  $result = mysql_query("SELECT id, message, user, flag_ripped, flag_gotmsg, flag_moderated, sendtime, timeid FROM arsc_room_".mysql_escape_string($room)." USE INDEX(PRIMARY) WHERE id > '".mysql_escape_string($since)."' ORDER BY id ".mysql_escape_string($sort), ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   $message .= arsc_filter_posting($a["user"], $a["sendtime"], str_replace("\n", "#ret#", $a["message"]), $room, $a["flag_ripped"], $a["flag_gotmsg"], $a["flag_moderated"], $$template_varname);
   $return[1] = $a["timeid"];
   $return[2] = $a["id"];
  }
  $return[0] = $message;
  return($return);
 }

 function getRawMessages($since, $room, $template, $sort = "ASC")
 {
  $result = mysql_query("SELECT id, message, user, flag_ripped, flag_gotmsg, flag_moderated, sendtime, timeid FROM arsc_room_".mysql_escape_string($room)." USE INDEX(PRIMARY) WHERE timeid > '".mysql_escape_string($since)."' ORDER BY id ".mysql_escape_string($sort), ARSC_PARAMETER_DB_LINK);
  while ($a = mysql_fetch_array($result))
  {
   $message[] = $a["timeid"];
   $message[] = $a["user"];
   $message[] = $a["sendtime"];
   $message[] = $a["message"];
   $message[] = $room;
   $message[] = $a["flag_ripped"];
   $message[] = $a["flag_gotmsg"];
   $message[] = $a["flag_moderated"];
   $return[] = $message;
   $message = array();
  }
  return($return);
 }

 function addToQueue($rooms_id, $user, $message)
 {
  mysql_query("INSERT INTO arsc_moderation_queue (rooms_id, user, message) VALUES ('".mysql_escape_string($rooms_id)."', '".mysql_escape_string($user)."', '".mysql_escape_string($message)."')", ARSC_PARAMETER_DB_LINK);
 }

 function deleteFromQueue($id)
 {
  mysql_query("DELETE FROM arsc_moderation_queue WHERE id = '".mysql_escape_string($id)."'", ARSC_PARAMETER_DB_LINK);
 }

 function getQueueEntry($id)
 {
  $query = mysql_query("SELECT id, rooms_id, user, message FROM arsc_moderation_queue WHERE id = '".mysql_escape_string($id)."'", ARSC_PARAMETER_DB_LINK);
  while($result = mysql_fetch_array($query))
  {
   $entry = array("id" => $result["id"], "rooms_id" => $result["rooms_id"], "user" => $result["user"], "message" => $result["message"]);
  }
  return($entry);
 }
 
 function getQueueEntries($rooms_id)
 {
  $query = mysql_query("SELECT id, rooms_id, user, message FROM arsc_moderation_queue WHERE rooms_id = '".mysql_escape_string($rooms_id)."' ORDER BY id DESC LIMIT ".ARSC_PARAMETER_QUEUE_LISTSIZE, ARSC_PARAMETER_DB_LINK);
  while($result = mysql_fetch_array($query))
  {
   $entries[] = array("id" => $result["id"], "rooms_id" => $result["rooms_id"], "user" => $result["user"], "message" => $result["message"]);
  }
  return($entries);
 }

 function postMessage($room, $message, $user, $sendtime, $timeid, $flag_ripped, $flag_moderated = 0)
 {
  include_once("message_postprocessing.inc.php");
  arsc_message_postprocessing($user, $room, $message);
  mysql_query("INSERT INTO arsc_room_".mysql_escape_string($room)." (message, user, sendtime, timeid, flag_ripped, flag_moderated) VALUES ('".mysql_escape_string($message)."', '".mysql_escape_string($user)."', '$sendtime', '$timeid', '$flag_ripped', '$flag_moderated')", ARSC_PARAMETER_DB_LINK);
 }
 
 function handleReceivedMessage($sid, $message, $language_path, $flag_moderated = 0)
 {
  //$message = htmlspecialchars($message);
  $my = $this->getUserValuesBySID($sid);
  @include($language_path."languages/".$my["language"].".inc.php");
  if ($my["level"] >= 0)
  {
   $this->deleteNeedlessMessages($my["room"]);
   $sendtime = date("H:i:s");
   $timeid = arsc_microtime();
   if ($message <> "")
   {
    $flood_count = $this->getUserValueByName("flood_count", $my["user"]);
    $flood_lastmessage = $this->getUserValueByName("flood_lastmessage", $my["user"]);
    if ($flood_lastmessage == $message)
    {
     if ($flood_count > ARSC_PARAMETER_FLOOD_MAX - 1)
     {
      $this->postMessage($my["room"], "arsc_user_kicked~~System~~".$my["user"], "System", date("H:i:s"), arsc_microtime(), 0, $flag_moderated);
      $this->setUserValueByName("level", -1, $my["user"]);
      return FALSE;
     }
     elseif ($flood_count == ARSC_PARAMETER_FLOOD_MAX - 2)
     {
      $this->postMessage($my["room"], "/msg ".$my["user"]." ".$arsc_lang["floodwarn"], "System", date("H:i:s"), arsc_microtime(), 0, $flag_moderated);
      $this->setUserValueByName("flood_count", $flood_count + 1, $my["user"]);
      return TRUE;
     }
     $this->setUserValueByName("flood_count", $flood_count + 1, $my["user"]);
    }
    else
    {
     $this->setUserValueByName("flood_lastmessage", $message, $my["user"]);
     $this->setUserValueByName("flood_count", 0, $my["user"]);
    }
    $this->postMessage($my["room"], $message, $my["user"], $sendtime, $timeid, $my["flag_ripped"], $flag_moderated);
    return TRUE;
   }
  }
  else
  {
   return FALSE;
  }
 }
 
 function deleteNeedlessMessages($room)
 {
  if ($result = mysql_query("SELECT COUNT(*) AS howmany FROM arsc_room_$room", ARSC_PARAMETER_DB_LINK))
  {
   $a = mysql_fetch_array($result);
   if ($a["howmany"] > ARSC_PARAMETER_ROWLIMIT)
   {
    $row_difference = $a["howmany"] - ARSC_PARAMETER_ROWLIMIT - 1;
    $result = mysql_query("SELECT timeid FROM arsc_room_$room ORDER BY timeid ASC LIMIT $row_difference, 1", ARSC_PARAMETER_DB_LINK);
    $a = mysql_fetch_array($result);
    $delete_id = $a["timeid"];
    mysql_query("DELETE FROM arsc_room_$room WHERE timeid < '$delete_id'", ARSC_PARAMETER_DB_LINK);
   }
  }
 }
 
 function deleteIdleUsers()
 {
  $timebuffer = time() - ARSC_PARAMETER_PING;
  //mysql_query("DELETE FROM arsc_users WHERE (lastping < '$timebuffer' AND version <> 'browser_text')", ARSC_PARAMETER_DB_LINK);
  mysql_query("UPDATE arsc_users SET flag_idle = '1' WHERE (lastping < '$timebuffer' AND version <> 'browser_text')", ARSC_PARAMETER_DB_LINK);
  $timebuffer = time() - ARSC_PARAMETER_PING_TEXT;
  //mysql_query("DELETE FROM arsc_users WHERE lastping < '$timebuffer' AND version = 'browser_text'", ARSC_PARAMETER_DB_LINK);
  mysql_query("UPDATE arsc_users SET flag_idle = '1' WHERE lastping < '$timebuffer' AND version = 'browser_text'", ARSC_PARAMETER_DB_LINK);
  $timebuffer = time() - ARSC_PARAMETER_PING_IDLE;
  mysql_query("DELETE FROM arsc_users WHERE lastping < '$timebuffer'", ARSC_PARAMETER_DB_LINK);
 }
 
 function addTraffic($direction, $bytes)
 {
  mysql_query("UPDATE arsc_traffic SET $direction = $direction + ".strlen($bytes), ARSC_PARAMETER_DB_LINK);
 }

 function getLevellist()
 {
  $query = mysql_query("SELECT * FROM arsc_levels LIMIT 1", ARSC_PARAMETER_DB_LINK);
  $result = mysql_fetch_array($query);
  ksort($result);
  while(list($key, $val) = each($result))
  {
   if(ereg("level", $key)) $return[] = str_replace("level", "", $key);
  }
  return $return;
 }
 
 function checkCommandAllowed($level, $command)
 {
  if ($level == "") $level = 0;
  $result = mysql_query("SELECT level".mysql_escape_string($level)." FROM arsc_levels WHERE command = '".mysql_escape_string($command)."'", ARSC_PARAMETER_DB_LINK);
  $a = @mysql_fetch_array($result);
  if ($a["level".$level] == 1)
  {
   return TRUE;
  }
  else
  {
   return FALSE;
  }
 }

 function getBasicLayoutValues($layout_id = -1, $checkroom = TRUE)
 {
  GLOBAL $arsc_my;
  if ($layout_id == -1)
  {
   if ($checkroom == FALSE) $layout_id = ARSC_PARAMETER_DEFAULT_LAYOUT_ID;
   if ($checkroom && $arsc_my["room"] == "")
   {
    $layout_id = ARSC_PARAMETER_DEFAULT_LAYOUT_ID;
   }
   elseif ($checkroom)
   {
    $result = mysql_query("SELECT layout_id FROM arsc_rooms WHERE roomname = '".$arsc_my["room"]."'", ARSC_PARAMETER_DB_LINK);
    $a = mysql_fetch_array($result);
    $layout_id = $a["layout_id"];
   }
  }
  $result = mysql_query("SELECT * FROM arsc_layouts WHERE id = ".$layout_id, ARSC_PARAMETER_DB_LINK);
  $a = mysql_fetch_array($result);
  while (list($key, $val) = each($a))
  {
   if (!is_numeric($key) && !strstr("template_", $key))
   {
    if($val == "<%use_default_layout%>")
    {
     $query2 = mysql_query("SELECT ".$key." FROM arsc_layouts WHERE id = ".ARSC_PARAMETER_DEFAULT_LAYOUT_ID, ARSC_PARAMETER_DB_LINK);
     $result2 = mysql_fetch_array($query2);
     $arsc_layout[$key] = $result2[$key];
    }
    else
    {
     $arsc_layout[$key] = $val;
    }
   }
  }
  return $arsc_layout;
 }

 function parseLayoutTemplate($name, $checkroom = TRUE)
 {
  GLOBAL $arsc_my, $arsc_lang, $arsc_layout, $arsc_current;
  if ($checkroom == FALSE) $layout_id = ARSC_PARAMETER_DEFAULT_LAYOUT_ID;
  if ($checkroom && $arsc_my["room"] == "")
  {
   $layout_id = ARSC_PARAMETER_DEFAULT_LAYOUT_ID;
  }
  elseif ($checkroom)
  {
   $result = mysql_query("SELECT layout_id FROM arsc_rooms WHERE roomname = '".$arsc_my["room"]."'", ARSC_PARAMETER_DB_LINK);
   $a = mysql_fetch_array($result);
   $layout_id = $a["layout_id"];
  }
  if($arsc_my["layout"] <> "" AND $arsc_my["layout"] <> 0 AND $arsc_my["layout"] <> ARSC_PARAMETER_DEFAULT_LAYOUT_ID)
  {
   $layout_id = $arsc_my["layout"];
  }
  $arsc_layout = $this->getBasicLayoutValues($layout_id, $checkroom);
  include("layout_defaults.inc.php");
  $result = mysql_query("SELECT template_".$name." FROM arsc_layouts WHERE id = ".$layout_id, ARSC_PARAMETER_DB_LINK);
  $a = mysql_fetch_array($result);
  $template = $a["template_".$name];
  if($template == "<%use_default_layout%>")
  {
   $query2 = mysql_query("SELECT template_".$name." FROM arsc_layouts WHERE id = ".ARSC_PARAMETER_DEFAULT_LAYOUT_ID, ARSC_PARAMETER_DB_LINK);
   $result2 = mysql_fetch_array($query2);
   $template = $result2["template_".$name];
  }
  if (is_array($arsc_my))
  {
   while (list($key, $val) = each($arsc_my))
   {
    $template = ereg_replace("<%my_".$key."%>", $val, $template);
   }
  }
  $arsc_parameters = get_defined_constants();
  while (list($key, $val) = each($arsc_parameters))
  {
   if (ereg("ARSC_PARAMETER_", $key))
   {
    $key = strtolower(str_replace("ARSC_PARAMETER_", "", $key));
    $template = ereg_replace("<%parameter_".$key."%>", $val, $template);
   }
  }
  if (is_array($arsc_lang))
  {
   while (list($key, $val) = each($arsc_lang))
   {
    $template = ereg_replace("<%lang_".$key."%>", $val, $template);
   }
  }
  if (is_array($arsc_current))
  {
   while (list($key, $val) = each($arsc_current))
   {
    $template = ereg_replace("<%current_".$key."%>", $val, $template);
   }
  }
  while (list($key, $val) = each($arsc_layout))
  {
   $template = ereg_replace("<%layout_".$key."%>", $val, $template);
  }
  return $template;
 }

}

?>
