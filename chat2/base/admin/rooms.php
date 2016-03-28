<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("header.inc.php");

set_magic_quotes_runtime(1);

$arsc_rgle = 25;

?>
<font face="Arial" color="#FF0000">
 <b>
  <?php echo $arsc_message; ?>
 </b>
</font>
<h2>
 <font face="Arial">
  Rooms
 </font>
</h2>
<form action="add_room.php" method="POST">
 <font face="Arial" size="2">
  <b>
   Add new room:
  </b>
 </font>
 <input type="text" maxlength="64" size="30" name="arsc_newroom">
 <input type="submit" value="Add">
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
    Visible Roomname
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Internal Roomname
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Description
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Owner
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Password
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Type
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Layout
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
 $arsc_query1 = mysql_query("SELECT id, roomname, roomname_nice, description, owner, password, type, layout_id FROM arsc_rooms", ARSC_PARAMETER_DB_LINK);
 while ($arsc_result1 = mysql_fetch_array($arsc_query1))
 {
  if ($arsc_bgcolor == "#EEEEEE") $arsc_bgcolor = "#FFFFFF"; else $arsc_bgcolor = "#EEEEEE";
  echo "<tr bgcolor=\"".$arsc_bgcolor."\">";
  ?>
  <td bgcolor="#DDDDDD">
   <font face="Verdana, Arial" size="1">
    <a href="edit_room.php?arsc_room=<?php echo $arsc_result1["roomname"]; ?>">Edit</a>
   </font>
  </td>
  <?php
  echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_result1["roomname_nice"]."</font></td>\n";
  echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_result1["roomname"]."</font></td>\n";
  echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_result1["description"]."</font></td>\n";
  if ($arsc_result1["owner"] == -1) $arsc_result1["owner"] = "<i>System</i>";
  echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_result1["owner"]."</font></td>\n";
  echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_result1["password"]."</font></td>\n";
  echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_roomtypes[$arsc_result1["type"]]."</font></td>\n";
  $arsc_query2 = mysql_query("SELECT name FROM arsc_layouts WHERE id = '".$arsc_result1["layout_id"]."'", ARSC_PARAMETER_DB_LINK);
  $arsc_result2 = mysql_fetch_array($arsc_query2);
  echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_result2["name"]."</font></td>\n";
  ?>
  <td bgcolor="#DDDDDD">
   <font face="Verdana, Arial" size="1">
    <a href="delete_room.php?arsc_room_id=<?php echo $arsc_result1["id"]; ?>">Delete</a>
   </font>
  </td>
  <?php
  echo "</tr>";
 }
 ?>
</table>

<?php include("footer.inc.php"); ?>
