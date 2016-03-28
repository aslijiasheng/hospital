<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");

mysql_query("DELETE FROM arsc_templates WHERE template = '$arsc_del_template'", ARSC_PARAMETER_DB_LINK);

header("Location: templates.php?arsc_message=".urlencode("Template $arsc_del_template successfully deleted."));

?>
