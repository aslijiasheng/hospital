<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");

set_magic_quotes_runtime(1);

$arsc_api = new arsc_api_Class;

$arsc_layout_id = $arsc_api->createLayout($arsc_newlayout);
header("Location: edit_layout.php?arsc_layout_id=".urlencode($arsc_layout_id));

?>
