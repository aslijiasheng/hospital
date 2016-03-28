<?php

include("../../base/inc/config.inc.php");
include("../../base/inc/init.inc.php");
include("../../base/inc/functions.inc.php");
include("../../base/inc/inputvalidation.inc.php");
include("../../base/inc/api.inc.php");

$arsc_api = new arsc_api_Class;
$arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__));

if ($arsc_api->userIsValid($arsc_my["user"]))
{
 include("../../languages/".$arsc_my["language"].".inc.php");
 define("ARSC_PARAMETER_VIRTUALSERVERS_CURRENT", arsc_getVirtualServer($arsc_my["ip"]));
 $arsc_current["queueframeheight"] = "0";
 if ($arsc_my["level"] >= "20") $arsc_current["queueframeheight"] = "50%";
 echo $arsc_api->parseLayoutTemplate("browser_default_index", FALSE);
}

?>
