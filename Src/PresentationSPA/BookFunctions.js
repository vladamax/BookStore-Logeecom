/**+
 * Makes a table-representation of books and all its values
 * @param arr
 * @param authorId
 * @returns {HTMLTableElement}
 */
function makeHTMLBook(arr,authorId)
{
    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    table.classList.add("table1");

    table.appendChild(thead);
    table.appendChild(tbody);

    let row_1 = document.createElement('tr');

    let heading_2 = document.createElement('th');
    heading_2.innerHTML = "Book";
    let heading_3 = document.createElement('th');
    heading_3.innerHTML = "Actions";
    heading_3.colSpan=3;

    row_1.appendChild(heading_2);
    row_1.appendChild(heading_3);
    thead.appendChild(row_1);

    for(let i=1; i<arr.length ; i++)
    {
        let row = document.createElement('tr');
        row.classList.add('tRow');

        let td2 = document.createElement('td');
        td2.innerHTML = arr[i].title + '(' + arr[i].year + ')';
        td2.classList.add("titleTd");
        let td3 = document.createElement('td');
        let btnDel = document.createElement('input');

        btnDel.type='image';
        btnDel.src='/Src/Resources/deleteSign.jpg';
        btnDel.classList.add('delBtn');

        let td4 = document.createElement('td');

        let btnUpd = document.createElement('input');
        btnUpd.classList.add('delBtn');
        btnUpd.type='image';
        btnUpd.src='/Src/Resources/editSign.jpg';


        btnDel.addEventListener("click" ,deleteBookDialog.bind(this, [arr[i].id],authorId));
        btnDel.textContent = "Delete";
        td3.appendChild(btnDel);

        btnUpd.addEventListener("click" ,showBookEditingPage.bind(this, [arr[i].id],authorId , arr[i].title ,arr[i].year));
        btnUpd.textContent = "Update";
        td4.appendChild(btnUpd);

        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);

        tbody.appendChild(row);
    }

    let row = document.createElement('tr');

    let td1 = document.createElement('td');
    td1.classList.add('lastTableRow')
    let btnAdd = document.createElement('input');
    btnAdd.type='image';
    btnAdd.src='/Src/Resources/plus_Sign.png';
    btnAdd.textContent="Add a book";
    btnAdd.classList.add('addBtn');


    btnAdd.addEventListener("click", showBookCreationPage.bind(this, authorId));

    td1.appendChild(btnAdd);
    td1.colSpan=2;

    row.appendChild(td1);

    tbody.appendChild(row);

    return table;
}

/**
 * Fetches data to populate the above-mentioned (makeHTMLAuthor)
 * @param authorId
 */
function listBooks(authorId)
{
    const data = {
        entityType: 'books',
        action: 'list',
        authorId:authorId
    }
    const jsonData = JSON.stringify(data);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/Src/PresentationSPA/Router.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(jsonData);


    xhr.onload = function () {
        let arr = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML='';
        document.getElementById("demo").appendChild(makeHTMLBook(arr,authorId));
        document.getElementById("demo").value = authorId;
    }
}

/**
 * Inserts the book to the database
 * @param authorId
 */
function bookAdded(authorId)
{
    const data = {
        entityType: 'books',
        action: 'insert',
        authorId: authorId,
        title:document.getElementById("title").value,
        year:document.getElementById('year').value
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function()
    {
        let arr = JSON.parse(this.responseText);
        if (!Array.isArray(arr))
        {
            document.getElementById('message').innerHTML = arr;
        }
        else
        {
            document.getElementById("demo").innerHTML='';
            document.getElementById("demo").appendChild(makeHTMLBook(arr,authorId));
        }
    }

    const jsonData = JSON.stringify(data);

    xhttp.open("POST","/Src/PresentationSPA/Router.php");
    xhttp.setRequestHeader("Content-type" , "Application/json");
    xhttp.send(jsonData);
}

/**
 * Serves as a page to create new book
 * @param authorId
 */
function showBookCreationPage(authorId)
{
    let brakeLine = document.createElement('BR');

    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    let header = document.createElement('header');
    header.innerHTML ="Book Create";
    let header2 = document.createElement('header');
    header2.innerHTML = "Title";

    let title = document.createElement('input');
    title.type='text';
    title.id='title';

    let header3 = document.createElement('header');
    header3.innerHTML = "Year";

    let year = document.createElement('input');
    year.type='text';
    year.id='year';

    let btnSave = document.createElement('button');
    btnSave.textContent = "Save";

    btnSave.addEventListener("click" , bookAdded.bind(this,authorId));

    let message = document.createElement('div');
    message.id = 'message';

    tbody.appendChild(header);
    tbody.appendChild(header2);
    tbody.appendChild(title);
    tbody.appendChild(brakeLine);
    tbody.appendChild(header3);
    tbody.appendChild(brakeLine);
    tbody.appendChild(year);
    tbody.appendChild(brakeLine);
    tbody.appendChild(btnSave);
    tbody.appendChild(message);

    document.getElementById("demo").innerHTML='';
    document.getElementById("demo").appendChild(tbody);
}

/**
 * Delete confirmation dialog
 * @param id
 * @param authorId
 */
function deleteBookDialog(id , authorId)
{
    let tbody = document.createElement('tbody');

    let header = document.createElement('header');
    header.innerHTML = "Are you sure you want to delete ?";

    let btnYes = document.createElement('button');
    let btnNo = document.createElement('button');

    btnYes.textContent="Delete";
    btnNo.textContent="Cancel";

    btnYes.addEventListener("click" , deleteBook.bind(this,id,authorId));
    btnNo.addEventListener("click",listBooks.bind(this,authorId));

    tbody.appendChild(header);
    tbody.appendChild(btnYes);
    tbody.appendChild(btnNo);
    document.getElementById("demo").appendChild(tbody);
}

/**
 * Deletes the book from the database
 * @param bookId
 * @param authorId
 */
function deleteBook(bookId , authorId)
{
    const data = {
        entityType: 'books',
        action: 'del',
        authorId: authorId,
        bookId:bookId
    }
    const jsonData = JSON.stringify(data);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/Src/PresentationSPA/Router.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(jsonData);

    xhr.onload = function () {
        let arr = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML='';
        document.getElementById("demo").appendChild(makeHTMLBook(arr,authorId));
    }
}

/**
 * Serves as a page to input new values for the existing book
 * @param bookId
 * @param authorId
 * @param title
 * @param yearOfPublish
 */
function showBookEditingPage(bookId,authorId , title ,yearOfPublish)
{

    let brakeLine = document.createElement('BR');

    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    let header = document.createElement('header');
    header.innerHTML ="Book Edit";
    let header2 = document.createElement('header');
    header2.innerHTML = "New Title";

    let bookTitle = document.createElement('input');
    bookTitle.type='text';
    bookTitle.id='title';
    bookTitle.placeholder = title;

    let header3 = document.createElement('header');
    header3.innerHTML = "Year";

    let year_ = document.createElement('input');
    year_.type='text';
    year_.id='year';
    year_.placeholder = yearOfPublish;

    let btnSave = document.createElement('button');
    btnSave.textContent = "Save";

    btnSave.addEventListener("click" , updateEnteredBook.bind(this , bookId,authorId , title ,yearOfPublish));

    let message = document.createElement('div');
    message.id = 'message';

    tbody.appendChild(header);
    tbody.appendChild(header2);
    tbody.appendChild(bookTitle);
    tbody.appendChild(brakeLine);
    tbody.appendChild(header3);
    tbody.appendChild(brakeLine);
    tbody.appendChild(year_);
    tbody.appendChild(brakeLine);
    tbody.appendChild(btnSave);
    tbody.appendChild(message);

    document.getElementById("demo").innerHTML='';
    document.getElementById("demo").appendChild(tbody);
}

/**
 * Updates the book
 * @param bookId
 * @param authorId
 * @param title
 * @param year
 */
function updateEnteredBook(bookId,authorId , title ,year)
{
    const data = {
        entityType: 'books',
        action: 'update',
        bookId:bookId,
        title:title,
        year:year,
        authorId:authorId,
        titleUpdated:document.getElementById("title").value,
        yearUpdated:document.getElementById("year").value
    }

    const xhttp = new XMLHttpRequest();
    xhttp.onload = function()
    {
        let arr = JSON.parse(this.responseText);

        if (!Array.isArray(arr))
        {
            document.getElementById('message').innerHTML = arr;
        }
        else {
            document.getElementById("demo").innerHTML='';
            document.getElementById("demo").appendChild(makeHTMLBook(arr,authorId));
        }

    }

    const jsonData = JSON.stringify(data);

    xhttp.open("POST","/Src/PresentationSPA/Router.php");
    xhttp.setRequestHeader("Content-type" , "Application/json");
    xhttp.send(jsonData);
}