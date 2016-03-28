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
while (list($arsc_key, $arsc_val) = each($arsc_templatelist))
{
 $arsc_varname = "arsc_save_templates_".$arsc_val;
 reset($$arsc_varname);
 while (list($key, $val) = each($$arsc_varname))
 {
  $arsc_result = mysql_query("SELECT name FROM arsc_templates WHERE name = '$key' AND template = '$arsc_val'", ARSC_PARAMETER_DB_LINK);
  $arsc_a = mysql_fetch_array($arsc_result);
  if ($arsc_a["name"] == $key)
  {
   mysql_query("UPDATE arsc_templates SET value = '".stripslashes($val)."' WHERE name = '$key' AND template = '$arsc_val'", ARSC_PARAMETER_DB_LINK);
  }
  else
  {
   mysql_query("INSERT INTO arsc_templates (template, name, value) VALUES ('$arsc_val', '$key', '".stripslashes($val)."')", ARSC_PARAMETER_DB_LINK);
  }
 }
}

header("Location: templates.php?arsc_message=".urlencode("Templates successfully saved."));

?>
