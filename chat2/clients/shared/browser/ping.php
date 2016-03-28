<?php

include("../../../base/inc/config.inc.php");
include("../../../base/inc/init.inc.php");
include("../../../base/inc/functions.inc.php");
include("../../../base/inc/inputvalidation.inc.php");

$arsc_sid = arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__);

header("Expires: Wed, 4 Oct 1978 09:32:45 GMT");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
header("Content-Type: text/html");
mysql_query("UPDATE arsc_users SET lastping = '".time()."', flag_idle = '0' WHERE sid = '".mysql_escape_string($arsc_sid)."'", ARSC_PARAMETER_DB_LINK);
header("Refresh: ".ARSC_PARAMETER_PING_REFRESH."; URL=ping.php?arsc_sid=".$arsc_sid."&arsc_random=".time());

echo "[".date("H:i:s")."] - ".$arsc_sid." - Refresh in ".ARSC_PARAMETER_PING_REFRESH." seconds.";

?>
