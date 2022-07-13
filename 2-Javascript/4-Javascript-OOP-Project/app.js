const bookForm = document.querySelector("#book-form");
const titleDom = document.querySelector("#title");
const authorDom = document.querySelector("#author");
const isbnDom = document.querySelector("#isbn");
const bookList = document.querySelector("#book-list");

function Book(title, author, isbn) {
  this.title = title;
  this.author = author;
  this.isbn = isbn;
}


function UI() {}

UI.prototype.clearFields = function () {
  titleDom.value = "";
  authorDom.value = "";
  isbnDom.value = "";
};

UI.prototype.addBook = function (book) {
  const tableRow = document.createElement("tr");
  tableRow.innerHTML = `
          <td>${book.title}</td>
          <td>${book.author}</td>
          <td>${book.isbn}</td>
          <td><a href="#" class="delete">X<a>
          </td>`;
  bookList.appendChild(tableRow);
};

UI.prototype.showAlert = function(message,className){
  const div = document.createElement('div');
  div.className = `alert ${className}`;
  div.appendChild(document.createTextNode(message));

   const container = document.querySelector('.container');

   const form = document.querySelector('#book-form');
 
   container.insertBefore(div, form);

   setTimeout(function(){
    document.querySelector('.alert').remove();
   },3000); 
}

bookForm.addEventListener("submit", function (event) {
  event.preventDefault();
  
  const title = titleDom.value,
    author = authorDom.value,
    isbn = isbnDom.value;

  const book = new Book(title, author, isbn);

  const ui = new UI();

  if (title == "" || author == "" || isbn == "") {
    ui.showAlert('PLEASE FILL THE VALUS BELOW','error');
    return;
  }else{
    ui.addBook(book);
    ui.showAlert('BOOK ADDED!', 'success');
    ui.clearFields();  
  }
  
});

bookList.addEventListener("click", function (event) {
  const currentElement = event.target;
  if (currentElement.className == "delete") {
    if (confirm("ARE YOU SURE")) {
      currentElement.parentElement.parentElement.remove();
    }
  }
});