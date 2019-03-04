/****************Variables****************/
var submitLoginForm = document.getElementById('submitLoginForm');
var message = document.getElementById('message');


/****************Events****************/
submitLoginForm.addEventListener('submit', function (e) {
  e.preventDefault();
  console.log('loging user...');

  if (document.getElementById('sessonMessage')) {
    document.getElementById('sessonMessage').remove();
  }

  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;

  // load content from database
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == 1) {
        location.href = "/php/x-apps/";
      } else {
        message.innerHTML = this.responseText;
      }
    } else {
      console.log(this.readyState, this.status);
    }
  };
  xhttp.open("POST", "login-handler.php", true); // open(method, url, async)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=submitLogin" +
    "&email=" + email +
    "&password=" + password, true);
}, false);
