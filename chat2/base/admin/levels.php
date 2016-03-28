<?php

include("init.inc.php");
include("../inc/config.inc.php");
include("../inc/init.inc.php");
include("cookie.inc.php");
include("../inc/functions.inc.php");
include("header.inc.php");

set_magic_quotes_runtime(1);

?>
  <font face="Arial" color="#FF0000">
   <b>
    <?php echo $arsc_message; ?>
   </b>
  </font>
  <h2>
   <font face="Arial">
    Level Right Management
   </font>
  </h2>
  <table cellspacing="0" cellpadding="6">
   <?php
   $arsc_result = mysql_query("SELECT * FROM arsc_levels ORDER BY command", ARSC_PARAMETER_DB_LINK);
   $arsc_bgcolor = "#EEEEEE";
   $arsc_b = mysql_fetch_array($arsc_result);
   ksort($arsc_b);
   ?>
   <tr bgcolor="#DDDDDD">
    <td>
     <font face="Arial" size="2">
      <b>
       Command
      </b>
     </font>
    </td>
    <?php
    while (list($arsc_key, $arsc_val) = each($arsc_b))
    {
     if (strstr($arsc_key, "level"))
     {
      echo "<td align=\"center\"><font face=\"Arial\" size=\"2\"><b><a title=\"Delete level\" href=\"delete_level.php?arsc_level=".str_replace("level", "", $arsc_key)."\">Level ".str_replace("level", "", $arsc_key)."</a></b></font></td>\n";
     }
    }
    ?>
   </tr>
   <?php
   $arsc_result = mysql_query("SELECT * FROM arsc_levels ORDER BY command", ARSC_PARAMETER_DB_LINK);
   while ($arsc_a = mysql_fetch_array($arsc_result))
   {
    if ($arsc_bgcolor == "#EEEEEE") $arsc_bgcolor = "#FFFFFF"; else $arsc_bgcolor = "#EEEEEE";
    ?>
    <tr bgcolor="<?php echo $arsc_bgcolor; ?>">
     <td bgcolor="#DDDDDD">
      <font face="Arial" size="2">
       <?php echo $arsc_a["command"]; ?>&nbsp;&nbsp;&nbsp;
      </font>
     </td>
     <?php
     ksort($arsc_a);
     while (list($arsc_key, $arsc_val) = each($arsc_a))
     {
      if (strstr($arsc_key, "level"))
      {
       ?>
       <td align="center">
        <font face="Arial" size="2">
         <?php
         if ($arsc_val == 1)
         {
          ?>
          <a title="Deactivate this right for this level" style="text-decoration:none;" href="switchright.php?arsc_command=<?php echo $arsc_a["command"]; ?>&arsc_level=<?php echo str_replace("level", "", $arsc_key); ?>&arsc_switchto=0">[o]</a>
          <?php
         }
         else
         {
          ?>
          <a title="Activate this right for this level" style="text-decoration:none;" href="switchright.php?arsc_command=<?php echo $arsc_a["command"]; ?>&arsc_level=<?php echo str_replace("level", "", $arsc_key); ?>&arsc_switchto=1">[&nbsp;&nbsp;&nbsp;]</a>
          <?php
         }
         ?>
        </font>
       </td>
       <?php
      }
     }
     ?>
    </tr>
    <?php
   }
   ?>
  </table>
  <font face="Arial" size="1">
   (Level 0 is for guests, level 10 is for operators, level 20 for VIPs, level 30 for moderators,
   <br>
   level 99 for admins - all other levels are freely definable)
  </font>
  <form action="add_level.php" method="POST">
   <font face="Arial" size="2">
    <b>
     Add new level:
    </b>
   </font>
   <input type="text" maxlength="2" size="2" name="arsc_level">
   <input type="submit" value="Add">
  </form>
<?php include("footer.inc.php"); ?>
