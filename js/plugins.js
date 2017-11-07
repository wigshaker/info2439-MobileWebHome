/*
  Clay Caylor
  plugins.js
  Info2439.8A
  Brown
  11/07/2017
*/

document.addEventListener("deviceready", onDeviceReady, false);

function onDeviceReady() {
  $(".vibrate").click(function() {
    navigator.vibrate(150);
  });
}
