var bookParent, bookTitle, bookStock, bookStock, bookCategory, bookTitleValue, bookAuthorValue, bookStockValue, bookCategoryValue;
var usersListContainer = document.getElementById('usersListContainer');
var selectCategory = document.getElementById('selectCategory');
var addBtn = document.getElementById('addBtn');

// Edit -> Delete -> Cancel -> Submit functions
function individualOperations(e) {
  e.stopPropagation();

  // delete -> only if not editing
  if(e.target.id == 'deleteBtn' && !isEditing) {
    bookParent = e.target.parentNode.parentNode;
    var deleteId = bookParent.dataset.bookId;
    console.log('deleting: ' + deleteId);

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
       usersListContainer.innerHTML = this.responseText;
     } else {
       // console.log(this.readyState, this.status);
     }
    };

    var deleteConfirmation = confirm("Want to delete?");
    if (deleteConfirmation) {
        // logic to delete the item
        xhttp.open("POST", "users_handler.php", true);  // open(method, url, async)
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
    var bookId = bookParent.dataset.bookId;
    var categoryId = bookParent.dataset.categoryId;
    console.log('editing: ' + bookId);

    bookTitle = bookParent.querySelector('.book-title');
    bookAuthor = bookParent.querySelector('.book-author');
    bookStock = bookParent.querySelector('.book-stock');
    bookCategory = bookParent.querySelector('.book-category');
    bookTitleValue = bookTitle.innerHTML;
    bookAuthorValue = bookAuthor.innerHTML;
    bookStockValue = bookStock.innerHTML;
    bookCategoryValue = bookCategory.innerHTML;

    // change elements for editing
    bookParent.classList.add('editing-outer');
    bookTitle.innerHTML = '<input type="text" class="form-control" value="'+bookTitleValue+'">';
    bookAuthor.innerHTML = '<input type="text" class="form-control" value="'+bookAuthorValue+'">';
    bookStock.innerHTML = '<input type="number" class="form-control" value="'+bookStockValue+'" min="0" max="100">';
    // copy and insert category list
    bookCategory.innerHTML = '';
    var clone = selectCategory.cloneNode(true);
    bookCategory.appendChild(clone);
    // update category as as original
    bookCategory.querySelector('select').value = categoryId;
  }
  // cancel -> if editing
  else if(e.target.id == 'cancelBtn' && isEditing) {
    isEditing = false;
    bookParent = e.target.parentNode.parentNode;
    var bookId = bookParent.dataset.bookId;
    console.log('cancelling: ' + bookId);

    bookParent.classList.remove('editing-outer');
    bookTitle.innerHTML = bookTitleValue;
    bookAuthor.innerHTML = bookAuthorValue;
    bookStock.innerHTML = bookStockValue;
    bookStock.innerHTML = bookStockValue;
    bookCategory.innerHTML = bookCategoryValue;
  }
  // update -> if editing
  else if(e.target.id == 'updateBtn' && isEditing) {
    isEditing = false;
    bookParent = e.target.parentNode.parentNode;
    var bookId = bookParent.dataset.bookId;
    console.log('updating: ' + bookId);

    var newTitle = bookTitle.querySelector('input').value;;
    var newAuthor = bookAuthor.querySelector('input').value;
    var newStock = bookStock.querySelector('input').value;
    var newCategory = bookCategory.querySelector('select').value;;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        usersListContainer.innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "users_handler.php", true);  // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=update&newTitle="+newTitle+
      "&newAuthor="+newAuthor+
      "&newStock="+newStock+
      "&newCategory="+newCategory+
      "&bookId="+bookId
    );
  }
}

// fetch the users list
function fetchUsers() {
  console.log('fetching users list...');
  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     usersListContainer.innerHTML = this.responseText;
   } else {
     // console.log(this.readyState, this.status);
   }
  };
  xhttp.open("GET", "users_handler.php?action=fetchUsers", true);  // open(method, url, async)
  xhttp.send();
}

// Add Category on add btn click
function addBook() {
  if(!isEditing) {
    console.log('adding book..');

    var addTitle = document.getElementById('addTitle').value;
    var addAuthor = document.getElementById('addAuthor').value;
    var addStock = document.getElementById('addStock').value;
    var addCategory = selectCategory.value;
    document.getElementById('addTitle').value = '';
    document.getElementById('addAuthor').value = '';
    document.getElementById('addStock').value = 1;
    // document.getElementById('selectCategory').value = 1;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        usersListContainer.innerHTML = this.responseText;
      } else {
        // console.log(this.readyState, this.status);
      }
    };
    xhttp.open("POST", "users_handler.php", true);  // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=add&addTitle="+addTitle+
      "&addAuthor="+addAuthor+
      "&addStock="+addStock+
      "&addCategory="+addCategory
    );
  }
}

// run on page laod
function init() {
  // fetchCategoriesForBooks();
  fetchUsers();
};
init();

usersListContainer.addEventListener('click', individualOperations, false);
addBtn.addEventListener('click', addBook, false);
