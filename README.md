Little PHP script to redirect user to native map apps.

If the user's device is: 
 * iOS or Mac OS => redirect to Apple Maps (apps),
 * Android  => redirect to Google Maps (apps)
 * other => redirect to OpenStreetMap.org (web).

Demo : 
 * https://maps.appsenso.eu/?q=44.54535,6.27617 with q=LATITUDE,LONGITUDE.
 * https://maps.appsenso.eu/?q=WebSenso&ll=444.54535,6.27617 with q=QUERY STRING and ll=LATITUDE,LONGITUDE.

## Our instance lives
This script is hosted here https://maps.appsenso.eu (offered by our web agency www.WebSenso.com).
Feel free to use it. Works with http:// and https://  

# Install on your own server
    git clone https://github.com/jim005/link2nativemaps.git . 

# Credits & Thanks
 * http://jsfiddle.net/johnallan/YkMA2/
