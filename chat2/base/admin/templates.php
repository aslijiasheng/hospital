<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("../inc/api.inc.php");
include("header.inc.php");

$arsc_api = new arsc_api_Class;

set_magic_quotes_runtime(1);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
 <head>
  <title>
   <?php echo ARSC_PARAMETER_TITLE; ?> Template Administration
  </title>
 </head>
 <body bgcolor="#FFFFFF">
  <font face="Arial" color="#FF0000">
   <b>
    <?php echo $arsc_message; ?>
   </b>
  </font>
  <form action="save_templates.php" method="POST">
   <h2>
    <font face="Arial">
     Templates
    </font>
   </h2>
   
   <?php
   
   $arsc_templatelist = $arsc_api->getTemplatelist();
   reset($arsc_templatelist);
   while (list($arsc_key, $arsc_val) = each($arsc_templatelist))
   {
    ?>
    <font face="Arial" size="2">
     <b>
      Template <?php echo $arsc_val; ?>: (<a href="delete_template.php?arsc_del_template=<?php echo urlencode($arsc_val); ?>">Delete</a>)
     </b>
    </font>
    <br>
    <?php
    $arsc_varname = "arsc_template_".$arsc_val;
    ksort($$arsc_varname);
    while (list($arsc_key2, $arsc_val2) = each($$arsc_varname))
    {
     ?>
     <font face="Arial" size="2">
      <?php echo $arsc_key2; ?>
     </font>
     <input type="text" size="80" name="arsc_save_templates_<?php echo $arsc_val; ?>[<?php echo $arsc_key2; ?>]" value="<?php echo stripslashes(htmlspecialchars($arsc_val2)); ?>">
     <br>
     <?php
    }
    ?>
    <br>
    <br>
    <?php
   }
   ?>
   <br>
   <br>
   <input type="submit" value="Save templates">
  </form>
  <form action="add_template.php" method="POST">
   <input type="text" name="arsc_add_template">
   <input type="Submit" value="Add Template">
  </form>
<?php include("footer.inc.php"); ?>
