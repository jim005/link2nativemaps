<?php
/**
 * by: jim005 (websenso.com)
 * ver: 0.2
 * date: Aout 2019
 *
 * 
 * Implementation like : 
 * https://maps.appsenso.eu/?q=44.533744,6.471383
 * 
*/


// Get data
if (!isset($_GET['q']) || empty($_GET['q']) ) {
    	header('Location: /error-routing.php');
    	exit;
} else {

	$q = $_GET['q'];

	// Find Lat and Lon, for OpenStreetMap URL.
	$re = '/(^\-?\d+\.*\d*\,\-?\d+\.*\d*)/m'; // Check if lat/long value, like :  44.545452,6.276119
	preg_match_all($re, $q, $matches, PREG_SET_ORDER, 0);
	$lat = null;
	$lon = null;
	if ($matches)  {
       	$latlon_array = explode(",", $matches[0][0]);
		$lat = (float) $latlon_array[0];
		$lon = (float) $latlon_array[1];
	}

	// query string
    $q = urlencode($q);

	// The location around which the map should be centered. A comma-separated pair of floating point values that represent latitude and longitude (in that order).
	$ll = isset($_GET['ll']) ? urlencode($_GET['ll']) : null;

}


// Redirect
$UserAgent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($UserAgent,"Windows Phone")){
	$url = "maps:" . $q;
}
elseif (strpos($UserAgent,"Android")) {
	$url = "https://www.google.com/maps/search/?api=1&query=$q";
	$url .= ($ll) ? "+$ll" : null;
}
elseif (strpos($UserAgent,"AppleWebKit")) {
	$url = "https://maps.apple.com/?q=$q";
	$url .= ($ll) ? "&ll=$ll" : null;
}
else {
	$url = ($lat && $lon) ? "https://www.openstreetmap.org/?mlat=$lat&mlon=$lon#map=17/$lat/$lon" : "https://www.openstreetmap.org/";
}

header('Location: ' . $url, TRUE, 307);

