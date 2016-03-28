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
  <font face="Arial" color="#FF0000">
   <b>
    <?php echo $arsc_message; ?>
   </b>
  </font>
  <h2>
   <font face="Arial">
    Layouts
   </font>
  </h2>
  <form action="add_layout.php" method="POST">
   <font face="Arial" size="2">
    Create new:
   </font>
   <input type="text" name="arsc_newlayout">
   <input type="submit" value="Create">
  </form>
  <table width="100%" cellspacing="0" cellpadding="3">
   <tr bgcolor="#DDDDDD">
    <td>
     <font face="Arial" size="2">
      <b>
       Edit
      </b>
     </font>
    </td>
    <td>
     <font face="Arial" size="2">
      Name
     </font>
    </td>
    <td>
     <font face="Arial" size="2">
      Default?
     </font>
    </td>
    <td>
     <font face="Arial" size="2">
      <b>
       Delete
      </b>
     </font>
    </td>
   </tr>
   <?php
   $arsc_layoutlist = $arsc_api->getLayoutlist();
   reset($arsc_layoutlist);
   while (list($arsc_key, $arsc_val) = each($arsc_layoutlist))
   {
    ?>
    <tr>
     <td bgcolor="#DDDDDD">
      <font face="Verdana, Arial" size="1">
       <a href="edit_layout.php?arsc_layout_id=<?php echo $arsc_key; ?>">Edit</a>
      </font>
     </td>
     <td valign="top">
      <font face="Verdana, Arial" size="1">
       <?php echo $arsc_val; ?>
      </font>
     </td>
     <td valign="top">
      <font face="Verdana, Arial" size="1">
       <?php if($arsc_key == ARSC_PARAMETER_DEFAULT_LAYOUT_ID) echo "yes"; ?>
      </font>
     </td>
     <td bgcolor="#DDDDDD">
      <font face="Verdana, Arial" size="1">
       <a href="delete_layout.php?arsc_layout_id=<?php echo $arsc_key; ?>">Delete</a>
      </font>
     </td>
    </tr>
    <?php
  }
  ?>
  </table>

<?php include("footer.inc.php"); ?>
