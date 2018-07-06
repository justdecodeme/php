var xhttp = null;

// fetch the categories list to make drop down
function fetchCategories() {
  console.log('fetching categories list...');
  // load content from database
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     categoriesListContainer.innerHTML = this.responseText;
   } else {
     console.log(this.readyState, this.status);
   }
  };
  xhttp.open("GET", "categories_handler.php?action=fetchCategoriesList", true);  // open(method, url, async)
  xhttp.send();
  xhttp = null;
}

// run on page laod
function init() {
  fetchCategories();
};
init();
