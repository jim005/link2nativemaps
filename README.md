# link2nativemaps
Script PHP to redirect to native map apps.

In our website, email, sms... we could forward users to url like this 
    http://maps.appsenso.eu/?q=44.533744,6.471383
so on mobile devices they are redirected to their native maps apps. Otherwise, they're redirecting to Google Maps.

# Live demo & webservice
This script is used here http://maps.appsenso.eu
Feel free to use it. Exemples :
 * http://maps.appsenso.eu/?q=44.533744,6.471383
 * http://maps.appsenso.eu/?q=place+saint+marcellin,+05000+Gap,+France


# Install on your server
    curl -s https://raw.githubusercontent.com/jim005/link2nativemaps/master/index.php > index.php

# Credits & Thanks
 * https://github.com/Sjors/currentLocationStringForCurrentLanguage
 * https://www.habaneroconsulting.com/insights/opening-native-map-apps-from-the-mobile-browser
 * http://jsfiddle.net/johnallan/YkMA2/
 * http://www.metamodpro.com/browser-language-codes
