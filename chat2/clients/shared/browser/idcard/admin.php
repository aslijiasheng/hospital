<?php

include("../../../../base/inc/config.inc.php");
include("../../../../base/inc/init.inc.php");
include("../../../../base/inc/functions.inc.php");
include("../../../../base/inc/api.inc.php");
include("../../../../base/inc/inputvalidation.inc.php");
include("functions.inc.php");

$arsc_api = new arsc_api_Class;
$arsc_message = arsc_validateinput(htmlspecialchars($_POST["arsc_message"], ENT_NOQUOTES), NULL, "/[^a-zA-Z0-9_\/\&\.;,\- ]/", 0, ARSC_PARAMETER_INPUT_MAXSIZE, __FILE__, __LINE__);

if ($arsc_my = $arsc_api->getUserValuesBySID(arsc_validateinput($_GET["arsc_sid"], NULL, "/[^a-z0-9]/", 40, 40, __FILE__, __LINE__)))
{
 $arsc_api->userIsValid($arsc_my["user"]);
 include("../../../../languages/".$arsc_my["language"].".inc.php");
 $arsc_layout = $arsc_api->getBasicLayoutValues();
 $arsc_result = mysql_query("SELECT * FROM arsc_registered_users WHERE user = '".$arsc_my["user"]."'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 ?>
 <html>
  <head>
   <title>
    <?php echo $arsc_lang["idcard_title"]." ".$arsc_my["user"]; ?>
   </title>
   <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $arsc_lang["charset"]; ?>">
   <script language="JavaScript">
   <!--
    function idcard(arsc_user)
    {
     window.open('index.php?arsc_sid=<?php echo $arsc_my["sid"]; ?>&arsc_user=' + arsc_user, '<?php echo rand(); ?>', 'toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=300,height=500');
    }
   //-->
   </script>
  </head>
  <body text="<?php echo $arsc_layout["default_font_color"]; ?>" link="<?php echo $arsc_layout["default_font_color"]; ?>" vlink="<?php echo $arsc_layout["default_font_color"]; ?>" bgcolor="<?php echo $arsc_layout["default_background_color"]; ?>">
   <form action="save.php" method="POST">
    <input type="hidden" name="arsc_sid" value="<?php echo $arsc_my["sid"]; ?>">
    <font face="<?php echo $arsc_layout["default_font_face"]; ?>" size="<?php echo $arsc_layout["default_font_size"]; ?>" color="<?php echo $arsc_layout["default_font_color"]; ?>">
     <font color="#FF0000">
      <b>
       <?php echo $arsc_message; ?>
      </b>
     </font>
     <?php echo $arsc_lang["idcard_title"]; ?>
     <b>
      <?php echo $arsc_my["user"]; ?>
     </b>
     <hr size="1" noshade>
     <b>
      <?php
      echo $arsc_lang["idcard_sex"];
      ?>
     </b>
     <select name="arsc_save_sex">
      <option value="0" <?php if ($arsc_a["sex"] == 0) { ?>selected<?php } ?>><?php echo $arsc_lang["idcard_female"]; ?></option>
      <option value="1" <?php if ($arsc_a["sex"] == 1) { ?>selected<?php } ?>><?php echo $arsc_lang["idcard_male"]; ?></option>
     </select>
     <br>
     <b>
      <?php
      echo $arsc_lang["idcard_location"];
      ?>
     </b>
     <input type="text" name="arsc_save_location" size="26" value="<?php echo $arsc_a["location"]; ?>">
     <br>
     <br>
     <b>
      <?php
      echo $arsc_lang["idcard_hobbies"];
      ?>
     </b>
     <br>
     <textarea rows="8" cols="30" name="arsc_save_hobbies" wrap="virtual"><?php echo $arsc_a["hobbies"]; ?></textarea>
     <br>
     <br>
     <b>
      <?php
      echo $arsc_lang["idcard_color"];
      ?>
     </b>
     <input type="text" name="arsc_save_color" size="6" value="<?php echo $arsc_a["color"]; ?>" maxlength="6">
     <br>
     <br>
     <b>
      <?php
      echo $arsc_lang["idcard_guestbook_active"];
      ?>
     </b>
     <input type="radio" name="arsc_save_flag_guestbook" value="1" <?php if ($arsc_a["flag_guestbook"] == 1) { ?>checked<?php } ?>>
     <font face="<?php echo $arsc_layout["default_font_face"]; ?>" size="<?php echo $arsc_layout["default_font_size"]; ?>" color="<?php echo $arsc_layout["default_font_color"]; ?>">
      <?php echo $arsc_lang["yes"]; ?>
     </font>
     &nbsp;
     <input type="radio" name="arsc_save_flag_guestbook" value="0" <?php if ($arsc_a["flag_guestbook"] == 0) { ?>checked<?php } ?>>
     <font face="<?php echo $arsc_layout["default_font_face"]; ?>" size="<?php echo $arsc_layout["default_font_size"]; ?>" color="<?php echo $arsc_layout["default_font_color"]; ?>">
      <?php echo $arsc_lang["no"]; ?>
     </font>
     <br>
     <div align="right">
      <input type="submit" value="<?php echo $arsc_lang["idcard_save"]; ?>">
     </div>
     <?php
     if ($arsc_a["flag_guestbook"] == 1)
     {
      ?>
      <hr size="1" noshade>
      <b>
       <?php
       echo $arsc_lang["idcard_guestbook"];
       ?>
      </b>
      <br>
      <br>
      <table width="98%" align="center">
       <?php
        arsc_showgb(TRUE);
       ?>
      </table>
      <center>
       <?php
       if ($arsc_gbls > 0)
       {
        ?>
        <a href="admin.php?arsc_sid=<?php echo $arsc_my["sid"]; ?>&arsc_gbls=<?php echo $arsc_gbls - 5; ?>"><?php echo $arsc_lang["idcard_guestbook_prev"]; ?></a>&nbsp;
        <?php
       }
       $arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_guestbooks WHERE link_user = '$arsc_id'", ARSC_PARAMETER_DB_LINK);
       $arsc_a = mysql_fetch_array($arsc_result);
       if ($arsc_a["cnt"] > $arsc_gbls + 5)
       {
        ?>
        <a href="admin.php?arsc_sid=<?php echo $arsc_my["sid"]; ?>&arsc_gbls=<?php echo $arsc_gbls + 5; ?>"><?php echo $arsc_lang["idcard_guestbook_next"]; ?></a>
        <?php
       }
       ?>
       <br>
      </center>
      <?php
     }
    ?>
   </font>
  </body>
 </html>
 <?php
}
else
{
 header("Location: ../empty.php");
 die();
}

?>
