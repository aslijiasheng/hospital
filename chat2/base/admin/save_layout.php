<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/api.inc.php");
include("../inc/functions.inc.php");

$arsc_api = new arsc_api_Class;

set_magic_quotes_runtime(1);

while (list($arsc_key, $arsc_val) = each($arsc_save))
{
 if ($arsc_key <> "id")
 {
  mysql_query("UPDATE arsc_layouts SET ".$arsc_key." = '".mysql_escape_string(stripslashes($arsc_val))."' WHERE id = $arsc_layout_id", ARSC_PARAMETER_DB_LINK);
 }
}

header("Location: edit_layout.php?arsc_layout_id=".$arsc_layout_id."&arsc_message=".urlencode("Layout successfully saved."));

?>
