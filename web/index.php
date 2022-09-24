<?php
/**
 * by: jim005 (websenso.com)
 * ver: 0.2
 * date: 08/2019
 *
 *
 * Implementation like :
 * https://maps.appsenso.eu/?q=44.54535,6.27617
 * https://maps.appsenso.eu/?q=WebSenso&ll=44.54535,6.27617
 *
 */


/***
 * Security check
 */
if (!isset($_GET['q']) || empty($_GET['q'])) {
  header('Location: /error-routing.php',TRUE, 303);
  exit;
}

/**
 * Return Lat and Lon from a string ( formatted like 44.54535,6.27617 )
 *
 * @param $string
 * @return array|bool
 */
function getLatLong($string) {
  $string = str_replace("%2C", ",", $string);
  $re     = '/(^\-?\d+\.*\d*\,\-?\d+\.*\d*)/m'; // Check if lat/long value, like :  44.545452,6.276119
  preg_match_all($re, $string, $matches, PREG_SET_ORDER, 0);
  if ($matches) {
    $latlon_array = explode(",", $matches[0][0]);
    $lat          = (float) $latlon_array[0];
    $lon          = (float) $latlon_array[1];
    return array($lat, $lon);
  }
  return FALSE;
}


// Query string
$q = urlencode($_GET['q']);

// The location around which the map should be centered. A comma-separated pair of floating point values that represent latitude and longitude (in that order).
$ll = isset($_GET['ll']) ? urlencode($_GET['ll']) : NULL;


// Redirect
$UserAgent = $_SERVER['HTTP_USER_AGENT'];
if (strpos($UserAgent, "Android")) {
  $url = "https://www.google.com/maps/search/?api=1&query=$q";
  $url .= ($ll) ? "+$ll" : NULL;
}
elseif (strpos($UserAgent, "AppleWebKit")) {
  $url = "https://maps.apple.com/?q=$q";
  $url .= ($ll) ? "&ll=$ll" : NULL;
}
else {
  $url = "https://www.openstreetmap.org/";

  if ($ll) {
    $latlong_array = getLatLong($ll);
    if ($latlong_array) {
      $url .= "?mlat=$latlong_array[0]&mlon=$latlong_array[1]#map=17/$latlong_array[0]/$latlong_array[1]";
    }
  }
  else {
    $latlong_array = getLatLong($q);
    if ($latlong_array) {
      $url .= "?mlat=$latlong_array[0]&mlon=$latlong_array[1]#map=17/$latlong_array[0]/$latlong_array[1]";
    }
  }
}

header('Location: ' . $url, TRUE, 307);

