<?php

$q = trim($_GET['q']);

$protocol = isset($_SERVER['HTTPS']) && 
$_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$base_url = $protocol . $_SERVER['HTTP_HOST'] . '/';

$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$title = ($lang === "fr") ? "📍C'est par ici !" : "📍It's over here!";
$description = ($lang === "fr") ? "Ouvrez votre lieu dans les applications cartographiques natives des smartphones, ce qui améliore l'expérience de l'utilisateur et simplifie la navigation." : "Open web-based content to native map apps on smartphones, enhancing user experience and simplifying navigation.";

?><!DOCTYPE html>
<html>
<head>
	<meta name="robots" content="noindex">
	<meta http-equiv="cache-control" content="no-cache">
	<meta http-equiv="expires" content="0">
	<meta http-equiv="pragma" content="no-cache">
	<meta charset="utf-8"/>
    	<meta name="viewport" content="width=device-width,initial-scale=1"/>
	<meta http-equiv = "refresh" content = "5; url = https://maps.apple.com/?q=<?= $q ?>" />
	<title><?= $title; ?> - OpenYourMap.link</title>
    	<meta name="description" content="Effortlessly connects your web-based content to native map apps on smartphones, enhancing user experience and simplifying navigation.">
    	<meta property="og:title" content="<?= $title; ?>"> 
    	<meta property="og:site_name" content="OpenYourMap.link">
    	<meta property="og:video" content="<?= $base_url; ?>preview-video.mp4" />
	<meta property="og:video:secure_url" content="<?= $base_url; ?>preview-video.mp4" />
	<meta property="og:video:type" content="video.other" />
	<meta property="og:video:width" content="1920" />
	<meta property="og:video:height" content="1080" />
</head>
<body>

<script>
    function findGetParameter(parameterName) {
        var result = null,
            tmp = [];
        var items = location.search.substr(1).split("&");
        for (var index = 0; index < items.length; index++) {
            tmp = items[index].split("=");
            if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
        }
        return result;
    }

    function getLatLong(string) {
        const latLongRegex = /(^\-?\d+\.*\d*\,\-?\d+\.*\d*)/m;
        const matches = string.match(latLongRegex);
        if (matches) {
            const latLongArray = matches[0].split(",");
            const lat = parseFloat(latLongArray[0]);
            const lon = parseFloat(latLongArray[1]);
            return [lat, lon];
        }
    
        return false;
    }

    var os = navigator.platform;
    var redirectUrl;
    var q = findGetParameter("q");
    var ll = findGetParameter("ll");
    var url;

    if (!q || q === "") {
        window.location.href = "https://www.qwant.com";
    }

    if (os.indexOf("iPhone") != -1 || os.indexOf("iPad") != -1 || os.indexOf("Mac") != -1) {
        redirectUrl = `https://maps.apple.com/?q=${q}`;
        redirectUrl += ll ? `&ll=${ll}` : "";
    } else if (os.indexOf("Android") != -1 || os.indexOf("Linux") != -1) {
        redirectUrl = `https://www.google.com/maps/search/?api=1&query=${q}`;
        redirectUrl += ll ? `&center=${ll}` : "";
    } else {
        redirectUrl = "https://map.qwant.com/place/latlon:";
        if (ll) {
            latLongArray = getLatLong(ll);
        } else {
            latLongArray = getLatLong(q);
        }
        if (latLongArray) {
            redirectUrl += `${latLongArray[0].toFixed(5)}:${latLongArray[1].toFixed(5)}`;
        }
    }

    window.location.href = redirectUrl;
    //document.write(redirectUrl);

    setTimeout(window.close, 3000);  // Fix for Apple Map on native app

</script>

<a href="https://maps.apple.com/?q=<?= $q ?>">Redirection...</a>

</body>
</html>
