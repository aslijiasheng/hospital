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

$arsc_rgle = 25;

?>
<font face="Arial" color="#FF0000">
 <b>
  <?php echo $arsc_message; ?>
 </b>
</font>
<h2>
 <font face="Arial">
  Registered Users
 </font>
</h2>
<form action="users.php" method="POST">
 <font face="Arial" size="2">
  <b>
   Search user:
  </b>
 </font>
 <input type="text" maxlength="64" size="30" name="arsc_search" value="<?php echo $arsc_search; ?>">
 <input type="submit" value="Search">
 <font face="Verdana, Arial" size="1">
  (Use % as wildcard)
 </font>
</form>
<form action="add_user.php" method="POST">
 <font face="Arial" size="2">
  <b>
   Add new user:
  </b>
 </font>
 <input type="text" maxlength="64" size="30" name="arsc_newuser">
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
    Username
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Level
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Default language
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Default color
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Text template
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Layout
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    eMail adress
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Gender
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Location
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Hobbies
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Guestbook visible?
   </font>
  </td>
  <td>
   <font face="Arial" size="2">
    Locked?
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
 if ($arsc_rgls == "") $arsc_rgls = 0;
 if ($arsc_search <> "")
 {
  $arsc_result = mysql_query("SELECT user, level, language, color, template, layout, email, sex, location, hobbies, flag_guestbook, flag_locked FROM arsc_registered_users WHERE user LIKE '$arsc_search'", ARSC_PARAMETER_DB_LINK);
 }
 else
 {
  $arsc_result = mysql_query("SELECT user, level, language, color, template, layout, email, sex, location, hobbies, flag_guestbook, flag_locked FROM arsc_registered_users ORDER BY level DESC, user ASC LIMIT $arsc_rgls, $arsc_rgle", ARSC_PARAMETER_DB_LINK);
 }
 while ($arsc_a = mysql_fetch_array($arsc_result))
 {
  if ($arsc_bgcolor == "#EEEEEE") $arsc_bgcolor = "#FFFFFF"; else $arsc_bgcolor = "#EEEEEE";
  echo "<tr bgcolor=\"".$arsc_bgcolor."\">";
  ?>
  <td bgcolor="#DDDDDD">
   <font face="Verdana, Arial" size="1">
    <a href="edit_user.php?arsc_user=<?php echo $arsc_a["user"]; ?>">Edit</a>
   </font>
  </td>
  <?php
  while (list($arsc_key, $arsc_val) = each($arsc_a))
  {
   list($arsc_key, $arsc_val) = each($arsc_a);
   if($arsc_key == "sex")
   {
    if($arsc_val == 0) $arsc_val = "female";
    if($arsc_val == 1) $arsc_val = "male";
   }
   if($arsc_key == "flag_guestbook")
   {
    if($arsc_val == 0) $arsc_val = "no";
    if($arsc_val == 1) $arsc_val = "yes";
   }
   if($arsc_key == "flag_locked")
   {
    if($arsc_val == 0) $arsc_val = "no";
    if($arsc_val == 1) $arsc_val = "yes";
   }
   if($arsc_key == "layout")
   {
    $arsc_layoutvalues = $arsc_api->getLayoutValues($arsc_val);
    $arsc_val = $arsc_layoutvalues["name"];
   }
   echo "<td valign=\"top\"><font face=\"Verdana, Arial\" size=\"1\">".$arsc_val."</font></td>\n";
  }
  ?>
  <td bgcolor="#DDDDDD">
   <font face="Verdana, Arial" size="1">
    <a href="delete_user.php?arsc_user=<?php echo $arsc_a["user"]; ?>">Delete</a>
   </font>
  </td>
  <?php
  echo "</tr>";
 }
 ?>
</table>
<center>
 <font face="Arial" size="2">
  <?php
  if ($arsc_rgls > 0)
  {
   ?>
   <a href="users.php?arsc_rgls=<?php echo $arsc_rgls - $arsc_rgle; ?>">Previous page</a>&nbsp;
   <?php
  }
  $arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users", ARSC_PARAMETER_DB_LINK);
  $arsc_a = mysql_fetch_array($arsc_result);
  if ($arsc_a["cnt"] > $arsc_rgls + $arsc_rgle)
  {
   ?>
   <a href="users.php?arsc_rgls=<?php echo $arsc_rgls + $arsc_rgle; ?>">Next page</a>
   <?php
  }
  ?>
 </font>
</center>
<?php include("footer.inc.php"); ?>
