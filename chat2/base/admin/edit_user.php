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
    Change User <?php echo $arsc_user; ?>
   </font>
  </h2>
  <form action="save_user.php" method="POST">
   <?php
   if ($arsc_rgsl == "") $arsc_rgsl = 0;
   $arsc_query = mysql_query("SELECT * FROM arsc_registered_users WHERE user = '$arsc_user'", ARSC_PARAMETER_DB_LINK);
   $arsc_result = mysql_fetch_array($arsc_query);
   ?>
   <input type="hidden" name="arsc_save_id" value="<?php echo $arsc_result["id"]; ?>">
   <input type="hidden" name="arsc_user" value="<?php echo $arsc_result["user"]; ?>">
   <table>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Username:
      </font>
     </td>
     <td valign="top">
      <input type="text" size="30" maxlength="64" name="arsc_save_user" value="<?php echo $arsc_result["user"]; ?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Level: 
      </font>
     </td>
     <td valign="top">
      <select name="arsc_save_level">
       <?php
       $arsc_levels = $arsc_api->getLevellist();
       while(list($arsc_key, $arsc_val) = each($arsc_levels))
       {
        $arsc_selected = "";
        if($arsc_result["level"] == $arsc_val) $arsc_selected = " selected";
        echo "<option value=\"".$arsc_val."\"".$arsc_selected.">".$arsc_val."</option>\n";
       }
       ?>
      </select>
      <font face="Verdana, Arial" size="1">
       (0-99, 0=Guest, 10=Operator, 20=VIP, 30=Moderator, 99=Admin)
      </font>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Password:
      </font>
     </td>
     <td valign="top">
      <input type="password" size="30" maxlength="64" name="arsc_save_password" value="">
      <font face="Verdana, Arial" size="1">
       (Leave password field empty to keep the current password)
      </font>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Default language:
      </font>
     </td>
     <td valign="top">
      <input type="text" size="30" maxlength="64" name="arsc_save_language" value="<?php echo $arsc_result["language"]; ?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Default color (HEX):
      </font>
     </td>
     <td valign="top">
      <input type="text" size="6" maxlength="6" name="arsc_save_color" value="<?php echo $arsc_result["color"]; ?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Text template:
      </font>
     </td>
     <td valign="top">
      <select name="arsc_save_template">
       <?php
       $arsc_templates = $arsc_api->getTemplatelist();
       while(list($arsc_key, $arsc_val) = each($arsc_templates))
       {
        $arsc_selected = "";
        if($arsc_result["template"] == $arsc_val) $arsc_selected = " selected";
        echo "<option value=\"".$arsc_val."\"".$arsc_selected.">".$arsc_val."</option>\n";
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
      <select name="arsc_save_layout">
       <?php
       $arsc_layouts = $arsc_api->getLayoutlist();
       while(list($arsc_key, $arsc_val) = each($arsc_layouts))
       {
        $arsc_selected = "";
        if($arsc_result["layout"] == $arsc_key) $arsc_selected = " selected";
        echo "<option value=\"".$arsc_key."\"".$arsc_selected.">".$arsc_val."</option>\n";
       }
       ?>
      </select>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       eMail adress:
      </font>
     </td>
     <td valign="top">
      <input type="text" size="30" maxlength="255" name="arsc_save_email" value="<?php echo $arsc_result["email"]; ?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Gender:
      </font>
     </td>
     <td valign="top">
      <select name="arsc_save_sex">
       <option value="0"<?php if($arsc_result["sex"] == 0) echo " selected"; ?>>female</option>
       <option value="1"<?php if($arsc_result["sex"] == 1) echo " selected"; ?>>male</option>
      </select>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Location:
      </font>
     </td>
     <td valign="top">
      <input type="text" size="30" maxlength="255" name="arsc_save_location" value="<?php echo $arsc_result["location"]; ?>">
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Hobbies:
      </font>
     </td>
     <td valign="top">
      <textarea rows="10" cols="30" wrap="virtual" name="arsc_save_hobbies"><?php echo $arsc_result["hobbies"]; ?></textarea>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Make guestbook visible?
      </font>
     </td>
     <td valign="top">
      <select name="arsc_save_flag_guestbook">
       <option value="0"<?php if($arsc_result["flag_guestbook"] == 0) echo " selected"; ?>>no</option>
       <option value="1"<?php if($arsc_result["flag_guestbook"] == 1) echo " selected"; ?>>yes</option>
      </select>
     </td>
    </tr>
    <tr>
     <td valign="top">
      <font face="Arial" size="2">
       Lock this user?:
      </font>
     </td>
     <td valign="top">
      <select name="arsc_save_flag_locked">
       <option value="0"<?php if($arsc_result["flag_locked"] == 0) echo " selected"; ?>>no</option>
       <option value="1"<?php if($arsc_result["flag_locked"] == 1) echo " selected"; ?>>yes</option>
      </select>
     </td>
    </tr>
   </table>
   <input type="submit" value="Save changes">
  </form>
  <font face="Arial" size="2">
   <a href="users.php">Back to userlist</a>
  </font>
<?php include("footer.inc.php"); ?>
