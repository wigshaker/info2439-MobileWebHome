_satellite.pushAsyncScript(function(event, target, $variables){
  if ((typeof(_satellite.readCookie('Fb-Syc')) === 'undefined' || _satellite.readCookie('Fb-Syc') === '')) {
    document.cookie = "Fb-Syc=1;expires=;path=/;domain=.adobe.com;";
    FB_SyncPixel = new Image();
    FB_SyncPixel.src = '//sync-tm.everesttech.net/upi/pid/r7ifn0SL?redir=https%3A%2F%2Fwww.facebook.com%2Ffr%2Fb.php%3Fp%3D1531105787105294%26e%3D%24%7BTM_USER_ID%7D%26t%3D2592000%26o%3D0';
    FB_SyncPixel.width = "1";
    FB_SyncPixel.height = "1";
    FB_SyncPixel.style.display = 'none';
}

});
