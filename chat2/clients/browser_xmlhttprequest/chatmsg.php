<?php

include("../../base/inc/config.inc.php");
include("../../base/inc/init.inc.php");
include("../../base/inc/functions.inc.php");
include("../../base/inc/inputvalidation.inc.php");

$arsc_sid = arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__);

?>
<html>
<head>
<script language="JavaScript">
var xmlhttp = false;
/*@cc_on @*/
/*@if (@_jscript_version >= 5)
 try
 {
  xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 }
 catch (e)
 {
  try
  {
   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  catch (E)
  {
   xmlhttp = false;
  }
 }
@end @*/
if (!xmlhttp && typeof XMLHttpRequest != 'undefined')
{
 xmlhttp = new XMLHttpRequest();
}

function arscGetNewMessages()
{
 xmlhttp.open("GET", "getmessages.php?arsc_sid=<?php echo $arsc_sid; ?>&arsc_random=" + Math.random(), true);
 xmlhttp.onreadystatechange = function()
 {
  if (xmlhttp.readyState == 4)
  {
   //document.forms[0].elements['a'].value = xmlhttp.responseText + document.forms[0].elements['a'].value
   if (xmlhttp.responseText != '')
   {
    /*allcontent = allcontent + xmlhttp.responseText
    element.innerHTML = allcontent
    */

    newdiv = document.createElement('div');
    newdiv.innerHTML = xmlhttp.responseText;
    element.appendChild(newdiv);

   }
  }
 }
 try
 {
  xmlhttp.send(null)
 }
 catch (e)
 {
  //
 }
 
 return false
}

</script>
<?php echo ARSC_PARAMETER_HTMLHEAD_JS; ?>
</head>
<body>
<div id="chatOutput">
</div>
<script>
var element = document.getElementById('chatOutput');
var aktiv = window.setInterval("arscGetNewMessages()", 1500);

</script>
<body>
</body>
</html>