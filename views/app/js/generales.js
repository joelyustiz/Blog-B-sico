function __(id) {
  return document.getElementById(id);
}
function ready_(){
 __("boton_login").addEventListener("click",goLogin,false);
}
window.addEventListener("load",ready_);
