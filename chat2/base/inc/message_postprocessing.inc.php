<?php

function arsc_message_postprocessing($user, $room, $message)
{
 /*
  This function is called everytime text is read from the database and posted into the chat.
  You can send this data e.g. into a weblog.
 */
 
 // Example 1: Write messages to a log file
 // $fp = fopen("/tmp/arsc_chatmessages.".ARSC_INSTALLATIONID.".log", "a");
 // fputs($fp, date("Y-m-d H:i:s")." (".$room.") [".$user."]: ".$message."\n");
 // fclose($fp);
 
 // Example 2: Send the data to a webpage
 // $fp = fopen("http://www.example.com/yourscript.php?user=".$user."&room=".$room."&message=".$message, "r");
 // fclose($fp);
}

?>
