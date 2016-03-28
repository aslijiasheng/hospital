<?php

function arsc_showgb($admin)
{
 GLOBAL $arsc_gbls, $arsc_id, $arsc_a, $arsc_smilies, $arsc_layout, $arsc_api, $arsc_lang, $arsc_my;
 if ($arsc_gbls == "") $arsc_gbls = 0;
 $arsc_id = $arsc_a["id"];
 $arsc_result = mysql_query("SELECT id, date, author, text FROM arsc_guestbooks WHERE link_user = '$arsc_id' ORDER BY date DESC, id DESC LIMIT $arsc_gbls, 5", ARSC_PARAMETER_DB_LINK);
 while ($arsc_a = mysql_fetch_array($arsc_result))
 {
  ?>
   <tr bgcolor="<?php echo $arsc_layout["default_foreground_color"]; ?>">
    <td>
     <font face="<?php echo $arsc_layout["default_font_face"]; ?>" size="<?php echo $arsc_layout["default_font_size"]; ?>" color="<?php echo $arsc_layout["default_font_color"]; ?>">
      <?php
      if ($admin == TRUE)
      {
       ?>
       <a href="delete.php?arsc_gbid=<?php echo $arsc_a["id"]; ?>&arsc_sid=<?php echo $arsc_my["sid"]; ?>"><?php echo $arsc_lang["idcard_guestbook_delete"]; ?></a>
       <?php
      }
      ?>
      <b>
       <?php
       $arsc_result2 = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_registered_users WHERE user = '".$arsc_a["author"]."'", ARSC_PARAMETER_DB_LINK);
       $arsc_b = mysql_fetch_array($arsc_result2);
       if ($arsc_b["cnt"] == 1)
       {
        echo "<a href=\"javascript:idcard('".$arsc_a["author"]."');\" title=\"".$arsc_lang["cmd_idcard"]."\">".$arsc_a["author"]."</a>";
       }
       else
       {
        echo $arsc_a["author"];
       }
       ?>
      </b>
      <font size="1">
       [<?php echo $arsc_a["date"]; ?>]
      </font>
      <hr size="1" noshade>
      <?php
      if (ARSC_PARAMETER_SMILIES == "yes" AND $arsc_api->checkCommandAllowed($arsc_my["level"], "smilies"))
      {
       reset($arsc_smilies);
       $arsc_a["text"] = arsc_smilies_replace($arsc_a["text"], $arsc_smilies, ARSC_PARAMETER_SMILIES_PATH);
      }
      echo $arsc_a["text"];
      ?>
     </font>
    </td>
   </tr>
   <tr>
    <td>
     &nbsp;
    </td>
   </tr>
  <?php
 }
}

?>
