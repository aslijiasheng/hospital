<?php

include("../../base/inc/config.inc.php");
include("../../base/inc/init.inc.php");
include("../../base/inc/functions.inc.php");
include("../../base/inc/api.inc.php");
include("../../base/inc/filter.inc.php");

$arsc_api = new arsc_api_Class;

if ($arsc_my = $arsc_api->getUserValuesBySID($arsc_sid))
{
 include("../../languages/".$arsc_my["language"].".inc.php");
 
 if ($arsc_api->userIsValid($arsc_my["user"]))
 {
  echo ARSC_PARAMETER_HTMLHEAD_MSGINPUT_JS;
  ?>
    <form action="../shared/browser/chatins.php" method="POST" target="empty" name="f" OnSubmit="return empty_field_and_submit()">
     <input type="text" name="arsc_message" size="50" maxlength="<?php echo ARSC_PARAMETER_INPUT_MAXSIZE; ?>" value="<?php echo $arsc_pretext; ?>">
    </form>
    <form action="../shared/browser/chatins.php" method="POST" target="empty" name="fdummy" OnSubmit="return empty_field_and_submit()">
     <input type="hidden" name="arsc_sid" value="<?php echo $arsc_sid; ?>">
     <input type="hidden" name="arsc_chatversion" value="sockets">
     <input type="hidden" name="arsc_message">
    </form>
   </body>
  </html>
  <?php
 }
 else
 {
  echo ARSC_PARAMETER_HTMLHEAD_OUT;
 }
}
else
{
 echo ARSC_PARAMETER_HTMLHEAD_OUT;
}
?>
