$('textarea').keyup(function(e) {
  if(e.which == 13) {
    console.log('enter clicked');
    $('form').submit();
  }
});
$('form').submit(function() {
  console.log('submited');
  return false;
});
