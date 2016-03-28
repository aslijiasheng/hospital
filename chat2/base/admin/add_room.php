<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");

set_magic_quotes_runtime(1);

$arsc_api = new arsc_api_Class;

$arsc_newroom = htmlspecialchars($arsc_newroom);
$arsc_api->createRoom($arsc_newroom, "", -1, "", 0, ARSC_PARAMETER_DEFAULT_LAYOUT_ID);
$arsc_room = $arsc_api->makeInternalRoomname($arsc_newroom);
header("Location: edit_room.php?arsc_room=".urlencode($arsc_room));

?>
