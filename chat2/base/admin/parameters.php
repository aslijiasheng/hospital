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
<div align="right">
 <font face="Arial" size="2">
  <a href="parameters_showall.php">DEBUG: Show all Parameters</a>
 </font>
</div>
<form action="save_parameters.php" method="POST">
 <h2>
  <font face="Arial">
   Parameters
  </font>
 </h2>
 <?php
 $arsc_query = mysql_query("SELECT name, value, description FROM arsc_parameters ORDER BY name", ARSC_PARAMETER_DB_LINK);
 while($arsc_result = mysql_fetch_array($arsc_query))
 {
  echo '<font face="Arial" size="2">';
  echo '<b>'.$arsc_result["name"].'</b>';
  echo '<br>';
  echo '<i>'.stripslashes($arsc_result["description"]).'</i>';
  echo '</font>';
  echo '<br>';
  echo '<input type="text" size="100" name="arsc_save_parameters['.$arsc_result["name"].']" value="'.$arsc_result["value"].'">';
  echo '<br>';
  echo '<br>';
  echo '<br>';
 }
 ?>
 <input type="submit" value="Save parameters">
</form>
<?php include("footer.inc.php"); ?>
