<?php

function arsc_message_preprocessing($message, $roomname = "", $roomtype = 1)
{
 /*
  This function is called every time someone posts into the chat, BEFORE it is
  written to the database.
  Here you can e.g. filter out words or do other tricks with the input.
  Don't forget to return the $message, or the whole chat will not work!
 */
 
 // Change URLs to HTML links, but not in moderated rooms, and use the De-Referer:
 if($roomtype <> ARSC_ROOMTYPE_MODERATED)
 {
  $message = preg_replace("#(^|[^\"=]{1})(http://|https://|ftp://|mailto:|news:)([^\s<>]+)([\s\n<>]|$)#sm",
                          "\\1<a href=\"".ARSC_PARAMETER_BASEURL."base/dereferer.php?arsc_link=\\2\\3\" target=\"_blank\">\\2\\3</a>\\4",
                          $message);
 }
 
 // Do something else
 // $message = preg_replace(...);
 
 // Return the message
 return $message;
}

?>
