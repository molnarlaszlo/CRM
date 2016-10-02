<?php

function crawler($origin) {
	global $domain, $checked, $internal_urls, $external_urls, $external_urls2, $subdomain_urls;

	if(getHttpStatusCode($origin) == 200) {
		
		if(s($origin, "https://") || s($origin, "http://")) $header = get_headers($origin);
		else $header = get_headers("http://www." . $origin);

		if(s(str_replace("Content-Type: ", "", $header[2]), "text/")) {
			
			if(!in_array($origin, $checked)) {
				$checked[sizeof($checked)] = $origin;
				
				$crawled = crawlOnDomain($origin);
				foreach($crawled as $url) {

					if(strlen($url) >= 2) {
						
						// Clear the first part of the URL addresses.
						if(s($url, "../")) {
							
							$url = str_replace("../", "", $url);
							$url = str_replace("./", "", $url);
							
							$temp = $origin;
							$temp = str_replace("https://", "", $temp);
							$temp = str_replace("http://", "", $temp);
							$temp = str_replace("www.", "", $temp);
							
							$temp = explode("?", $temp); $temp = $temp[0];
							$temp = explode("#", $temp); $temp = $temp[0];
							
							$temp = explode("/", $temp); $temp = $temp[sizeof($temp)-2];

							$url = "http://www." . $domain . "/" . $temp . "/" . $url;
						}
						
						if(s($url, "//")) 	$url = "http:" . $url;
						if(s($url, "www.")) $url = "http://" . $url;
						if(s($url, "https://") == false && s($url, "http://") == false && s($url, '/')) $url = "http://www.".$domain."".$url;
						else if(s($url, "https://") == false && s($url, "http://") == false) 			$url = "http://www.".$domain."/".$url;
						
						// Save new internal URL addresses.
						if(s($url, "https://www.".$domain) || s($url, "http://www.".$domain) || s($url, "https://".$domain) || s($url, "http://".$domain)) {

							$url = explode("?", $url); $url = $url[0];
							$url = explode("#", $url); $url = $url[0];

							switch(getHttpStatusCode($url)) {
								case 200: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
								case 201: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
								case 204: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
								
								case 301: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
								case 302: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
								case 304: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
								
								case 401: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
								case 403: if(in_array($url, $internal_urls) == false) $internal_urls[sizeof($internal_urls)] = $url; break;
							}
						}
						
						// Save subdomains and external URL addresses.
						else {
							
							$temp = $url;
							$temp = str_replace("https://", "", $temp);
							$temp = str_replace("http://", "", $temp);
							$temp = str_replace("www.", "", $temp);
							
							$temp = explode("?", $temp); $temp = $temp[0];
							$temp = explode("#", $temp); $temp = $temp[0];
							$temp = explode("/", $temp); $temp = $temp[0];
							
							$temp = explode(".", $temp);
							$domain_array = explode(".", $domain);
							
							if($temp[sizeof($temp)-1] == $domain_array[1] && $temp[sizeof($temp)-2] == $domain_array[0])
							{

								$temp_final = ""; $fixer = false;
								foreach($temp as $part) {
									if(!$fixer) {
										$temp_final = $part;
										$fixer = true;
									}
									else
										$temp_final = $temp_final . "." . $part;
								}
								$temp_final = "http://" . $temp_final;
								
								// Save cleaned subdomain URL addresses.
								if(in_array($temp_final, $subdomain_urls) == false)
									$subdomain_urls[sizeof($subdomain_urls)] = $temp_final;
							}
							else {

								// Save all external URL addresses.
								if(in_array($url, $external_urls) == false)
									$external_urls[sizeof($external_urls)] = $url;
								
								// Save cleaned base domains separated.
								if(in_array(cleanDomain($url), $external_urls2) == false)
									$external_urls2[sizeof($external_urls2)] = cleanDomain($url);
							
							}
							
						}
						
					}
					
				}
			}
			
		}
	}
}

?>