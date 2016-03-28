<?php

function arsc_validateinput($source, $allowedvalues, $filter = NULL, $minlenght = 0, $maxlenght = ARSC_PARAMETER_USERINPUTMAXLENGTH, $filename = "", $linenumber = "")
{
 if (is_array($allowedvalues))
 {
  if (!in_array($source, $allowedvalues))
  {
   arsc_error_log(ARSC_ERRORLEVEL_WARN, "File: ".$filename.", Linenumber: ".$linenumber.": Value '".$source."' is not in the given array of allowed values.", __FILE__, __LINE__);
   return "";
  }
  else
  {
   return $source;
  }
 }
 else
 {
  if (strlen($source) < $minlenght OR strlen($source) > $maxlenght)
  {
   arsc_error_log(ARSC_ERRORLEVEL_WARN, "File: ".$filename.", Linenumber: ".$linenumber.": Value '".$source."' is out of range, must be > ".$minlenght.", < ".$maxlenght.".", __FILE__, __LINE__);
   return "";
  }
  else
  {
   if ($filter != NULL)
   {
    if (preg_match($filter, $source))
    {
     arsc_error_log(ARSC_ERRORLEVEL_WARN, "File: ".$filename.", Linenumber: ".$linenumber.": Value '".$source."' could not be filtered through '".$filter."'.", __FILE__, __LINE__);
     return "";
    }
    else
    {
     return $source;
    }
   }
   else
   {
    return $source;
   }
  }
 }
}

?>
