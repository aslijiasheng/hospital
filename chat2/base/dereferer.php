<?php

include("inc/config.inc.php");
include("inc/init.inc.php");
include("inc/functions.inc.php");
include("inc/inputvalidation.inc.php");

$arsc_link = arsc_validateinput($_GET["arsc_link"], NULL, NULL, 0, ARSC_PARAMETER_USERINPUTMAXLENGTH, __FILE__, __LINE__);
if($arsc_link == "") die();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
  <title>Redirection</title>
  <meta http-equiv="Refresh" content="0; URL=<?php echo $arsc_link; ?>">
 </head>
 <body>
 </body>
</html>
