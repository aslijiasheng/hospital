<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");

set_magic_quotes_runtime(1);

$arsc_save_roomname_nice = htmlspecialchars($arsc_save_roomname_nice);
if (mysql_query("UPDATE arsc_rooms SET
                 roomname_nice = '$arsc_save_roomname_nice',
                 description = '$arsc_save_description',
                 owner = '$arsc_save_owner',
                 password = '$arsc_save_password',
                 type = '$arsc_save_type',
                 layout_id = '$arsc_save_layout_id'
                 WHERE id = '$arsc_save_id'", ARSC_PARAMETER_DB_LINK))
{
 header("Location: edit_room.php?arsc_room=".$arsc_save_roomname."&arsc_message=".urlencode("Changes were saved."));
 die();
}
else
{
 header("Location: edit_room.php?arsc_room=".$arsc_roomname."&arsc_message=".urlencode("Could not save changes!"));
 die();
}
?>
