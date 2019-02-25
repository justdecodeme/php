// find current date
function currentDate() {
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1; //January is 0!
  var yyyy = today.getFullYear();

  dd = (dd < 10 ? "0" : "") + dd;
  mm = (mm < 10 ? "0" : "") + mm;
  var today = yyyy + '-' + mm + '-' + dd;

  return today;
}
