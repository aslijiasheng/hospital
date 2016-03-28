<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");

$arsc_result = mysql_query("SELECT id FROM arsc_registered_users WHERE user = '$arsc_user'", ARSC_PARAMETER_DB_LINK);
$arsc_a = mysql_fetch_array($arsc_result);
mysql_query("DELETE FROM arsc_guestbooks WHERE link_user = '".$arsc_a["id"]."'", ARSC_PARAMETER_DB_LINK);
mysql_query("DELETE FROM arsc_registered_users WHERE user = '$arsc_user'", ARSC_PARAMETER_DB_LINK);

header("Location: users.php?arsc_message=".urlencode("User $arsc_user and all his guestbook entries were successfully deleted."));

?>
