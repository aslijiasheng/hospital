<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");

set_magic_quotes_runtime(1);

$arsc_api = new arsc_api_Class;

$arsc_api->deleteRoom($arsc_room_id);
header("Location: rooms.php?arsc_message=".urlencode("Room was deleted."));

?>
