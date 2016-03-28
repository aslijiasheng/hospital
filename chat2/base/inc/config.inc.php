<?php

/*

  This is the main configuration file of ARSC. To get ARSC running
  and customize it to your needs, you will have to change some
  parameters here. Every parameter is explained with a comment, 
  and you must ONLY change the values between the two " in every line!

  Here are stored the parameters you definitely have to change to
  get things running so you can at least use the 'install.php' script
  (you already read the INSTALL file, right?). A second part allows
  fine tuning of your installation, this is done with a web interface.

*/


// PARAMETERS ////////////////////////////////////////////////

// What is the DNS or IP address of your MySQL server?

   define("ARSC_PARAMETER_DB_HOST", "localhost");

// IMPORTANT: If you don't know what MySQL is or whether you have a
// MySQL server or not, then you have a problem - contact you server
// administrator.


// What is the name of the user who has access to the ARSC database?

   define("ARSC_PARAMETER_DB_USER", "root");


// And what is his password?

   define("ARSC_PARAMETER_DB_PASSWORD", "35612615");


// Finally, in which database will you store the ARSC tables?
// This database MUST exist before you use the install script,
// and it MUST be accessible by the user you just supplied.

   define("ARSC_PARAMETER_DB_DATABASE", "arsc");


// END OF CONFIGURATION
//////////////////////////////////////////////


/*

  Refer to the INSTALL file to see what to do next.

*/ 

?>
