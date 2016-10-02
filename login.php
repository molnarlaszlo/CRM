<?php

/**/ // Framework is active, check visitor is logged on or not.
if( defined('control') === true )
{
	session_start();
	
	db_start($db_server, $db_user, $db_pass, $db_name);
	
	if( isset( $_SESSION["token"] ) && !empty( $_SESSION["token"] ) ) 
		$hash = ric($_SESSION["token"], true);
	else if( isset( $_COOKIE["token"] ) && !empty( $_COOKIE["token"] ) ) 
		$hash = ric($_COOKIE["token"], true); 
	else
		$hash = null;
	
	$result = mysqli_query($database, "SELECT uhr0 FROM uhr WHERE uhr3 = '".$hash."'");
	if( mysqli_num_rows( $result ) == 1 )
		define("uac", true, true);
	else
		define("uac", false, true);
}

/**/ // Framework is not active, we have a login proccess here.
else {
	
	/**/ // We have to initialize the base of the system.
	ERROR_REPORTING( 0 );
	require_once( dirname(__FILE__) . '/' . 'config.php' );
	ERROR_REPORTING( __errorReporting );
	
	require_once(dirname(__FILE__) . '/' . 'bin/lib/System' . '.php');
	require_once(dirname(__FILE__) . '/' . 'bin/lib/String' . '.php');
	require_once(dirname(__FILE__) . '/' . 'bin/lib/Database' . '.php');

	db_start($db_server, $db_user, $db_pass, $db_name);
	
	/**/ // Collect needed input data.
	if(isset($_POST["type"]) && !empty($_POST["type"])) $type = $_POST["type"]; else $type = null;
	
	/**/ // Complete the proccess.
	switch( $type ) {
		case "login":
			if( isset($_POST["i1"]) && !empty($_POST["i1"]) )
				$user = $_POST["i1"];
			else
				$user = null;
			if( isset($_POST["i2"]) && !empty($_POST["i2"]) )
				$pass = $_POST["i2"];
			else
				$pass = null;
			
			$user = ric($user, true);
			$pass = ric($pass, true);
			
			if($user == "" || $user == null || strlen($user) > 32)
			{
				Location("index.php");
				die();
			}
			if($pass == "" || $pass == null || strlen($pass) > 256)
			{
				Location("index.php");
				die();
			}
			
			$pass = hash("sha256", $pass);
			
			$result = mysqli_query($database, "SELECT drm1 FROM drm WHERE drm4 = '".$user."' AND drm5 = '".$pass."'");
			if( mysqli_num_rows( $result ) == 1 ) {
				
				$hash = generateHash(256);
				setcookie("token", $hash, time()+60*60*24*7, "/");
				
				mysqli_query($database, "UPDATE uhr SET uhr3 = '".$hash."'");
			}
			else
				setcookie("token", generateHash(256), time()+60*60*24*7, "/");
			
			Location("index.php");
			die();
		break;
		case "recovery":
		
			Location("index.php");
			die();
		break;
		case "registration":
		
			Location("index.php");
			die();
		break;
		default:

			Location("index.php");
			die();
		break;
	}

}

?>