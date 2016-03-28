<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");

set_magic_quotes_runtime(1);

$arsc_api = new arsc_api_Class;

$arsc_save_user = $arsc_api->makeCleanUsername($arsc_save_user);
if($arsc_save_language == "") $arsc_save_language = ARSC_PARAMETER_DEFAULT_LANGUAGE;

if($arsc_save_password <> "")
{
 $arsc_save_password = sha1($arsc_save_password);
 $arsc_password_query = "password = '".$arsc_save_password."',";
}
else
{
 $arsc_password_query = "";
}
if(mysql_query("UPDATE arsc_registered_users SET
                user = '$arsc_save_user',
                ".$arsc_password_query."
                language = '$arsc_save_language',
                level = '$arsc_save_level',
                color = '$arsc_save_color',
                template = '$arsc_save_template',
                layout = '$arsc_save_layout',
                email = '$arsc_save_email',
                sex = '$arsc_save_sex',
                location = '$arsc_save_location',
                color = '$arsc_save_color',
                hobbies = '$arsc_save_hobbies',
                flag_guestbook = '$arsc_save_flag_guestbook',
                flag_locked = '$arsc_save_flag_locked'
                WHERE id = '$arsc_save_id'", ARSC_PARAMETER_DB_LINK))
{
 header("Location: edit_user.php?arsc_user=".$arsc_save_user."&arsc_message=".urlencode("Changes were saved"));
 die();
}
else
{
 header("Location: edit_user.php?arsc_user=".$arsc_user."&arsc_message=".urlencode("Could not save changes!"));
 die();
}
?>
