<?php

define("sys_name", "proxy", false);
define("sys_vers", "4.0.2", false);
define("sys_path", "", false);

ERROR_REPORTING( 0 );
require_once( sys_path . 'config.php' );
ERROR_REPORTING( __errorReporting );

define("control", "system", true);

require_once(sys_path . 'bin/lib/String' . '.php');
require_once(sys_path . 'bin/lib/Builder' . '.php');
require_once(sys_path . 'bin/lib/Database' . '.php');

require_once(sys_path . 'login' . '.php');

if( isset($_GET["page"]) && !empty($_GET["page"]) ) $page = $_GET["page"]; else $page = null;
if( isset($_GET["subpage"]) && !empty($_GET["subpage"]) ) $subpage = $_GET["subpage"]; else $subpage = null;
if( isset($_GET["data_id"]) && !empty($_GET["data_id"]) ) $data_id = $_GET["data_id"]; else $data_id = null;

if( uac == false )
	switch( $page ) {
		case "login": require("pages/login.php"); break;
		case "recovery": require("pages/recovery.php"); break;
		case "registration": require("pages/registration.php"); break;
		default: require("pages/login.php"); break;
	}
else {
	if( is_file(sys_path . 'pages/' . $page . '.php') == TRUE )
		require(sys_path . 'pages/'.$page.'.php');
	else
		require(sys_path . 'pages/blank.php');
}

require_once(sys_path . 'page.php');

$page = preg_replace('/<!--(.*)-->/Uis', '', $page);
// $page = str_replace('	', '', $page);
// $page = str_replace('  ', ' ', $page);
// $page = str_replace('
// ', '', $page);

echo $page;

?>