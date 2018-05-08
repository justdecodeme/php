console.log('Hi, from common Script file!');
var loadingBtn = document.getElementById('loadingBtn');

function loadingFinished() {
  console.log('in');
  loadingBtn.style.display = 'none';
}
function loadingInProgress() {
  loadingBtn.style.display = '';
}
