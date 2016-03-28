<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");

set_magic_quotes_runtime(1);

$arsc_api = new arsc_api_Class;

$arsc_newuser = $arsc_api->makeCleanUsername($arsc_newuser);

mysql_query("INSERT INTO arsc_registered_users (user) VALUES ('$arsc_newuser')", ARSC_PARAMETER_DB_LINK);
header("Location: edit_user.php?arsc_user=".urlencode($arsc_newuser));

?>
