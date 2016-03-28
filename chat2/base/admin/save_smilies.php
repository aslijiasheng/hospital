<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");

set_magic_quotes_runtime(1);

reset($arsc_save_parameters_smilies);
while (list($key, $val) = each($arsc_save_parameters_smilies))
{
 $arsc_result = mysql_query("SELECT id FROM arsc_smilies WHERE id = '$key'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 if ($arsc_a["id"] == $key)
 {
  mysql_query("UPDATE arsc_smilies SET value = '".stripslashes($val)."' WHERE id = '$key'", ARSC_PARAMETER_DB_LINK);
 }
 else
 {
  mysql_query("INSERT INTO arsc_smilies (id, value) VALUES ('$key', '".stripslashes($val)."')", ARSC_PARAMETER_DB_LINK);
 }
}

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

header("Location: smilies.php?arsc_message=".urlencode("Smilies successfully updated."));

?>
