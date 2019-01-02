var userParent, bookTitle, bookStock, bookStock, bookCategory, bookTitleValue, bookAuthorValue, bookStockValue, bookCategoryValue;
var usersListContainer = document.getElementById('usersListContainer');
var addBtn = document.getElementById('addBtn');

// Edit -> Delete -> Cancel -> Submit functions
function individualOperations(e) {
  e.stopPropagation();

  // delete -> only if not editing
  if(e.target.id == 'deleteBtn' && !isEditing) {
    userParent = e.target.parentNode.parentNode;
    var userId = userParent.dataset.userId;
    console.log('deleting: ' + userId);

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
        xhttp.send("action=delete&userId="+userId);
    } else {
      console.log('Deletion is stopped!');
    }
  }
  // edit -> only if not editing
  else if(e.target.id == 'editBtn' && !isEditing) {
    isEditing = true;
    userParent = e.target.parentNode.parentNode;
    var userId = userParent.dataset.userId;
    var userAccessId = userParent.dataset.userAccessType;
    console.log('editing: ' + userId);

    userUsername = userParent.querySelector('.user-username');
    userFullname = userParent.querySelector('.user-fullname');
    userEmail = userParent.querySelector('.user-email');
    userImage = userParent.querySelector('.user-image');
    userAccessType = userParent.querySelector('.user-access-type');
    userUsernameValue = userUsername.innerHTML;
    userFullnameValue = userFullname.innerHTML;
    userEmailValue = userEmail.innerHTML;
    userImageValue = userImage.innerHTML;
    userAccessTypeValue = userAccessType.innerHTML;

    // change elements for editing
    userParent.classList.add('editing-outer');
    userUsername.innerHTML = '<input type="text" class="form-control" value="'+userUsernameValue+'">';
    userFullname.innerHTML = '<input type="text" class="form-control" value="'+userFullnameValue+'">';
    userEmail.innerHTML = '<input type="email" class="form-control" value="'+userEmailValue+'">';
    userImage.innerHTML = '<input type="file" class="form-control" value="'+userImageValue+'">';
    userAccessType.innerHTML = `
      <select class="custom-select">
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
    `;

    // update user access type as as original
    userAccessType.querySelector('select').value = userAccessId;
  }
  // cancel -> if editing
  else if(e.target.id == 'cancelBtn' && isEditing) {
    isEditing = false;
    userParent = e.target.parentNode.parentNode;
    var userId = userParent.dataset.userId;
    console.log('cancelling: ' + userId);

    userParent.classList.remove('editing-outer');
    userUsername.innerHTML = userUsernameValue;
    userFullname.innerHTML = userFullnameValue;
    userEmail.innerHTML = userEmailValue;
    userImage.innerHTML = userImageValue;
    userAccessType.innerHTML = userAccessTypeValue;
  }
  // update -> if editing
  else if(e.target.id == 'updateBtn' && isEditing) {
    isEditing = false;
    userParent = e.target.parentNode.parentNode;
    var userId = userParent.dataset.userId;
    console.log('updating: ' + userId);

    var newUsername = userUsername.querySelector('input').value;;
    var newFullname = userFullname.querySelector('input').value;
    var newEmail = userEmail.querySelector('input').value;
    var newImage = userImage.querySelector('input').value;;
    var newAccessType = userAccessType.querySelector('select').value;;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        usersListContainer.innerHTML = this.responseText;
      }
    };
    xhttp.open("POST", "users_handler.php", true);  // open(method, url, async)
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=update"+
      "&newUsername="+newUsername+
      "&newFullname="+newFullname+
      "&newEmail="+newEmail+
      "&newImage="+newImage+
      "&newAccessType="+newAccessType+
      "&userId="+userId
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
function addUser() {
  if(!isEditing) {
    console.log('adding book..');

    var addUsername = document.getElementById('addUsername').value;
    var addFullName = document.getElementById('addFullName').value;
    var addEmail = document.getElementById('addEmail').value;
    var addImage = document.getElementById('addImage').value;
    var selectUserType = document.getElementById('selectUserType').value;
    document.getElementById('addUsername').value = '';
    document.getElementById('addFullName').value = '';
    document.getElementById('addEmail').value = '';
    document.getElementById('addImage').value = '';
    document.getElementById('selectUserType').value = 'user';

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
    xhttp.send("action=add"+
      "&addUsername="+addUsername+
      "&addFullName="+addFullName+
      "&addEmail="+addEmail+
      "&addImage="+addImage+
      "&selectUserType="+selectUserType
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
addBtn.addEventListener('click', addUser, false);
