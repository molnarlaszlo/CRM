<?php

/**/ // ALTER TO db_open.
function db_start($server, $username, $password, $database) {
	return db_open($server, $username, $password, $database);
}

/**/ // ALTER TO db_close.
function db_stop() {
	return db_close();
}

/*
*
*
*
*/
function db_open($server, $username, $password, $db) {
	global $database;
	$database = mysqli_connect($server, $username, $password, $db);
	return $database;
}

/*
*
*
*
*/
function db_close() {
	global $database;
	mysqli_close($database);
	return $database;
}

/*
*
*
*
*/
function db_query($sql) {
	global $database;
	$temp = mysqli_query($database, $sql);
	return $temp;
}

/*
*
*
*
*/
function db_fullquery($server, $username, $password, $db, $sql) {
	$db = mysqli_connect($server, $username, $password, $db);
	$temp = mysqli_query($db, $sql);
	mysqli_close($db);
	return $temp;
}

/*
*
*
*
*/
function db_get($from, $what, $where) {
	global $database;

	$whatraw = explode(",", $what);
	if( sizeof($whatraw) == 0 ) return null;

	if(empty($where)) $result = mysqli_fetch_assoc( mysqli_query($database, "SELECT ".$what." FROM ".$from) );
	else   $result = mysqli_fetch_assoc( mysqli_query($database, "SELECT ".$what." FROM ".$from." WHERE ".$where) );

	if( sizeof($whatraw) == 1) return $result[$whatraw[0]];
	else return $temp;
}

/*
*
*
*
*/
function db_update($from, $what, $where) {
	global $database;
	$temp = mysqli_query($database, "");
	return $temp;
}

/*
*
*
*
*/
function db_delete($from, $what, $where) {
	global $database;
	$temp = mysqli_query($database, "");
	return $temp;
}

/*
*
*
*
*/
function db_insert($to, $what) {
	global $database;
	$temp = mysqli_query($database, "");
	return $temp;
}

/*
*
*
*
*/
function db_table_create($name) {
	global $database;
	$temp = mysqli_query($database, "");
	return $temp;
}

/*
*
*
*
*/
function db_delete_table($name) {
	global $database;
	$temp = mysqli_query($database, "");
	return $temp;
}

?>