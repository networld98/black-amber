(function (d, s, id, sid) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {
    return;
  }
  js = d.createElement(s);
  js.id = id;
  js.onload = function () {
    Listfully.init(sid);
  };
  js.src = "https://listfully.no/static/scripts/partner.js";
  fjs.parentNode.insertBefore(js, fjs);
})(document, "script", "listfully", "6643195207");
