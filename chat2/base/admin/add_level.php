<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");

set_magic_quotes_runtime(1);

mysql_query("ALTER TABLE arsc_levels ADD level".mysql_escape_string($arsc_level)." TINYINT NOT NULL", ARSC_PARAMETER_DB_LINK);
header("Location: levels.php?arsc_message=".urlencode("Level was created."));

?>
