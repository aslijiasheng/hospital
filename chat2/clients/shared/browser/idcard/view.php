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
 $arsc_user = arsc_validateinput($_GET["arsc_user"], $arsc_api->getSimpleUserlist($arsc_my["room"]), NULL, 1, 64, __FILE__, __LINE__);
 $arsc_api->userIsValid($arsc_my["user"]);
 include("../../../../languages/".$arsc_my["language"].".inc.php");
 $arsc_layout = $arsc_api->getBasicLayoutValues();
 $arsc_result = mysql_query("SELECT * FROM arsc_registered_users WHERE user = '$arsc_user'", ARSC_PARAMETER_DB_LINK);
 $arsc_a = mysql_fetch_array($arsc_result);
 ?>
 <html>
  <head>
   <title>
    <?php echo $arsc_lang["idcard_title"]." ".$arsc_user; ?>
   </title>
   <meta http-equiv="Content-Type" content="text/html; charset=<?php echo $arsc_lang["charset"]; ?>">
   <script language="JavaScript">
   <!--
    function idcard(arsc_user)
    {
     window.open('index.php?arsc_sid=<?php echo $arsc_sid; ?>&arsc_user=' + arsc_user, '<?php echo rand(); ?>', 'toolbar=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=300,height=500');
    }
   //-->
   </script>
  </head>
  <body text="<?php echo $arsc_layout["default_font_color"]; ?>" link="<?php echo $arsc_layout["default_font_color"]; ?>" vlink="<?php echo $arsc_layout["default_font_color"]; ?>" bgcolor="<?php echo $arsc_layout["default_background_color"]; ?>">
   <font face="<?php echo $arsc_layout["default_font_face"]; ?>" size="<?php echo $arsc_layout["default_font_size"]; ?>" color="<?php echo $arsc_layout["default_font_color"]; ?>">
    <font color="#FF0000">
     <b>
      <?php echo $arsc_message; ?>
     </b>
    </font>
    <?php echo $arsc_lang["idcard_title"]; ?>
    <b>
     <?php echo $arsc_user; ?>
    </b>
    <hr size="1" noshade>
    <b>
     <?php
     echo $arsc_lang["idcard_sex"];
     ?>
    </b>
    <?php
    if ($arsc_a["sex"] == 0)
    {
     ?>
     <img src="../../../../base/pic/female.gif" width="14" height="14" alt="F" border="0">
     <?php
    }
    elseif ($arsc_a["sex"] == 1)
    {
     ?>
     <img src="../../../../base/pic/male.gif" width="14" height="14" alt="M" border="0">
     <?php
    }
    else echo "-";
    ?>
    <br>
    <b>
     <?php
     echo $arsc_lang["idcard_location"];
     ?>
    </b>
    <?php
    echo $arsc_a["location"];
    ?>
    <br>
    <b>
     <?php
     echo $arsc_lang["idcard_hobbies"];
     ?>
    </b>
    <?php
    if (ARSC_PARAMETER_SMILIES == "yes" AND $arsc_api->checkCommandAllowed($arsc_my["level"], "smilies"))
    {
     reset($arsc_smilies);
     $arsc_a["hobbies"] = arsc_smilies_replace($arsc_a["hobbies"], $arsc_smilies, ARSC_PARAMETER_SMILIES_PATH);
    }
    echo $arsc_a["hobbies"];
    if ($arsc_a["flag_guestbook"] == 1)
    {
     ?>
     <hr size="1" noshade>
     <b>
      <?php
      echo $arsc_lang["idcard_guestbook"];
      ?>
     </b>
     [<a href="#arsc_add"><?php echo $arsc_lang["idcard_guestbook_add"]; ?></a>]
     <br>
     <br>
     <table width="98%" align="center">
      <?php
       arsc_showgb(FALSE);
      ?>
     </table>
     <center>
      <?php
      if ($arsc_gbls > 0)
      {
       ?>
       <a href="view.php?arsc_sid=<?php echo $arsc_my["sid"]; ?>&arsc_user=<?php echo $arsc_user; ?>&arsc_gbls=<?php echo $arsc_gbls - 5; ?>"><?php echo $arsc_lang["idcard_guestbook_prev"]; ?></a>&nbsp;
       <?php
      }
      $arsc_result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_guestbooks WHERE link_user = '$arsc_id'", ARSC_PARAMETER_DB_LINK);
      $arsc_a = mysql_fetch_array($arsc_result);
      if ($arsc_a["cnt"] > $arsc_gbls + 5)
      {
       ?>
       <a href="view.php?arsc_sid=<?php echo $arsc_my["sid"]; ?>&arsc_user=<?php echo $arsc_user; ?>&arsc_gbls=<?php echo $arsc_gbls + 5; ?>"><?php echo $arsc_lang["idcard_guestbook_next"]; ?></a>
       <?php
      }
      ?>
      <br>
      <a name="arsc_add"></a>
      <form action="add.php" method="POST">
       <input type="hidden" name="arsc_sid" value="<?php echo $arsc_my["sid"]; ?>">
       <input type="hidden" name="arsc_user" value="<?php echo $arsc_user; ?>">
       <textarea name="arsc_text" rows="8" cols="18" wrap="virtual"></textarea>
       <br>
       <input type="submit" value="<?php echo $arsc_lang["idcard_guestbook_add"]; ?>">
      </font>
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
