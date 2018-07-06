var categoryParent, categoryCode, categoryName, categoryCodeValue, categoryNameValue;
var booksListContainer = document.getElementById('booksListContainer');
var addBtn = document.getElementById('addBtn');

// Edit -> Delete -> Cancel -> Submit functions
function individualOperations(e) {
  e.stopPropagation();
  console.log(e.target.id);

  // delete -> only if not editing
  if(e.target.id == 'deleteBtn' && !isEditing) {
    bookParent = e.target.parentNode.parentNode;
    var deleteId = bookParent.dataset.id;
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
        // logic to delete the item
        xhttp.open("POST", "books_handler.php", true);  // open(method, url, async)
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("action=delete&deleteId="+deleteId);
    } else {
      console.log('Deletion is stopped!');
    }
  }
  // edit -> only if not editing
  else if(e.target.id == 'editBtn' && !isEditing) {
    isEditing = true;
    bookParent = e.target.parentNode.parentNode;
    console.log('cliked');
    var editId = bookParent.dataset.id;
    console.log('editing: ' + editId);

    bookTitle = bookParent.querySelector('.book-title');
    bookAuthor = bookParent.querySelector('.book-author');
    bookStock = bookParent.querySelector('.book-stock');
    bookTitleValue = bookTitle.innerHTML;
    bookAuthorValue = bookAuthor.innerHTML;
    bookStockValue = parseInt(bookStock.innerHTML);
    bookParent.classList.add('editing-outer');
    bookTitle.innerHTML = '<input type="text" class="form-control" id="newTitle" value="'+bookTitleValue+'">';
    bookAuthor.innerHTML = '<input type="text" class="form-control" id="newAuthor" value="'+bookAuthorValue+'">';
    bookStock.innerHTML = '<input type="number" class="form-control" id="newStock" value="'+bookStockValue+' min='0' max='100'">';
  }
  // cancel -> if editing
  else if(e.target.id == 'cancelBtn' && isEditing) {
    isEditing = false;
    var cancelId = e.target.dataset.id;
    console.log('cancelling: ' + cancelId);

    categoryParent.classList.remove('editing-outer');
    categoryCode.innerHTML = categoryCodeValue;
    categoryName.innerHTML = categoryNameValue;
  }
  // update -> if editing
  else if(e.target.id == 'updateBtn' && isEditing) {
    isEditing = false;
    var updateId = e.target.dataset.id;
    console.log('updating: ' + updateId);

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
    xhttp.send("action=update&newCode="+newCode+"&newName="+newName+"&updateId="+updateId);
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
function addBook() {
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
addBtn.addEventListener('click', addBook, false);
