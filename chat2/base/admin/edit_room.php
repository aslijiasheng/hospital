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
    Edit Room <?php echo $arsc_room; ?>
   </font>
  </h2>
  <form action="save_room.php" method="POST">
   <?php
   $arsc_query1 = mysql_query("SELECT id, roomname, roomname_nice, description, owner, type, layout_id FROM arsc_rooms WHERE roomname = '$arsc_room'", ARSC_PARAMETER_DB_LINK);
   $arsc_result1 = mysql_fetch_array($arsc_query1);
   ?>
   <input type="hidden" name="arsc_save_id" value="<?php echo $arsc_result1["id"]; ?>">
   <input type="hidden" name="arsc_save_roomname" value="<?php echo $arsc_result1["roomname"]; ?>">
   <table>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Roomname:
      </font>
     </td>
     <td valign="top">
      <input type="text" size="30" maxlength="64" name="arsc_save_roomname_nice" value="<?php echo $arsc_result1["roomname_nice"]; ?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Description:
      </font>
     </td>
     <td valign="top">
      <textarea rows="20" cols="50" wrap="virtual" name="arsc_save_description"><?php echo stripslashes(htmlspecialchars($arsc_result1["description"])); ?></textarea>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Owner:
      </font>
     </td>
     <td valign="top">
      <input type="text" size="30" maxlength="64" name="arsc_save_owner" value="<?php echo $arsc_result1["owner"]; ?>">
      <font face="Verdana, Arial" size="1">
       (-1 for no owner)
      </font>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Type:
      </font>
     </td>
     <td valign="top">
      <select name="arsc_save_type">
       <?php
       while(list($arsc_key, $arsc_val) = each($arsc_roomtypes))
       {
        $arsc_selected = "";
        if($arsc_result1["type"] == $arsc_key) $arsc_selected = " selected";
        echo "<option value=\"".$arsc_key."\"".$arsc_selected.">".$arsc_val."</option>\n";
       }
       ?>
      </select>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Layout:
      </font>
     </td>
     <td valign="top">
      <select name="arsc_save_layout_id">
       <?php
       $arsc_layouts = $arsc_api->getLayoutlist();
       while(list($arsc_key, $arsc_val) = each($arsc_layouts))
       {
        $arsc_selected = "";
        if($arsc_result1["layout_id"] == $arsc_key) $arsc_selected = " selected";
        echo "<option value=\"".$arsc_key."\"".$arsc_selected.">".$arsc_val."</option>\n";
       }
       ?>
      </select>
     </td>
    </tr>
   </table>
   <input type="submit" value="Save changes">
  </form>
  <font face="Arial" size="2">
   <a href="rooms.php">Back to roomlist</a>
  </font>
<?php include("footer.inc.php"); ?>
