<?php

function fuzzer_keywords($list_size = "min", $base_domain, $extensions, $statusCodes) {
	
	$founds = array();
	
	// Select wordlist
	if($list_size == "min") 	 $wordlist = getWordsFromFile("assets/words_fuzzer_min", "array");
	else if($list_size == "max") $wordlist = getWordsFromFile("assets/words_fuzzer_max", "array");
	else if($list_size == "list") $wordlist = getWordsFromFile("assets/list1-3", "array");
	
	foreach($extensions as $ext) {
		foreach($wordlist as $word) {
			$statusCodeForTheWord = getHttpStatusCode($base_domain."/".$word.$ext);

			foreach($statusCodes as $code) {
				if($statusCodeForTheWord == $code)
					$founds[sizeof($founds)] = $code."		<a href='http://".$base_domain."/".$word.$ext."'>".$base_domain."/".$word.$ext."</a>";
			}
		}
	}
	
	return $founds;
}
function fuzzer_random($base_domain, $max_level = 3, $type = "folder") {
	$chars = "q,w,e,r,t,z,u,i,o,p,a,s,d,f,g,h,j,k,l,y,x,c,v,b,n,m,0,1,2,3,4,5,6,7,8,9,-,_";
	$chars = explode(",", $chars);
	$founds = array();
	
	if(strlen($base_domain) < 4) return array();
	if(substr_count($base_domain, '.') < 1) return array();
	
	if($type == "folder" || $type == "dir") $ext = "";
	else if(substr_count($type, '.') > 0) $ext = $type;
	else $ext = "." . $type;
	
	if($max_level >= 1)
		for($x = 1; $x <= sizeof($chars)-1; $x++) {
			$domain = $base_domain."/".$chars[$x].$ext;
			switch(getHttpStatusCode($domain)) {
				case 200:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
				case 201:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
				case 204:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
				case 301:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
				case 302:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
				case 304:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
				case 401:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
				case 403:
					if(!in_array($domain, $founds))
						$founds[sizeof($founds)] = $domain;
				break;
			}
		}
	if($max_level >= 2)
		for($x = 1; $x <= sizeof($chars)-1; $x++) {
			for($y = 1; $y <= sizeof($chars)-1; $y++) {
				$domain = $base_domain."/".$chars[$x].$chars[$y].$ext;
				switch(getHttpStatusCode($domain)) {
					case 200:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
					case 201:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
					case 204:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
					case 301:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
					case 302:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
					case 304:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
					case 401:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
					case 403:
						if(!in_array($domain, $founds))
							$founds[sizeof($founds)] = $domain;
					break;
				}
			}
		}
	if($max_level >= 3)
		for($x = 1; $x <= sizeof($chars)-1; $x++) {
			for($y = 1; $y <= sizeof($chars)-1; $y++) {
				for($z = 1; $z <= sizeof($chars)-1; $z++) {
					$domain = $base_domain."/".$chars[$x].$chars[$y].$chars[$z].$ext;
					switch(getHttpStatusCode($domain)) {
						case 200:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
						case 201:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
						case 204:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
						case 301:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
						case 302:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
						case 304:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
						case 401:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
						case 403:
							if(!in_array($domain, $founds))
								$founds[sizeof($founds)] = $domain;
						break;
					}
				}
			}
		}
	if($max_level >= 4)
		for($x = 1; $x <= sizeof($chars)-1; $x++) {
			for($y = 1; $y <= sizeof($chars)-1; $y++) {
				for($z = 1; $z <= sizeof($chars)-1; $z++) {
					for($w = 1; $w <= sizeof($chars)-1; $w++) {
						$domain = $base_domain."/".$chars[$x].$chars[$y].$chars[$z].$chars[$w].$ext;
						switch(getHttpStatusCode($domain)) {
							case 200:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
							case 201:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
							case 204:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
							case 301:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
							case 302:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
							case 304:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
							case 401:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
							case 403:
								if(!in_array($domain, $founds))
									$founds[sizeof($founds)] = $domain;
							break;
						}
					}
				}
			}
		}
		
	return $founds;
}

?>