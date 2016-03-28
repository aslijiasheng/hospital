<?php
session_start();
if(strtoupper($_GET['captcha']) == $_SESSION['randcode'])
	echo 'true';
else
	echo 'false';

?>