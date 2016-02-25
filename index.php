<?php
/**
 * by: jim007 (websenso.com)
 * ver: 0.1
 * date: Feb 2016
 *
 * 
 * Implementation looks like : 
 * http://maps.appsenso.eu/?q=44.533744,6.471383
 * 
*/


// Get data
if (!isset($_GET['q'])) {
    header('Location: https://www.websenso.com/');
    exit;
} else {
    $destination = urlencode($_GET['q']);
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
    $url = "maps:?saddr=" .  urlencode(GetCurrentLocationTranslated()) . "&daddr=" . $destination;
}
else {
    $url = "http://maps.google.com?q=" . $destination;
}

header('Location: ' . $url);



/**
 * Return label Current Location in the user's language. Useful for iOs
 * 
 */
function GetCurrentLocationTranslated ()  {
    
    $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    switch($browser_lang) {
        
        case "fr":
        case "fr-fr":
        case "fr-be":
        case "fr-ca":
        case "fr-lu":
            $CurrentLocationTranslated  = "Lieu actuel";
        break;

        case "it":
        case "it-ch":
            $CurrentLocationTranslated  = "Posizione attuale";
        break;
        
        case "nl":
        case "nl-be":
            $CurrentLocationTranslated  = "Huidige locatie";
        break;

        default:
            $CurrentLocationTranslated  = "Current Location";
        break;
    }
    
    return $CurrentLocationTranslated;
} 