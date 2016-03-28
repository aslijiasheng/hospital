<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("header.inc.php");

set_magic_quotes_runtime(1);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN" "http://www.w3.org/TR/REC-html40/loose.dtd">
<html>
 <head>
  <title>
   <?php echo ARSC_PARAMETER_TITLE; ?> Smilie Administration
  </title>
 </head>
 <body bgcolor="#FFFFFF">
  <font face="Arial" color="#FF0000">
   <b>
    <?php echo $arsc_message; ?>
   </b>
  </font>
  <form action="save_smilies.php" method="POST">
   <h2>
    <font face="Arial">
     Smilies
    </font>
   </h2>
   <font face="Arial" size="2">
    Replace smilies (e.g. ':-)') and shortcuts (e.g. '/sleep/') with an image?
   </font>
   <br>
   <input type="text" name="arsc_save_parameters[smilies]" value="<?php echo ARSC_PARAMETER_SMILIES; ?>">
   <br>
   <br>
   <font face="Arial" size="2">
    What is the full URL of your smilies directory?
   </font>
   <br>
   <input type="text" name="arsc_save_parameters[smilies_path]" value="<?php echo ARSC_PARAMETER_SMILIES_PATH; ?>">
   <br>
   <br>
   <font face="Arial" size="2">
    The smilie images are named by numbers (e.g. 0.gif, 1.gif etc.).
    <br>
    Here you can define which image is shown by which smilie or shortcut.
   </font>
   <br>
   <?php
   $arsc_dir = arsc_getdirarray("../pic/smilies"); 
   while (list($arsc_key, $arsc_file) = each($arsc_dir))
   { 
    if ($arsc_file != "." && $arsc_file != "..")
    { 
     $arsc_file = str_replace(".gif", "", $arsc_file);
     ?>
     <img src="../pic/smilies/<?php echo $arsc_file; ?>.gif" alt="<?php echo $arsc_file; ?>.gif">
     <input type="text" name="arsc_save_parameters_smilies[<?php echo $arsc_file; ?>]" value="<?php echo $arsc_smilies[$arsc_file]; ?>">
     <br>
     <?php
    } 
   }
   ?>
   <br>
   <br>
   <input type="submit" value="Save parameters">
  </form>
<?php include("footer.inc.php"); ?>
