<?php

set_magic_quotes_runtime(0);

// More parameters
define("ARSC_VERSION", "3.3-rc2");
define("ARSC_PARAMETER_HOSTNAME", $_SERVER["HTTP_HOST"]);
define("ARSC_PARAMETER_CURRENTDIR", dirname($_SERVER["PHP_SELF"]));
define("ARSC_PARAMETER_HTMLHEAD", "<html><head></head>\n<body bgcolor=\"#FFFFFF\">\n\n\n".str_repeat("<!-- This is dummy content to get some browsers running... -->\n", 100));
define("ARSC_PARAMETER_HTMLHEAD_JS", "<html><head><script language=\"JavaScript\">\n<!--\nfunction move()\n{\nif (scroll_active) window.scroll(1,400000);\nwindow.setTimeout(\"move()\",100);\n}\nscroll_active = true;\nmove();\n//-->\n</script>\n</head>\n<body bgcolor=\"#FFFFFF\" onBlur=\"scroll_active = true\" onFocus=\"scroll_active = false\">\n\n\n".str_repeat("<!-- This is dummy content to get some browsers running... -->\n", 100));
define("ARSC_PARAMETER_HTMLHEAD_OUT", "<html><head><title></title></head><body bgcolor=\"#FFFFFF\"></body></html>");
define("ARSC_PARAMETER_CHATCOLORS", "000000,696969,808080,708090,0000CD,2A58FA,6421F6,1E90FF,6A5ACD,9370DB,A503D3,9400D3,8B008B,C71585,556B2F,008000,228B22,2E8B57,46AA20,32CD32,9ACD32,DAA520,6B8E23,8B4513,A52A2A,A0522D,BC8F8F,C71585,FF0099,003366,191970,000080,00008B,0000CD,2F4F4F,4B0082,800000,8B0000,DC143C,FF0000,FF4500,B22222");
define("ARSC_PARAMETER_USERINPUTMAXLENGTH", 500);
define("ARSC_PARAMETER_DEFAULT_TEMPLATE_NAME", "html");
define("ARSC_DEBUG", FALSE);

// Errorlevels
define("ARSC_ERRORLEVEL_DEBUG", 0);
define("ARSC_ERRORLEVEL_INFO",  1);
define("ARSC_ERRORLEVEL_WARN",  2);
define("ARSC_ERRORLEVEL_ERROR", 3);
define("ARSC_ERRORLEVEL_FATAL", 4);
define("ARSC_PARAMETER_SHOWERRORSABOVE", 3);
define("ARSC_PARAMETER_LOGERRORSABOVE", -1);
define("ARSC_PARAMETER_DIEIFERRORLEVELABOVE", 3);
$arsc_errorlevels = array(ARSC_ERRORLEVEL_DEBUG => "DEBUGGING",
                          ARSC_ERRORLEVEL_INFO  => "INFORMATION",
                          ARSC_ERRORLEVEL_WARN  => "WARNING",
                          ARSC_ERRORLEVEL_ERROR => "ERROR",
                          ARSC_ERRORLEVEL_FATAL => "FATAL ERROR"
                         );

// Roomtypes
define("ARSC_ROOMTYPE_STANDARD", 0);
define("ARSC_ROOMTYPE_USER", 1);
define("ARSC_ROOMTYPE_MODERATED", 2);
$arsc_roomtypes = array(ARSC_ROOMTYPE_STANDARD  => "Standard",
                        ARSC_ROOMTYPE_USER      => "Userroom",
                        ARSC_ROOMTYPE_MODERATED => "Moderated"
                       );

// Connect the database
$arsc_db_link = @mysql_connect(ARSC_PARAMETER_DB_HOST, ARSC_PARAMETER_DB_USER, ARSC_PARAMETER_DB_PASSWORD);
if($arsc_db_link === FALSE) die("<strong>[".$arsc_errorlevels[ARSC_ERRORLEVEL_FATAL]."]</strong> Could not connect to MySQL server on '".ARSC_PARAMETER_DB_HOST."' with user '".ARSC_PARAMETER_DB_USER."'.");
define("ARSC_PARAMETER_DB_LINK", $arsc_db_link);
if(!@mysql_select_db(ARSC_PARAMETER_DB_DATABASE, ARSC_PARAMETER_DB_LINK))
{
 die("<strong>[".$arsc_errorlevels[ARSC_ERRORLEVEL_FATAL]."]</strong> Could not select MySQL database '".ARSC_PARAMETER_DB_DATABASE."'. The MySQL server said: ".mysql_error(ARSC_PARAMETER_DB_LINK).".");
}

// Get parameters from database
if ($arsc_query = mysql_query("SELECT name, value FROM arsc_parameters", ARSC_PARAMETER_DB_LINK))
{
 while ($arsc_result = mysql_fetch_array($arsc_query))
 {
  define("ARSC_PARAMETER_".strtoupper($arsc_result["name"]), $arsc_result["value"]);
 }
}

// Get templates from database
if ($arsc_query1 = mysql_query("SELECT DISTINCT template FROM arsc_templates", ARSC_PARAMETER_DB_LINK))
{
 while ($arsc_result1 = mysql_fetch_array($arsc_query1))
 {
  $arsc_temp_varname = "arsc_template_".$arsc_result1["template"];
  if ($arsc_query2 = mysql_query("SELECT name, value FROM arsc_templates WHERE template = '".mysql_escape_string($arsc_result1["template"])."'", ARSC_PARAMETER_DB_LINK))
  {
   while ($arsc_result2 = mysql_fetch_array($arsc_query2))
   {
    $arsc_temp_name = $arsc_result2["name"];
    $arsc_temp_value = $arsc_result2["value"];
    ${$arsc_temp_varname}["$arsc_temp_name"] = $arsc_temp_value;
   }
  }
 }
}

// Get smilies from database
if ($arsc_query = mysql_query("SELECT id, value FROM arsc_smilies", ARSC_PARAMETER_DB_LINK))
{
 while ($arsc_result = mysql_fetch_array($arsc_query))
 {
  $arsc_temp_id = $arsc_result["id"];
  $arsc_temp_value = $arsc_result["value"];
  $arsc_smilies[$arsc_temp_id] = $arsc_temp_value;
 }
}

define("ARSC_INSTALLATIONID", md5(ARSC_PARAMETER_BASEURL.ARSC_VERSION)); // Used for logfiles etc.

?>
