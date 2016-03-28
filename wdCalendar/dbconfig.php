<?php
@define("CORE",dirname(__FILE__)."/"); 	  //¸ùÄ¿Â¼
error_reporting(0);
class DBConnection{
	function getConnection(){
		require_once("../include/conn.php");
	  //change to your database server/user name/password
		mysql_connect($mt["host"],$mt["user"],$mt["pass"]) or
         die("Could not connect: " . mysql_error());
    //change to your database name
		mysql_select_db($mt["name"]) or 
		     die("Could not select database: " . mysql_error());
		mysql_query("set names utf8");
	}
	
}
?>
