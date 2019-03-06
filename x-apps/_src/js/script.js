var xhttp = null;
const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

function keyUpFunc(e, cancelBtn, submitBtn) {
    if (e.keyCode === 13) {
      submitBtn.click();
    } else if (e.keyCode === 27) {
      cancelBtn.click();
    }
    // cancelBtn.removeEventListener('click', keyUpFunc);
    // submitBtn.removeEventListener('click', keyUpFunc);
}

// one modal for different status (add, delete, error, update, edit)
function showStatusModal(text, type) {
  statusModalAlert.innerHTML = text;
  statusModalAlert.setAttribute('class', type);
  statusModalBtn.click();
}

// order common table columns by clicked column heading
function orderList(e) {
  var prevOrderBy = orderBy;
  // remove active class from all columns
  for (var i = 0; i < orderListBy.length; i++) {
    orderListBy[i].classList.remove('active-ASC');
    orderListBy[i].classList.remove('active-DESC');
  }

  orderBy = e.target.dataset.orderBy;

  // toggle ASC | DESC if column clicked is same as previous click
  if (prevOrderBy == orderBy) {
    if (ascOrDesc == 'DESC') {
      ascOrDesc = 'ASC';
    } else {
      ascOrDesc = 'DESC';
    }
    // make ASC if column clicked is different from previous click
  } else {
    ascOrDesc = 'ASC';
  }

  // add active class to clicked column
  e.target.classList.add('active-' + ascOrDesc);

  console.log('ordering by...' + orderBy, ascOrDesc);

  updateList();
}

function getTodaysDate() {
  var date = new Date();
  var y = date.getFullYear();
  var m = date.getMonth()+1;
  var d = date.getDate();
  m = m < 10 ? '0' + m : m;
  d = d < 10 ? '0' + d : d;
  return y + '-' + m + '-' + d;
}
function getDateAfterDays(numberOfDaysToAdd) {
  var date = new Date();
  date.setDate(date.getDate() + numberOfDaysToAdd);

  var y = date.getFullYear();
  var m = date.getMonth() + 1;
  var d = date.getDate() ;
  m = m < 10 ? '0' + m : m;
  d = d < 10 ? '0' + d : d;
  return y + '-' + m + '-' + d;
}