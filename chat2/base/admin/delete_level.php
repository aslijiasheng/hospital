<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");

set_magic_quotes_runtime(1);

if ($arsc_level == 0 OR
    $arsc_level == 10 OR
    $arsc_level == 20 OR
    $arsc_level == 30 OR
    $arsc_level == 99)
{
 header("Location: levels.php?arsc_message=".urlencode("This level may not be deleted!"));
 die();
}

mysql_query("ALTER TABLE arsc_levels DROP level".mysql_escape_string($arsc_level), ARSC_PARAMETER_DB_LINK);
mysql_query("UPDATE arsc_registered_users SET level = 0 WHERE level = ".$arsc_level, ARSC_PARAMETER_DB_LINK);
mysql_query("UPDATE arsc_users SET level = 0 WHERE level = ".$arsc_level, ARSC_PARAMETER_DB_LINK);
header("Location: levels.php?arsc_message=".urlencode("Level was deleted. Please note that all user with this level are set to level 0!"));

?>
