<?php

include("base/inc/config.inc.php");
include("base/inc/init.inc.php");

$arsc_result = mysql_query("SELECT COUNT(user) AS cnt FROM arsc_users", ARSC_PARAMETER_DB_LINK);
while ($arsc_a = mysql_fetch_array($arsc_result))
{
 echo $arsc_a["cnt"]."<br>\n<br>\n";
}
$arsc_result = mysql_query("SELECT user FROM arsc_registered_users", ARSC_PARAMETER_DB_LINK);
while ($arsc_a = mysql_fetch_array($arsc_result))
{
 echo $arsc_a["user"]."<br>\n";
}

?>
