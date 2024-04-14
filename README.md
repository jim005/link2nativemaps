Little JS script to redirect user to native map apps.

If the user's device is: 
 * iOS or Mac OS => redirect to Apple Maps (apps),
 * Android  => redirect to Google Maps (apps)
 * other => redirect to Qwant Maps (OpenStreetMap data) (web).

## Demo : 
 * https://www.openyourmap.link/?q=44.55451,6.25705 with q=LATITUDE,LONGITUDE.
 * https://www.openyourmap.link/?q=WebSenso&ll=44.55451,6.25705 with q=QUERY STRING and ll=LATITUDE,LONGITUDE.

## Our instance live
This script is hosted here www.openyourmap.link (offered by web agency www.WebSenso.com). Feel free to use it.

## Install on your own server
    git clone https://github.com/jim005/link2nativemaps.git
Your DocumentRoot should target folder : /web

