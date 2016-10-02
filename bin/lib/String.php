<?php

// ALTER TO removeIllegalCharacters
function ric( $string, $strict = false ) {
	return removeIllegalCharacters( $string, $strict );
}

/** Function for MySql injection prevention (Dumb and strict version).
* RETURN: .
* - Manualy ignore every character what is not enabled.
* - Its good for system uses.
* Parameters:
*	
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
$safeCharsRaw = "0,1,2,3,4,5,6,7,8,9,q,w,e,r,t,z,u,i,o,p,a,s,d,f,g,h,j,k,l,y,x,c,v,b,n,m,Q,W,E,R,T,Z,U,I,O,P,A,S,D,F,G,H,J,K,L,Y,X,C,V,B,N,M,@,_,.,:";
$safeChars = explode(",", $safeCharsRaw);
function removeIllegalCharacters( $string, $strict = false ) {
	global $safeChars;
	$return = "";
	for($i = 0; $i < strlen($string); $i++)
		if( in_array($string[$i], $safeChars, true) === true || ( $strict === false && $string[$i] === " ") )
			$return .= $string[$i];
	return $return;
}

/** Function for .
* RETURN: .
* Parameters:
*	
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
function generateHash($length = 8) {
	$hashCharsRaw = "0,1,2,3,4,5,6,7,8,9,q,w,e,r,t,z,u,i,o,p,a,s,d,f,g,h,j,k,l,y,x,c,v,b,n,m,Q,W,E,R,T,Z,U,I,O,P,A,S,D,F,G,H,J,K,L,Y,X,C,V,B,N,M";
	$hashChars = explode(",", $hashCharsRaw);

	$return = "";
	for($x = 1; $x <= $length; $x++)
		$return .= $hashChars[ rand(0, sizeof($hashChars)-1) ];
	return $return;
}

/** Function for .
* RETURN: .
* Parameters:
*	
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
function getWordsFromFile($file, $output = "array") {
	
	if($output != "array" && $output != "string") return null;
	if(file_exists($file) == false && $output == "string") return "";
	if(file_exists($file) == false && $output == "array") return array();
	
	$string = "";
	$array = array();
	
	$file = fopen($file, "r");
	while(!feof($file)){
		$line = fgets($file);
		$line = str_replace('	', '', $line);
		$line = str_replace('
', '', $line);

		if(strlen($line) > 0 && s($line, "#") == false) {
			if($output == "string") $string .= $string . "
";
			else if($output == "array") $array[sizeof($array)] = $line;
		}
			
	}
	
	if($output == "string") return $string;
	else if($output == "array") return $array;
}

/** Function for .
* RETURN: .
* Parameters:
*	
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
function startsWith($haystack, $needle) {
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

/** Function for .
* RETURN: .
* Parameters:
*	
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
function endsWith($haystack, $needle) {
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
}

/** Function for getting this pattern out from a link -> <domain>.<TLD>.
* RETURN: String.
* Parameters:
*	String original -> Original format of the string.
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
function cleanDomain($original) {
	$original = str_replace("https://", "", $original);
	$original = str_replace("http://", "", $original);
	$original = str_replace("www.", "", $original);
	
	$original = explode(":", $original); $original = $original[0];
	$original = explode("?", $original); $original = $original[0];
	$original = explode("#", $original); $original = $original[0];
	$original = explode("/", $original); $original = $original[0];
	
	$original = explode(".", $original);
	return $original[sizeof($original)-2].".".$original[sizeof($original)-1];
}

/** Function for getting the current (according to localhost) time and date.
* RETURN: String.
* Parameters:
*	Integer formatType -> 0->6 -> Format type.
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
function getFormattedDate($formatType = 0) {
	if($formatType == 0)
		return date("YmdHis");
	else if($formatType == 1)
		return date("Ymd");
	else if($formatType == 2)
		return date("Y/m/d/H/i/s");
	else if($formatType == 3)
		return date("Y/m/d-H:i:s");
	else if($formatType == 4)
		return date("Y/m/d H:i:s");
	else if($formatType == 5)
		return date("Y/m/d");
	else if($formatType == 6)
		return date("H:i:s");
	else
		return date("Y/m/d H:i");
}

/** Function for format input string to money format.
* RETURN: String.
* Parameters:
*	Integer number -> Type_MIN->Type_MAX -> The amount
*	Boolean fractional -> Dunno.
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
*/
function formatMoney($number, $fractional = false) {
	if($fractional)
		$number = sprintf('%.2f', $number);
	
	/**/ // Infinity is not a fun place to be. Change the line below!
	while(true) {
		$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);
		if ($replaced != $number)
			$number = $replaced;
		else
			break;
	}
	
	return $number;
}

?>