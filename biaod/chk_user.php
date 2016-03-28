<?php
//$request = trim($_POST['user']);
$request = urldecode(trim($_POST['phone']));
//echo $request;
//$request = "月光光";
//sleep(2);
$con = mysql_connect("192.168.1.130","root","35612615");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("kskf", $con);
mysql_query("set names utf8");
$cx=mysql_query("select id,tel,name,salesid from `cs_info`",$con);
$count=mysql_num_rows($cx);
for($i=0;$i<$count;$i++)
{$row=mysql_fetch_array($cx);
		$zz.="'".$row[tel]."',";}
$bb=$zz."1";
usleep(150000);
$phones = array($bb);
$valid = 'true';
foreach($phones as $phone) {
	if( strtolower($phone) == $request )
		$valid = 'false';
}
echo $valid;
?>