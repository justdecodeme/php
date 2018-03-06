$('textarea').keyup(function(e) {
  if(e.which == 13) {
    $('form').submit();
  }
});

$('form').submit(function() {
  var message = $('textarea').val();
  $.post('messages.php?action=sendMessage&message='+message, function(data, status) {
    if(status == 'success') {
      document.getElementById('chatForm').reset();
    }
  });
  return false;
});
