#!/usr/local/php-bin/current/bin/php -q
<?php

if (ini_get("safe_mode") == 0) set_time_limit(0);
set_magic_quotes_runtime(0);

include("../base/inc/config.inc.php");
include("../base/inc/init.inc.php");
include("../base/inc/functions.inc.php");
include("../base/inc/api.inc.php");
include("../base/inc/filter.inc.php");

$arsc_api = new arsc_api_Class;

// Checking parameters

if ($argv[1] == "--help" OR $argv[1] == "-h" OR $argv[1] == "/?")
{
 echo "Starts the ARSC socket server on port ".ARSC_PARAMETER_SOCKETSERVER_PORT.".";
 echo "\n\n";
 echo "Usage: arscd.php [-v|-l|--help]\n\n";
 echo "Example:\n";
 echo "  ab_chatd.php -l=/var/log/ab_chat\n\n";
 echo "Options:\n";
 echo "  -v           Verbose mode, print every message every user receives to STDOUT\n";
 echo "  -l=DIR       Write message logfiles for every room into DIR (creates file for every room)\n";
 echo "  -h, --help   Show this help\n";
 echo "\n";
 echo "For more information, please visit:";
 echo "<URL:http://manuel.kiessling.net/projects/software/arsc>.\n";
 die(0);
}
$arsc_logdir = false;
if (ereg("-l=", $argv[1]))
{
 if (is_dir(str_replace("-l=", "", $argv[1])))
 {
  $arsc_logdir = str_replace("-l=", "", $argv[1]);
  echo "Logging into '".$arsc_logdir."'\n";
 }
 else
 {
  die ("Cannot log into '".str_replace("-l=", "", $argv[1])."'. Aborting.\n");
 }
}

// Create socket

if (false === ($arsc_listen_socket = socket_create_listen(ARSC_PARAMETER_SOCKETSERVER_PORT, ARSC_PARAMETER_SOCKETSERVER_MAXIMUMUSERS)))
 die("Couldn't create listening socket on port ".ARSC_PARAMETER_SOCKETSERVER_PORT.".\n");
if (false === socket_setopt($arsc_listen_socket, SOL_SOCKET, SO_REUSEADDR, 1))
 die("Couldn't set socket option\n");


socket_set_nonblock($arsc_listen_socket);

$arsc_connected_clients = 0;
$arsc_connections = array();
$arsc_connection_info = array();
$arsc_sid = array();

writeLogMessage("SOCK", "", "", "", "", "Started ARSC server listening on port ".ARSC_PARAMETER_SOCKETSERVER_PORT);

while (1) // Handling connections in a neverending loop
{
 $arsc_socket_set = array_merge($arsc_listen_socket, $arsc_connections);
 if (socket_select($arsc_socket_set, $a = NULL, $b = NULL, 0, 0))
 { 
  foreach($arsc_connections as $arsc_connection)
  {
   if (!($arsc_connection == $arsc_listen_socket))
   { 
    foreach($arsc_connection_info as $arsc_num => $arsc_info)
    {
     if ($arsc_connection == $arsc_info['handle'])
     { 
      if ($arsc_sid[$arsc_num] == "")
      {
       $received_data = "";
       $arsc_read_socket = array($arsc_connection);
       while (socket_select($arsc_read_socket, $write = NULL, $except = NULL, 0, 0) > 0 AND strlen($received_data) < 100)
       {
        if (($received_data .= @socket_read($arsc_connection, 1)) == false)
        {
         unset($arsc_connections[$arsc_num]);
         unset($arsc_connection_info[$arsc_num]);
         break;
        }
       }
       $arsc_api->addTraffic("incoming", strlen($received_data));
       // Check whether a browser (who sends only HTTP headers) is connecting or another client (who knows ARSC headers)
       if (substr($received_data, 0, 3) == "GET") // Client is a browser, so we only have to get the sid since the user is already registered
       {
        ereg("arsc_sid=(.*) HTTP", $received_data, $a);
        $arsc_sid[$arsc_num] = $a[1];
        $arsc_clienttype = "browser";
       }
       elseif (substr($received_data, 0, 12) == "<arscrequest") // Client is not a browser
       {
        // now we have to check what the client actually wants: register a new user, get the userlist etc.pp.
        ereg("<type>(.*)</type>", $received_data, $a);
        $arsc_req_type = $a[1];
        if ($arsc_req_type == "connect")
        {
         ereg("<user>(.*)</user>", $received_data, $a);
         $arsc_req_user = $a[1];
         ereg("<password>(.*)</password>", $received_data, $a);
         $arsc_req_password = $a[1];
         ereg("<room>(.*)</room>", $received_data, $a);
         $arsc_req_room = $a[1];
         ereg("<language>(.*)</language>", $received_data, $a);
         $arsc_req_language = $a[1];
         ereg("<template>(.*)</template>", $received_data, $a);
         $arsc_req_template = $a[1];
         $arsc_sid[$arsc_num] = $arsc_api->createUser($arsc_req_user, $arsc_req_password, $arsc_req_room, $arsc_req_language, $arsc_req_template, "external", $arsc_connection_info[$arsc_num]["address"]);
         $arsc_clienttype = "external";
        }
        elseif ($arsc_req_type == "post")
        {
         ereg("<sid>(.*)</sid>", $received_data, $a);
         $arsc_req_sid = $a[1];
         ereg("<content>(.*)</content>", $received_data, $a);
         $arsc_req_content = str_replace("#ret#", "", $a[1]);
         writeLogMessage("ARSC", $arsc_req_sid, $arsc_connection_info[$arsc_num]["address"], $arsc_connection_info[$arsc_num]["port"], $arsc_num, "Requesting type: ".$arsc_req_type);
         if ($arsc_api->handleReceivedMessage($arsc_req_sid, $arsc_req_content, "../"))
         {
          $arsc_res_message = "<arscrespond><type>post</type><status>ok</status></arscrespond>"."\n";
          socket_write($arsc_connection, $arsc_res_message, strlen($arsc_res_message));
          $arsc_api->addTraffic("outgoing", strlen($arsc_res_message));
         }
         else
         {
          $arsc_res_message = "<arscrespond><type>post</type><status>error</status><error>Message could not be handled</error></arscrespond>"."\n";
          socket_write($arsc_connection, $arsc_res_message, strlen($arsc_res_message));
          $arsc_api->addTraffic("outgoing", strlen($arsc_res_message));
         }
        }
       }
       if ($arsc_sid[$arsc_num] <> "")
       {
        $arsc_my = $arsc_api->getUserValuesBySID($arsc_sid[$arsc_num]);
        writeLogMessage("ARSC", $arsc_sid[$arsc_num], $arsc_connection_info[$arsc_num]["address"], $arsc_connection_info[$arsc_num]["port"], $arsc_num, "Connection is an ARSC client (Type: ".$arsc_clienttype.", Nickname {$arsc_my["user"]}, Room {$arsc_my["room"]})");
        if ($arsc_my["version"] <> "external")
        {
         socket_write($arsc_connection, ARSC_PARAMETER_HTMLHEAD_JS, strlen(ARSC_PARAMETER_HTMLHEAD_JS));
         $arsc_api->addTraffic("outgoing", strlen(ARSC_PARAMETER_HTMLHEAD_JS));
        }
        else // tell the client which SID we gave his user
        {
         $arsc_message = "<arscrespond><type>connect</type><status>ok</status><sid>".$arsc_sid[$arsc_num]."</sid><version>0.1</version></arscrespond>\n";
         if (!socket_write($arsc_connection, $arsc_message, strlen($arsc_message)))
         {
          unset($arsc_connections[$arsc_num]);
          unset($arsc_connection_info[$arsc_num]);
         }
         else
         {
          $arsc_api->addTraffic("outgoing", strlen($arsc_message));
         }
        }
        @include("../languages/".$arsc_my["language"].".inc.php");
        $arsc_template_varname = "arsc_template_".$arsc_my["template"];
        $arsc_message = arsc_filter_posting("System", date("H:i:s"), "/msg ".$arsc_my["user"]." ".str_replace("{title}", ARSC_PARAMETER_TITLE, $arsc_lang["welcome"]), $arsc_my["room"], 0, 0, 0, $$arsc_template_varname);
        if (!socket_write($arsc_connection, $arsc_message, strlen($arsc_message)))
        {
         unset($arsc_connections[$arsc_num]);
         unset($arsc_connection_info[$arsc_num]);
        }
        else
        {
         $arsc_api->addTraffic("outgoing", strlen($arsc_message));
        }
       }
      }
      else
      {
       $arsc_newmessages = arsc_getmessages($arsc_sid[$arsc_num]);
       if ($arsc_newmessages <> "")
       {
        if (!@socket_write($arsc_connection, $arsc_newmessages, strlen($arsc_newmessages)))
        {
         $arsc_api->deleteUser($arsc_my["user"]);
         $arsc_api->postMessage($arsc_my["room"], "arsc_user_quit~~".$arsc_my["user"]."~~".$arsc_api->getReadableRoomname($arsc_my["room"]), "System", date("H:i:s"), arsc_microtime(), 0);
         writeLogMessage("SOCK", $arsc_sid[$arsc_num], $arsc_connection_info[$arsc_num]["address"], $arsc_connection_info[$arsc_num]["port"], $arsc_num, "Client disconnected");
         writeLogMessage("ARSC", $arsc_sid[$arsc_num], $arsc_connection_info[$arsc_num]["address"], $arsc_connection_info[$arsc_num]["port"], $arsc_num, "Cannot reach user (Nickname {$arsc_my["user"]}, Room {$arsc_my["room"]})");
         unset($arsc_connections[$arsc_num]);
         unset($arsc_connection_info[$arsc_num]);
         @socket_shutdown($arsc_connection);
         flush();
        }
        else
        {
         $arsc_api->addTraffic("outgoing", strlen($arsc_newmessages));
        }
       }
       elseif ($arsc_newmessages == "")
       {
        $arsc_api->deleteUser($arsc_my["user"]);
        $arsc_api->postMessage($arsc_my["room"], "arsc_user_quit~~".$arsc_my["user"]."~~".$arsc_api->getReadableRoomname($arsc_my["room"]), "System", date("H:i:s"), arsc_microtime(), 0);
        writeLogMessage("SOCK", $arsc_sid[$arsc_num], $arsc_connection_info[$arsc_num]["address"], $arsc_connection_info[$arsc_num]["port"], $arsc_num, "Client disconnected");
        writeLogMessage("ARSC", $arsc_sid[$arsc_num], $arsc_connection_info[$arsc_num]["address"], $arsc_connection_info[$arsc_num]["port"], $arsc_num, "User not logged in (anymore) (Nickname {$arsc_my["user"]}, Room {$arsc_my["room"]})");
        unset($arsc_connections[$arsc_num]);
        unset($arsc_connection_info[$arsc_num]);
        @socket_shutdown($arsc_connection);
        flush();
       }
      }
     }
    }
   }
  }
  if ($arsc_connection_info[$arsc_connected_clients]['handle'] = @socket_accept($arsc_listen_socket))
  {
   $arsc_connections[] = $arsc_connection_info[ $arsc_connected_clients][ 'handle'];
   socket_getpeername( $arsc_connection_info[ $arsc_connected_clients][ 'handle'], &$arsc_connection_info[ $arsc_connected_clients]['address'], &$arsc_connection_info[ $arsc_connected_clients][ 'port']);
   writeLogMessage("SOCK", "", $arsc_connection_info[$arsc_connected_clients]["address"], $arsc_connection_info[$arsc_connected_clients]["port"], $arsc_connected_clients, "Client connected");
   flush();
   $arsc_connected_clients++;
  }
 }
 usleep(ARSC_PARAMETER_REFRESH);
}


function writeLogMessage($system, $sid, $ip, $port, $client, $message)
{
 echo date("[Y-m-d H:i:s]")." System: ".$system." | Client: ".$client." | IP: ".$ip." | Port: ".$port." | SID: ".$sid." | Message: ".$message."\n";
 flush();
}

function arsc_getmessages($arsc_sid)
{
 GLOBAL $arsc_api,
        $arsc_smilies,
        $arsc_lang,
        $argv,
        $arsc_num,
        $arsc_my;
 
 if ($arsc_my = $arsc_api->getUserValuesBySID($arsc_sid))
 {
  if (!$arsc_api->userIsValid($arsc_my["user"]))
  {
   include("../languages/".$arsc_my["language"].".inc.php");
   $arsc_api->deleteUser($arsc_my["user"]);
   return arsc_filter_posting("System", date("H:i:s"), $arsc_lang["youwerekicked"], $arsc_my["room"], 0, 0, 0, $arsc_template_xml);
  }
  else
  {
   $arsc_posting = "\n";
   include("../languages/".$arsc_my["language"].".inc.php");
   $arsc_lastmessageping = $arsc_api->getUserValueByName("lastmessageping", $arsc_my["user"]);
   if ($arsc_lastmessageping == "0")
   {
    $arsc_api->setUserValueByName("lastmessageping", arsc_microtime(), $arsc_my["user"]);
    $arsc_api->setUserValueByName("lastping", time(), $arsc_my["user"]);
   }
   else
   {
    $arsc_messages = $arsc_api->getMessages($arsc_lastmessageping, $arsc_my["room"], $arsc_my["template"]);
    if ($arsc_messages[0] <> "")
    {
     $arsc_posting .= $arsc_messages[0];
     if ($argv[1] == "-v")
     {
      writeLogMessage("MESG", $arsc_sid, "", "", $arsc_num, $arsc_messages[1]);
     }
    }
    if ($arsc_messages[1] <> "") $arsc_api->setUserValueByName("lastmessageping", $arsc_messages[1], $arsc_my["user"]);
    $arsc_api->setUserValueByName("lastping", time(), $arsc_my["user"]);
   }
   if ($arsc_my["version"] <> "external")
   {
    $arsc_posting = str_replace("#ret#", "\n", $arsc_posting);
    if ($arsc_posting <> "\n")
    {
     if (ARSC_PARAMETER_SMILIES == "yes" AND $arsc_api->checkCommandAllowed($arsc_my["level"], "smilies"))
     {
      reset($arsc_smilies);
      $arsc_posting = arsc_smilies_replace($arsc_posting, $arsc_smilies, ARSC_PARAMETER_SMILIES_PATH);
     }
     //$arsc_posting = nl2br($arsc_posting)."<br>";
    }
   }
   return str_replace("#arsc_dummy_space#", "", $arsc_posting);
  }
 }
}

?>
