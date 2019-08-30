<?php
/**
 * by: jim005 (websenso.com)
 * ver: 0.2
 * date: Aout 2019
 *
 * 
 * Implementation looks like : 
 * http://maps.appsenso.eu/?q=44.533744,6.471383
 * 
*/


// Get data
if (!isset($_GET['q'])) {
    	header('Location: https://www.openstreetmap.org');
    	exit;
} else {
    	$destination = urlencode($_GET['q']);
	$latlon_array = explode("%2C", $destination);
	$lat = (float) $latlon_array[0];
	$lon = (float) $latlon_array[1]; 
}

// Redirect
$UserAgent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($UserAgent,"Windows Phone")){
   	 $url = "maps:" . $destination;
}
elseif (strpos($UserAgent,"Android")) {
    	$url = "geo:" . $destination;
}
elseif (strpos($UserAgent,"Windows Phone")){
    	$url = "maps:" . $destination;
}
elseif (strpos($UserAgent,"AppleWebKit")) {
	$url = "https://maps.apple.com/?q=$lat,$lon&sll=$lat,$lon";
}
else {
	$url = "https://www.openstreetmap.org/?mlat=$lat&mlon=$lon#map=17/$lat/$lon"; 
}

header('Location: ' . $url);


