<?php

// Error handling
function arsc_error_log($level, $text, $file, $line)
{
 GLOBAL $arsc_errorlevels;
 $date = date("Y-m-d H:i:s"); 
 if ($level > ARSC_PARAMETER_LOGERRORSABOVE)
 {
  $fp = @fopen("/tmp/arsc_error.".ARSC_INSTALLATIONID.".log", "a");
  @fputs($fp, $date." ".$arsc_errorlevels[$level]." ".$text." (File ".$file.", Line ".$line.")\n");
  @fclose($fp);
 }
 if ($level > ARSC_PARAMETER_SHOWERRORSABOVE)
 {
  echo("<p>\n<strong>Error: </strong> ".$date." ".$arsc_errorlevels[$level]." ".$text." <em>(File ".$file.", Line ".$line.")</em>\n</p>\n");
 }
 if ($level > ARSC_PARAMETER_DIEIFERRORLEVELABOVE)
 {
  die();
 }
}

// return current time
function arsc_microtime()
{
 return time();
}

// Use own sha1() function if it is not available - You wouldn't believe how old some PHP installations are...
if (!function_exists("sha1"))
{
 function sha1($input)
 {
  return(md5($input).substr(md5($input), 0, 8));
 }
}

// Replace smilies with image tag //FIXME: Move into API
// RN: fixed: reset($smilies); inserted since of copy of smilie 
//	arrays points beyond $key in help.php
function arsc_smilies_replace($text, $smilies, $smilies_pfad)
{
 reset($smilies);
 while (list($key, $val) = each($smilies))
 {
  $text = str_replace($val, "<img src=\"".$smilies_pfad.$key.".gif\" border=\"0\" alt=\"".$val."\">", $text);
 }
 return $text;
}

function arsc_getdirarray($path)
{
	$handle = opendir($path);
	while ($file = readdir($handle)) $return[count($return)] = $file;
	closedir($handle);
	sort($return);
	reset($return);
	return $return;
}

function arsc_getVirtualServer($ip)
{
 if (ARSC_PARAMETER_VIRTUALSERVERS_USE == "yes")
 {
  $result = mysql_query("SELECT COUNT(id) AS cnt FROM arsc_users WHERE ip = '".$ip."'", ARSC_PARAMETER_DB_LINK);
  $a = mysql_fetch_array($result);
  $server = $a["cnt"] - 1;
  if ($server > 9 OR $server < 0)
  {
   srand((double)microtime*1000000);
   $server = rand(0, 9);
  }
  $return = str_replace("%", $server, ARSC_PARAMETER_VIRTUALSERVERS_NAME);
 }
 else
 {
  $return = "";
 }
 return $return;
}

?>
