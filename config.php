<?php

define('__errorReporting', 0);

/**/ // Configuring the Owner's details
define("company_name", "UltraBlock");
define("company_disclaimer", company_name.' &copy; All Rights Reserved. Maintained by <a href="#">MTDO</a> and <a href="#">MTDA</a>.');

/**/ // Needed elements
define("BR", "<br>");
define("HR", "<hr>");

define("B", "<b>");
define("BB", "</b>");

define("SM", "<small>");
define("SMB", "</small>");

define("CT", "<center>");
define("CTB", "</center>");

define("NL", "
", false);
define("TB", "	", false);

// error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
set_time_limit(60);

/*** DATABASE CONFIGURATION ***/
$database = null;

$db_server = ""; /* censored */
$db_user = "";   /* censored */
$db_pass = "";   /* censored */
$db_name = "";   /* censored */


/**/ // Security patch
/*
$statusCode = http_response_code();
switch( $statusCode )
{
	case 200: break;
	case 300: break;
	case 301: break;
	case 302: break;
	case 303: break;
	case 404: break;
	default:
		
	break;
}
*/

// Fuzzer penetration testing preventation.
if(substr(php_sapi_name(), 0, 3) == 'cgi')
    header("Status: 200 OK");
else
    header("HTTP/1.1 200 OK");

/***/ // Set HTTP response headers (minimalise to prevent DDOS!)
header("Content-Type: text/html; charset=UTF-8");
header("Connection: keep-alive");
header("Vary: Accept-Encoding");

header("X-XSS-Protection: 1; mode=block");
header("X-Frame-Options: SAMEORIGIN");
header("X-Content-Type-Options: nosniff");

header_remove("X-Powered-By");

?>