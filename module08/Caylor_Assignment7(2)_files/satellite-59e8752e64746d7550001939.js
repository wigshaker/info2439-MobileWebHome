_satellite.pushAsyncScript(function(event, target, $variables){
  _satellite._clearCookies("cpn");
_satellite._clearCookies("ppn");

//To delete Stock Internal search
if(!_satellite.getVar("isSite_AdobeStock")){
  _satellite._clearCookies("s_stov");
  _satellite._clearCookies("s_a_campaign_stock");
}
});
