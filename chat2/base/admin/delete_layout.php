<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");

if($arsc_layout_id <> ARSC_PARAMETER_DEFAULT_LAYOUT_ID)
{
 mysql_query("DELETE FROM arsc_layouts WHERE id = '".mysql_escape_string($arsc_layout_id)."'", ARSC_PARAMETER_DB_LINK);
 header("Location: layouts.php?arsc_message=".urlencode("Layout was deleted."));
 die();
}
else
{
 header("Location: layouts.php?arsc_message=".urlencode("You cannot delete the default layout!"));
 die();
}

?>
