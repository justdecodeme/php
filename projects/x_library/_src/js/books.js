var bookParent, bookTitle, bookStock, bookStock, bookTitleValue, bookAuthorValue, bookStockValue;
var booksListContainer = document.getElementById('booksListContainer');
var selectCategory = document.getElementById('selectCategory');
var addBtn = document.getElementById('addBtn');

// Edit -> Delete -> Cancel -> Submit functions
function individualOperations(e) {
  e.stopPropagation();

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
    var editId = bookParent.dataset.id;
    console.log('editing: ' + editId);

    bookTitle = bookParent.querySelector('.book-title');
    bookAuthor = bookParent.querySelector('.book-author');
    bookStock = bookParent.querySelector('.book-stock');
    bookTitleValue = bookTitle.innerHTML;
    bookAuthorValue = bookAuthor.innerHTML;
    bookStockValue = bookStock.innerHTML;

    bookParent.classList.add('editing-outer');
    bookTitle.innerHTML = '<input type="text" class="form-control" id="newTitle" value="'+bookTitleValue+'">';
    bookAuthor.innerHTML = '<input type="text" class="form-control" id="newAuthor" value="'+bookAuthorValue+'">';
    bookStock.innerHTML = '<input type="number" class="form-control" id="newStock" value="'+bookStockValue+'" min="0" max="100">';
  }
  // cancel -> if editing
  else if(e.target.id == 'cancelBtn' && isEditing) {
    isEditing = false;
    bookParent = e.target.parentNode.parentNode;
    var cancelId = bookParent.dataset.id;
    console.log('cancelling: ' + cancelId);

    bookParent.classList.remove('editing-outer');
    bookTitle.innerHTML = bookTitleValue;
    bookAuthor.innerHTML = bookAuthorValue;
    bookStock.innerHTML = bookStockValue;
  }
  // update -> if editing
  else if(e.target.id == 'updateBtn' && isEditing) {
    isEditing = false;
    bookParent = e.target.parentNode.parentNode;
    var updateId = bookParent.dataset.id;
    console.log('updating: ' + updateId);

    var newTitle = document.getElementById('newTitle').value;
    var newAuthor = document.getElementById('newAuthor').value;
    var newStock = document.getElementById('newStock').value;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        booksListContainer.innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "books_handler.php", true);  // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=update&newTitle="+newTitle+
      "&newAuthor="+newAuthor+
      "&newStock="+newStock+
      "&updateId="+updateId
    );
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

// fetch the categories list
function fetchCategoriesForBooks() {
  console.log('fetching categories list...');
  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     selectCategory.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp.open("GET", "books_handler.php?action=fetchCategoriesForBooks", true);  // open(method, url, async)
  xhttp.send();
}

// Add Category on add btn click
function addBook() {
  if(!isEditing) {
    console.log('adding book..');

    var addTitle = document.getElementById('addTitle').value;
    var addAuthor = document.getElementById('addAuthor').value;
    var addStock = document.getElementById('addStock').value;
    document.getElementById('addTitle').value = '';
    document.getElementById('addAuthor').value = '';
    document.getElementById('addStock').value = 1;

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
    xhttp.send("action=add&addTitle="+addTitle+
      "&addAuthor="+addAuthor+
      "&addStock="+addStock
    );
  }
}

// run on page laod
function init() {
  // fetchCategoriesForBooks();
  fetchBooks();
};
init();

booksListContainer.addEventListener('click', individualOperations, false);
addBtn.addEventListener('click', addBook, false);
