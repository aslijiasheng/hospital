<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/api.inc.php");
include("../inc/functions.inc.php");

$arsc_api = new arsc_api_Class;

set_magic_quotes_runtime(1);

$arsc_templatelist = $arsc_api->getTemplatelist();
reset($arsc_templatelist);
list($arsc_key, $arsc_val) = each($arsc_templatelist);
$arsc_varname = "arsc_template_".$arsc_val;
reset($$arsc_varname);
while (list($key, $val) = each($$arsc_varname))
{
 mysql_query("INSERT INTO arsc_templates (template, name, value) VALUES ('$arsc_add_template', '$key', '')", ARSC_PARAMETER_DB_LINK);
}

header("Location: templates.php?arsc_message=".urlencode("Template $arsc_add_template successfully added."));

?>
