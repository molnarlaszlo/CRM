<?php

/** Function for generate JS based Ajax requests on any servers.
* RETURN: String.
* - Simplified version for internal uses (on data pages).
* Parameters: 
* 	String name -> name of the function
*	String ID -> dataholder element ID
*	String page -> website, path or file where the Ajax resolver is.
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
**/
function genAjaxGETRequest($name, $id, $page) {
	return '
		<script>
			function '.$name.'(str)
			{
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function()
					if( xmlhttp.readyState == 4 && xmlhttp.status == 200 )
						document.getElementById("'.$id.'").innerHTML = xmlhttp.responseText;
				xmlhttp.open("GET", "'.$page.'"+str, true);
				xmlhttp.send();   
			}
		</script>
	';
}

/** Function for collecting references on website pages.
* RETURN: String array.
* - Warning! No error handling method implified, make sure the page is accessable.
* Parameters:
*	String domain -> Path for the content -> Pattern: http(s)://[www.]<domain>.<tld>[/^file_name.<MIME>]
*	Integer timeout -> 0->NA -> Timeout time in seconds.
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
**/
function crawlOnDomain($domain, $timeout = 30) {
	
	/***/ // Please redo this function.
	/* Needed changes:
	*	- Full GET request with implified user agent, IP, etc..
	*	- Follow redirects, handle the last redirect (if status = 200)
	*	- Quit with null result if the pagecontent is less than 6 chars
	*	- Quit with null result if the status code is unaccaptable (ex: 404)
	*	- Collect email addresses with mailto: references
	*	- Collect telephone numbers with tel: rerences
	*	- Collect protocol addresses (ex: FTP:/, GIT, Torrent Magnet)
	*	- Collect static (out of HTML rerence) references (ex ip addresses and simple text with domains)
	*	- DO NOT USE undefined string array variables especially not four of them!
	*/
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $domain);
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$result = curl_exec($ch);
	curl_close($ch);

	$loot = array();

	if( $result )
	{
		preg_match_all( '/href="([^"]*)"/', $result, $output1, PREG_SET_ORDER );
		preg_match_all( "/href='([^']*)'/", $result, $output2, PREG_SET_ORDER );
		
		preg_match_all( '/src="([^"]*)"/', $result, $output3, PREG_SET_ORDER );
		preg_match_all( "/src='([^']*)'/", $result, $output4, PREG_SET_ORDER );

		$looter = array_merge( $output1, $output2, $output3, $output4 );

		foreach( $looter as $item ) {
			$item[0] = str_replace(' ', '', $item[0]);
			$item[0] = str_replace('	', '', $item[0]);
			$item[0] = str_replace('"', '', $item[0]);
			$item[0] = str_replace("'", '', $item[0]);
			$item[0] = str_replace('href=', '', $item[0]);
			$item[0] = str_replace('src=', '', $item[0]);
			
			$loot[sizeof($loot)] = $item[0];
		}
	}
	
	return $loot;
}

/** Function for scan port avibility on servers.
* RETURN: Boolean.
* Paramters:
*	String target -> Target server URL / IP
*	Integer port -> 0->65535 -> Scanned port.
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
**/
function scanPort($target, $port = 80) {
	$con = @fsockopen($host, $port);
	$return = false;
	
	if( is_resource($con) === TRUE )
		$return = $true;
	
	fclose($con);
	return $return;
}

/** Function for getting HTTP response code for requests.
* RETURN: Integer -> 100->600.
* Parameters:
*	String domain -> Pattern: http(s)://[www.]<domain>.<tld>[/^file_name.<MIME>]
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
**/
function getHttpStatusCode($domain) {
	
	/***/ // Please redo this function.
	/* Needed changes:
	*	- Full GET request with implified user agent, IP, etc..
	*	- Follow redirects, handle the last redirect (if status = 200)
	*/
	
	$handle = curl_init($domain);
	curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
	$response = curl_exec($handle);

	/* Check for 404 (file not found). */
	$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
	curl_close($handle);
	
	return $httpCode;
}

/** Function for get AVG PING response time in milli seconds.
* RETURN: Integer -> -1->Type_MAX.
* Parameters:
*	String domain -> Pattern: http(s)://[www.]<domain>.<tld>[/^file_name.<MIME>]^IPv4^Pv6
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
**/
function ping($domain){
	
	/***/ // Please redo this function.
	/* Needed changes:
	*	- Use pingerB.exe results with EXEC (what has been disabled fck..)
	*	- Maybe on other server?
	*/
	
    $starttime = microtime(true);
    $file      = fsockopen ($domain, 80, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) $status = -1;  // Site is down
    else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}

/** Function for break Curl HTTP response resource into string array.
* RETURN: String array.
* Parameters:
*	? response -> Curl response to work with.
* Created by: Leslie Miller -> 732-432-112 -> 2016 06 30 22 22 -> v2.0.
**/
function getHeadersFromCurlResponse($response)
{
	$headers = array();
	$header_text = substr($response, 0, strpos($response, "\r\n\r\n"));

	foreach (explode("\r\n", $header_text) as $i => $line)
		if ($i === 0)
			$headers['http_code'] = $line;
		else
		{
			list ($key, $value) = explode(': ', $line);
			$headers[$key] = $value;
		}

	return $headers;
}

?>