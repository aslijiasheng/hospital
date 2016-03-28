<?php

include("../../../base/inc/config.inc.php");
include("../../../base/inc/init.inc.php");
include("../../../base/inc/functions.inc.php");
include("../../../base/inc/inputvalidation.inc.php");
include("../../../base/inc/api.inc.php");

$arsc_api = new arsc_api_Class;

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 $arsc_api->userIsValid($arsc_my["user"]);
 include("../../../languages/".$arsc_my["language"].".inc.php");
 $arsc_layout = $arsc_api->getBasicLayoutValues();
 // FIXME: Use Layout, not hardcoded HTML
 ?>
 <html>
  <head>
   <title>
    <?php echo $arsc_lang["helplink"]." - ".ARSC_PARAMETER_TITLE; ?>
   </title>
   <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $arsc_lang["charset"]; ?>">
  </head>
  <body text="<?php echo $arsc_layout["default_font_color"]; ?>" link="<?php echo $arsc_layout["default_font_color"]; ?>" vlink="<?php echo $arsc_layout["default_font_color"]; ?>" bgcolor="<?php echo $arsc_layout["default_background_color"]; ?>">
   <div align="justify">
    <font face="<?php echo $arsc_layout["default_font_face"]; ?>" size="<?php echo $arsc_layout["default_font_size"]; ?>" color="<?php echo $arsc_layout["default_font_color"]; ?>">
     <?php
     echo nl2br($arsc_lang["help"]);
     if ($arsc_my["level"] > 0)
     {
      echo "<br>\n<br>\n".nl2br($arsc_lang["helpop"]);
     }
     echo "<br><br></font>";
     ?>
    </font>
   </div>
   <br>
   <font face="<?php echo $arsc_layout["default_font_face"]; ?>" size="<?php echo $arsc_layout["default_font_size"]; ?>" color="<?php echo $arsc_layout["default_font_color"]; ?>">
    <?php echo $arsc_lang["smilielist"]; ?>:
   </font>
   <table>
    <?php
    if ($arsc_api->checkCommandAllowed($arsc_my["level"], "smilies"))
    {
     reset($arsc_smilies);
     $tmp_all_smilies = $arsc_smilies;	// arsc_smilies_replace() needs copy of smilies without the pointer which while() needs.
     while (list($key, $val) = each($arsc_smilies))
     {
      $arsc_smilielist .= "<tr><td><font face=\"".$arsc_layout["default_font_face"]."\" size=\"".$arsc_layout["default_font_size"]."\" color=\"".$arsc_layout["default_font_color"]."\">".$val."</font></td><td> &nbsp; </td><td>".arsc_smilies_replace($val, $tmp_all_smilies, ARSC_PARAMETER_SMILIES_PATH)."</td></tr>";
     }
     echo $arsc_smilielist;
     unset($tmp_all_smilies);
    }
    echo "</table>";
    ?>
   </table>
  </body>
 </html>
 <?php
}
else
{
 header("Location: empty.php");
 die();
}

?>
