$('textarea').keyup(function(e) {
  if(e.which == 13) {
    $('form').submit();
  }
});

function loadChat() {
  $.post('messages.php?action=getMessage', function(data, status) {
    $('#chat').html(data);
    $('#chat').scrollTop($('#chat').prop('scrollHeight'));
  });
}
loadChat();
setInterval(function() {
  console.log('interval');
  loadChat();
}, 1000);

$('form').submit(function() {
  var message = $('textarea').val();
  $.post('messages.php?action=sendMessage&message='+message, function(data, status) {
    if(status == 'success') {
      document.getElementById('chatForm').reset();
      loadChat();
    }
  });
  return false;
});
