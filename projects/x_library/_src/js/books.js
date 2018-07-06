var categoryParent, categoryCode, categoryName, categoryCodeValue, categoryNameValue;
var booksListContainer = document.getElementById('booksListContainer');
var addBtn = document.getElementById('addBtn');

// Edit -> Delete -> Cancel -> Submit functions
function individualOperations(e) {
  e.stopPropagation();

  // delete -> only if not editing any other
  if(e.target.id == 'deleteBtn' && !isEditing) {
    var deleteId = e.target.dataset.id;
    console.log('deleting: ' + deleteId);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       booksListContainer.innerHTML = this.responseText;
     } else {
       // console.log(this.readyState, this.status);
     }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
        //Logic to delete the item
        xhttp.open("POST", "books_handler.php", true);  // open(method, url, async)
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action=delete&deleteId="+deleteId);
    } else {
      console.log('Deletion is stopped!');
    }
  }
  // edit class -> only if not editing any class
  else if(e.target.id == 'editBtn' && !isEditing) {
    isEditing = true;
    var editId = e.target.dataset.id;
    console.log('editing: ' + editId);

    categoryParent = e.target.parentNode.parentNode;
    categoryCode = categoryParent.querySelector('.category-code');
    categoryName = categoryParent.querySelector('.category-name');
    categoryCodeValue = categoryCode.innerHTML;
    categoryNameValue = categoryName.innerHTML;

    categoryParent.classList.add('editing-outer');
    categoryCode.innerHTML = '<input type="text" class="form-control" id="newCode" value="'+categoryCodeValue+'">';
    categoryName.innerHTML = '<input type="text" class="form-control" id="newName" value="'+categoryNameValue+'">';
  }
  // cancel class -> if editing any class
  else if(e.target.id == 'cancelBtn' && isEditing) {
    isEditing = false;
    var cancelId = e.target.dataset.id;
    console.log('cancelling: ' + cancelId);

    categoryParent.classList.remove('editing-outer');
    categoryCode.innerHTML = categoryCodeValue;
    categoryName.innerHTML = categoryNameValue;
  }
  // submit class -> if editing any class
  else if(e.target.id == 'submitBtn' && isEditing) {
    isEditing = false;
    var submitId = e.target.dataset.id;
    console.log('submitting: ' + submitId);

    var newCode = document.getElementById('newCode').value;
    var newName = document.getElementById('newName').value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        booksListContainer.innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "books_handler.php", true);  // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=submit&newCode="+newCode+"&newName="+newName+"&submitId="+submitId);
  }
}

// fetch the books list
function fetchBooks() {
  console.log('fetching books list...');
  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     booksListContainer.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp.open("GET", "books_handler.php?action=fetchBooks", true);  // open(method, url, async)
  xhttp.send();
}

// Add Category on add btn click
function addCategory() {
  if(!isEditing) {
    console.log('adding category..');

    var addCode = document.getElementById('addCode').value;
    var addName = document.getElementById('addName').value;
    document.getElementById('addCode').value = '';
    document.getElementById('addName').value = '';

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        booksListContainer.innerHTML = this.responseText;
      } else {
        // console.log(this.readyState, this.status);
      }
    };
    xhttp.open("POST", "books_handler.php", true);  // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=add"+
      "&addCode="+addCode+
      "&addName="+addName
    );
  }
}

// run on page laod
function init() {
  fetchBooks();
};
init();

booksListContainer.addEventListener('click', individualOperations, false);
addBtn.addEventListener('click', addCategory, false);
