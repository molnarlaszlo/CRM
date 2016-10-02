<?php

require_once(sys_path . "bin/mod/Whois.php");

require_once(sys_path . 'bin/lib/Network' . '.php');

/**/ // Framework variables
$title = "Domain scan";
$page_title = "Domain scan";
$page_crumbs = array( array("", "Ethical Hacker's station"), "Network tools", "Full domain scan");

/**/ // Obtain user input
$domain = $_GET["param"];
if($domain != null) {
	$title = "Domain scan (".$domain.")";
	$page_title = "Domain scan (".$domain.")";
	$page_crumbs[sizeof($page_crumbs)] = $domain;
}

/**/ // Declare identity
$ip = rand(35, 212).".".rand(3, 126).".".rand(1, 254).".".rand(1, 254);

/**/ // Declare data variables
$dns = $http = $httpf = $https = $whois = "";

/**/ // Obtain WHOIS information
$whois = getWhois($domain);

/**/ // Obtain HTTP/HTTPS Request responses
$http = "";

$obtain_done = false;
$obtain_target = $domain;

$responses = array();
$redirects = array();

$_redirects = array(
	"300 Multiple Choices",
	"301 Moved Permanently",
	"302 Moved Temporarily",
	"302 Found",
	"303 See Other",
	"304 Not Modified",
	"305 Use Proxy",
	"307 Temporary Redirect",
	"308 Permanent Redirect",
	
	"HTTP/1.0 300 Multiple Choices",
	"HTTP/1.0 301 Moved Permanently",
	"HTTP/1.0 302 Moved Temporarily",
	"HTTP/1.0 302 Found",
	"HTTP/1.0 303 See Other",
	"HTTP/1.0 304 Not Modified",
	"HTTP/1.0 305 Use Proxy",
	"HTTP/1.0 307 Temporary Redirect",
	"HTTP/1.0 308 Permanent Redirect",
	
	"HTTP/1.1 300 Multiple Choices",
	"HTTP/1.1 301 Moved Permanently",
	"HTTP/1.1 302 Moved Temporarily",
	"HTTP/1.1 302 Found",
	"HTTP/1.1 303 See Other",
	"HTTP/1.1 304 Not Modified",
	"HTTP/1.1 305 Use Proxy",
	"HTTP/1.1 307 Temporary Redirect",
	"HTTP/1.1 308 Permanent Redirect"
);

while($obtain_done == false) {
	$curl = curl_init();

	curl_setopt( $curl, CURLOPT_HTTPHEADER,
		array(
			"Remote_Addr: " . $ip,
			"Http_x_forwarded_for: " . $ip,
		)
	);
	
	curl_setopt_array($curl, array(
		CURLOPT_URL => $obtain_target,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_VERBOSE => 1,
		CURLOPT_HEADER => 1,
		CURLOPT_TIMEOUT => 16,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0'
	));
	
	$response = curl_exec($curl);
	
	if(curl_errno($curl) != null) {
		$http .= NL . NL . "Warning! Error(".curl_errno($curl)." -> ".curl_error($curl).") on ".$target;
		$ok = true;
		break;
	}
	
	$header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
	$header = substr($response, 0, $header_size);
	// $body = substr($response, $header_size);

	curl_close($curl);

	$header = getHeadersFromCurlResponse($header);
	
	if(isset($header["location"]) == TRUE) {
		$header["Location"] = $header["location"];
		unset($header["location"]);
	}

	$responses[sizeof($responses)] = $header;

	$http .= NL . '---------------------------' . NL . NL;
	foreach( (array) $header as $key => $value)
		$http .= $key . ': ' . $value . NL;

	if(in_array($header["http_code"], $_redirects) == true) {
		$redirects[sizeof($redirects)] = array(str_replace("HTTP/1.1 ", "", $header["http_code"]), $obtain_target, $header["Location"]);
		$obtain_target = $header["Location"];
	}
	else
		$obtain_done = true;
}

$_redirects = "";
foreach($redirects as $redirect)
	$_redirects .= '(' . $redirect[0] . ') ' . $redirect[1] . ' --> ' . $redirect[2] . NL;

$http = 'Status: ' . str_replace("HTTP/1.1 ", "", $responses[ sizeof($responses) - 1 ]["http_code"]) . NL . $_redirects . $http;

/**/ // Obtain DNS records
$dns .= "Nameservers:".NL;
$dns_r = dns_get_record($domain, DNS_NS);
for($i = sizeof($dns_r)-1; $i >= 0; $i--)
	$dns .= TB.$dns_r[$i]["class"].' '.$dns_r[$i]["type"].' '.$dns_r[$i]["ttl"].' :: '.$dns_r[$i]["target"].NL;
if( sizeof($dns_r) == 0 )
	$dns .= TB.'No records.'.NL;
$dns .= NL;

$dns .= "Record types A:".NL;
$dns_r = dns_get_record($domain, DNS_A);
for($i = 0; $i < sizeof($dns_r); $i++)
	$dns .= TB.$dns_r[$i]["class"].' '.$dns_r[$i]["type"].' '.$dns_r[$i]["ttl"].' :: '.$dns_r[$i]["ip"].' '.NL;
if( sizeof($dns_r) == 0 )
	$dns .= TB.'No records.'.NL;
$dns .= NL;

$dns .= "Record types AAAA:".NL;
$dns_r = dns_get_record($domain, DNS_AAAA);
for($i = 0; $i < sizeof($dns_r); $i++)
	$dns .= TB.$dns_r[$i]["class"].' '.$dns_r[$i]["type"].' '.$dns_r[$i]["ttl"].' :: '.$dns_r[$i]["ipv6"].NL;
if( sizeof($dns_r) == 0 )
	$dns .= TB.'No records.'.NL;
$dns .= NL;

$dns .= "Record types MX:".NL;
$dns_r = dns_get_record($domain, DNS_MX);
for($i = 0; $i < sizeof($dns_r); $i++)
	$dns .= TB.$dns_r[$i]["class"].' '.$dns_r[$i]["type"].' '.$dns_r[$i]["ttl"].' :: '.$dns_r[$i]["pri"].' '.$dns_r[$i]["target"].NL;
if( sizeof($dns_r) == 0 )
	$dns .= TB.'No records.'.NL;
$dns .= NL;

$dns .= "Record types SOA: (mname, rname, serial, refresh, retry, expire, minimum-ttl)".NL;
$dns_r = dns_get_record($domain, DNS_SOA);
for($i = 0; $i < sizeof($dns_r); $i++)
	$dns .= TB.$dns_r[$i]["class"].' '.$dns_r[$i]["type"].' '.$dns_r[$i]["ttl"].' :: '.$dns_r[$i]["mname"].' '.$dns_r[$i]["rname"].' '.$dns_r[$i]["serial"].' '.$dns_r[$i]["refresh"].' '.$dns_r[$i]["retry"].' '.$dns_r[$i]["expire"].' '.$dns_r[$i]["minimum-ttl"].NL;
if( sizeof($dns_r) == 0 )
	$dns .= TB.'No records.'.NL;
$dns .= NL;

$dns .= "Record types TXT:".NL;
$dns_r = dns_get_record($domain, DNS_TXT);
for($i = 0; $i < sizeof($dns_r); $i++)
	$dns .= TB.$dns_r[$i]["class"].' '.$dns_r[$i]["type"].' '.$dns_r[$i]["ttl"].' :: '.$dns_r[$i]["txt"].NL;
if( sizeof($dns_r) == 0 )
	$dns .= TB.'No records.'.NL;
$dns .= NL;

$dns_cname = dns_get_record($domain, DNS_CNAME);
$dns_naptr = dns_get_record($domain, DNS_NAPTR);
$dns_hinfo = dns_get_record($domain, DNS_HINFO);
$dns_ptr = dns_get_record($domain, DNS_PTR);
$dns_srv = dns_get_record($domain, DNS_SRV);

if( sizeof($dns_cname) > 0) $dns .= 'WARNING! CNAME dns record found.'.NL;
if( sizeof($dns_naptr) > 0) $dns .= 'WARNING! NAPTR dns record found.'.NL;
if( sizeof($dns_hinfo) > 0) $dns .= 'WARNING! HINFO dns record found.'.NL;
if( sizeof($dns_ptr) > 0) $dns .= 'WARNING! PTR dns record found.'.NL;
if( sizeof($dns_srv) > 0) $dns .= 'WARNING! SRV dns record found.'.NL;

/**/ // Get TXT data
$robots = $humans = $hackers = null;

// $robots = file_get_contents("http://" . $domain . "/robots.txt", 10);
// $humans = file_get_contents("http://" . $domain . "/humans.txt", 10);
// $hackers = file_get_contents("http://" . $domain . "/hackers.txt", 10);

if($robots != null) $robots = '<h2>robots.txt</h2><pre>'.$robots.'</pre>'.NL;
if($humans != null) $humans = '<h2>humans.txt</h2><pre>'.$humans.'</pre>'.NL;
if($hackers != null) $hackers = '<h2>hackers.txt</h2><pre>'.$hackers.'</pre>'.NL;


/**/ // Make the page
$content =
	gCol(4, 4, 3,
		gPanel(
			null,
			null,
			'
			<form method="GET" action="index.php">
				<input type="hidden" name="page" value="webanalizer">
				<input name="param" id="param" type="text" class="form-control" value="'.$domain.'" placeholder=""><br>
				<button type="submit" class="btn bg-primary btn-block">Scan website</a>
			</form>
			',
			null
		)
		.
		gPanel(
			null,
			null,
			gA("https://httpstatus.io", "Working HTTP reponse test", "third_party_1", "btn btn-success btn-block", true).
			gA("http://viewdns.info/dnsrecord/?domain=".$domain, "Working DNS records query", "third_party_2", "btn btn-success btn-block", true)
			,
			null
		)
		.
		gPanel(
			null,
			null,
			gButton(null, "primary", "Perform HTTP GET request", null, null, true, false).
			gButton(null, "primary", "Perform HTTP POST request", null, null, true, false).
			gButton(null, "primary", "Perform fuzzing test", null, null, true, false).
			gButton(null, "primary", "Perform crawler test", null, null, true, false).
			gButton(null, "primary", "Perform content test", null, null, true, false)
			,
			null
		)
	)
	.
	gCol(8, 4, 5,
		gPanel( null, null, '<pre>'.$http.'</pre>', null ).
		gPanel( null, null, '<pre>'.$dns.'</pre>', null ).
		gPanel( null, null, '<pre>'.$whois.'</pre>', null ).
		gPanel( null, null, $robots.$humans.$hackers, null )
	)
;

?>