/**
 * Makes a table-representation of authors and all its values
 * @param arr
 * @returns {HTMLTableElement}
 */
function makeHTMLAuthor(arr)
{

    let table = document.createElement('table');
    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    table.classList.add("table1");

    table.appendChild(thead);
    table.appendChild(tbody);

    let row_1 = document.createElement('tr');

    let heading_1 = document.createElement('th');
    heading_1.innerHTML = 'Name';
    let heading_2 = document.createElement('th');
    heading_2.innerHTML = 'Books';
    let heading_3 = document.createElement('th');
    heading_3.innerHTML = "Actions";
    heading_3.colSpan=3;

    row_1.appendChild(heading_1);
    row_1.appendChild(heading_2);
    row_1.appendChild(heading_3);
    thead.appendChild(row_1);

    for(let i=1; i<arr.length ; i++)
    {
        let row = document.createElement('tr');
        row.classList.add('tRow');

        let td2 = document.createElement('td');
        let avatar = document.createElement('img');
        avatar.width=20;
        avatar.src="/Src/Resources/avatarSign.png";
        let btnBooks = document.createElement('button');
        btnBooks.classList.add('nameBtn');
        btnBooks.name='id';
        btnBooks.textContent= arr[i].firstName + " " + arr[i].lastName;

        btnBooks.addEventListener("click" , listBooks.bind(this, arr[i].id));

        td2.appendChild(avatar);
        td2.appendChild(btnBooks);

        let td3 = document.createElement('td');
        td3.innerHTML = arr[i].numberOfBooks;
        td3.classList.add('numberOfBooksCell');
        let td4 = document.createElement('td');
        let btnDel = document.createElement('input');

        btnDel.type='image';
        btnDel.src='/Src/Resources/deleteSign.jpg';
        btnDel.classList.add('delBtn');

        let td5 = document.createElement('td');

        let btnUpd = document.createElement('input');
        btnUpd.classList.add('delBtn');
        btnUpd.type='image';
        btnUpd.src='/Src/Resources/editSign.jpg';




        btnDel.addEventListener("click" ,deleteAuthorDialog.bind(this, [arr[i].id]));
        btnDel.textContent = "Delete";
        td4.appendChild(btnDel);

        btnUpd.addEventListener("click" ,showAuthorEditingPage.bind(this, [arr[i].id] , arr[i].firstName , arr[i].lastName));
        btnUpd.textContent = "Update";
        td5.appendChild(btnUpd);

        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        row.appendChild(td5);

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


    btnAdd.addEventListener("click", showAuthorCreationPage.bind(this));

    td1.appendChild(btnAdd);
    td1.colSpan=2;

    row.appendChild(td1);

    tbody.appendChild(row);

    return table;
}

/**
 * Fetches data to populate the above-mentioned (makeHTMLAuthor)
 */
function listAuthors()
{
    const data = {
        entityType: 'authors',
        action: 'list'
    }

    const jsonData = JSON.stringify(data);

    const xhr = new XMLHttpRequest();
    xhr.open("POST", "/Src/PresentationSPA/Router.php");
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.send(jsonData);


    xhr.onload = function () {
        let arr = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML='';
        document.getElementById("demo").appendChild(makeHTMLAuthor(arr));
    }
}

/**
 * Serves as a page to create new author
 */
function showAuthorCreationPage()
{
    let brakeLine = document.createElement('BR');

    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    let header = document.createElement('header');
    header.innerHTML ="Author Create";
    let header2 = document.createElement('header');
    header2.innerHTML = "First Name";

    let title = document.createElement('input');
    title.type='text';
    title.id='firstName';

    let header3 = document.createElement('header');
    header3.innerHTML = "Last Name";

    let year = document.createElement('input');
    year.type='text';
    year.id='lastName';

    let btnSave = document.createElement('button');
    btnSave.textContent = "Save";

    btnSave.addEventListener("click" , authorAdded.bind(this));

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
 * Inserts the author to the database
 */
function authorAdded()
{
    const data = {
        entityType: 'authors',
        action: 'insert',
        firstName:document.getElementById("firstName").value,
        lastName:document.getElementById('lastName').value
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
            document.getElementById("demo").appendChild(makeHTMLAuthor(arr));
        }
    }

    const jsonData = JSON.stringify(data);

    xhttp.open("POST","/Src/PresentationSPA/Router.php");
    xhttp.setRequestHeader("Content-type" , "Application/json");
    xhttp.send(jsonData);
}

/**
 * Delete confirmation dialog
 * @param id
 */
function deleteAuthorDialog(id)
{
    let tbody = document.createElement('tbody');

    let header = document.createElement('header');
    header.innerHTML = "Are you sure you want to delete ?";

    let btnYes = document.createElement('button');
    let btnNo = document.createElement('button');

    btnYes.textContent="Delete";
    btnNo.textContent="Cancel";

    btnYes.addEventListener("click" , deleteAuthor.bind(this,id));
    btnNo.addEventListener("click",listAuthors.bind(this));

    tbody.appendChild(header);
    tbody.appendChild(btnYes);
    tbody.appendChild(btnNo);
        document.getElementById("demo").appendChild(tbody);
}

/**
 * Deletes the author from the database
 * @param authorId
 */
function deleteAuthor(authorId)
{
    const data = {
        entityType: 'authors',
        action: 'del',
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
        document.getElementById("demo").appendChild(makeHTMLAuthor(arr));
    }
}

/**
 * Serves as a page to input new values for the existing author
 * @param authorId
 * @param firstName
 * @param lastName
 */
function showAuthorEditingPage(authorId,firstName,lastName)
{
    let brakeLine = document.createElement('BR');

    let thead = document.createElement('thead');
    let tbody = document.createElement('tbody');

    let header = document.createElement('header');
    header.innerHTML ="Author Edit";
    let header2 = document.createElement('header');
    header2.innerHTML = "New First Name";

    let firstNameInput = document.createElement('input');
    firstNameInput.type='text';
    firstNameInput.id='firstName';
    firstNameInput.placeholder = firstName;

    let header3 = document.createElement('header');
    header3.innerHTML = "New Last Name";

    let lastNameInput = document.createElement('input');
    lastNameInput.type='text';
    lastNameInput.id='lastName';
    lastNameInput.placeholder = lastName;


    let btnSave = document.createElement('button');
    btnSave.textContent = "Save";

    btnSave.addEventListener("click" , updateEnteredAuthor.bind(this , authorId, firstName,lastName));

    let message = document.createElement('div');
    message.id = 'message';

    tbody.appendChild(header);
    tbody.appendChild(header2);
    tbody.appendChild(firstNameInput);
    tbody.appendChild(brakeLine);
    tbody.appendChild(header3);
    tbody.appendChild(brakeLine);
    tbody.appendChild(lastNameInput);
    tbody.appendChild(brakeLine);
    tbody.appendChild(btnSave);
    tbody.appendChild(message);

    document.getElementById("demo").innerHTML='';
    document.getElementById("demo").appendChild(tbody);
}

/**
 * Updates the author
 * @param authorId
 * @param firstName
 * @param lastName
 */

function updateEnteredAuthor(authorId,firstName,lastName)
{
    const data = {
        entityType: 'authors',
        action: 'update',
        authorId:authorId,
        firstName: firstName,
        lastName: lastName,
        firstNameUpdated:document.getElementById("firstName").value,
        lastNameUpdated:document.getElementById("lastName").value
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
            document.getElementById("demo").innerHTML = '';
            document.getElementById("demo").appendChild(makeHTMLAuthor(arr));
        }
    }

    const jsonData = JSON.stringify(data);

    xhttp.open("POST","/Src/PresentationSPA/Router.php");
    xhttp.setRequestHeader("Content-type" , "Application/json");
    xhttp.send(jsonData);
}