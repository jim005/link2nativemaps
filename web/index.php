<?php
$q = trim($_GET['q']);

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
        redirectUrl += ll ? `&amp;ll=${ll}` : "";
    } else if (os.indexOf("Android") != -1 || os.indexOf("Linux") != -1) {
        redirectUrl = `https://www.google.com/maps/search/?api=1&query=${q}`;
        redirectUrl += ll ? `&amp;center=${ll}` : "";
    } else {
        redirectUrl = "https://www.qwant.com/maps/place/latlon:";
        if (ll) {
            latLongArray = getLatLong(ll);
        } else {
            latLongArray = getLatLong(q);
        }
        if (latLongArray) {
            redirectUrl += `${latLongArray[0]}:${latLongArray[1]}`;
        }
    }

     window.location.href = redirectUrl;
	// document.write(redirectUrl);

	setTimeout(window.close, 3000);  // Fix for Apple Map on native app

</script>
	<a href="https://maps.apple.com/?q=<?= $q ?>">Redirection...</a>
</body>
</html>>