/****************Variables****************/
var submitForm = document.getElementById('submitForm');
var message = document.getElementById('message');


/****************Events****************/
submitForm.addEventListener('submit', function (e) {
  e.preventDefault();
  console.log('registering user...');

  var username = document.getElementById('username').value;
  var email = document.getElementById('email').value;
  var password = document.getElementById('password').value;
  var confirmPassword = document.getElementById('confirmPassword').value;

  // load content from database
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == 1) {
        // console.log('if');
        location.href = "login.php";
      } else {
        // console.log('else');
        message.innerHTML = this.responseText;
      }
    } else {
      console.log(this.readyState, this.status);
    }
  };
  xhttp.open("POST", "signup-handler.php", true); // open(method, url, async)
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("action=submitSignup" +
    "&username=" + username +
    "&email=" + email +
    "&password=" + password +
    "&confirmPassword=" + confirmPassword, true);
}, false);
