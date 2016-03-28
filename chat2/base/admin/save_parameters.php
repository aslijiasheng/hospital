<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");

set_magic_quotes_runtime(1);

reset($arsc_save_parameters);
while (list($key, $val) = each($arsc_save_parameters))
{
 $arsc_result = mysql_query("SELECT name FROM arsc_parameters WHERE name = '$key'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if ($arsc_a["name"] == $key)
 {
  mysql_query("UPDATE arsc_parameters SET value = '".stripslashes($val)."' WHERE name = '$key'", ARSC_PARAMETER_DB_LINK);
 }
 else
 {
  mysql_query("INSERT INTO arsc_parameters (name, value) VALUES ('$key', '".stripslashes($val)."')", ARSC_PARAMETER_DB_LINK);
 }
}

header("Location: parameters.php?arsc_message=".urlencode("Parameters successfully saved."));

?>
