import { SearchQuery } from "./searchQuery.js"

window.addEventListener("load", () => {
    let searchQuery = new SearchQuery("", 100, 0); 
    fetch("get-folders.php", {
        method: "Post",
        body: JSON.stringify(searchQuery)
    })
    .then(response => response.json())
    .then(response => {
        fillTable(response);
    });
});

var searchInput = document.getElementsByClassName("search-input")[0];
searchInput.addEventListener("keyup", function(event) {
    if(event.key === "Enter") {
        let searchValue = event.target.value;
        let searchQuery = new SearchQuery(searchValue, 100, 0);

        fetch("get-folders.php", {
            method: "Post",
            body: JSON.stringify(searchQuery)
        })
        .then(response => response.json())
        .then(response => {
            updateTable(response);
        });
    }
});

function updateTable(response) {
    var foldersTable = document.getElementById("folders_table");
    foldersTable.innerHTML = "";
    
    fillTable(response);
}

function fillTable(response) {
    var foldersTable = document.getElementById("folders_table");
    var tBodies = document.createElement('tbody');

    if(response.length == 0) {
        var noFoldersDiv = document.createElement("div");
        var noFoldersHeading = document.createElement("h4");
        noFoldersHeading.innerText = "There is no folders";
        noFoldersHeading.setAttribute("class", "no-folders");
        noFoldersDiv.appendChild(noFoldersHeading);

        foldersTable.parentNode.insertBefore(noFoldersDiv, foldersTable.nextSibling);
        return;
    }

    for (let i = 0; i < response.length; i++) {
        const folder = response[i];
        
        var tr = document.createElement('tr');
        tr.setAttribute("class", "table-row clickable-row");
        var td = document.createElement('td');
        td.setAttribute("class", "table-data");

        var link = document.createElement('a');
        link.setAttribute("href", 'get-files.php?folderId=' + folder.id);
        link.setAttribute("class", "w-100 h-100");
        link.appendChild(document.createTextNode(folder.name));

        var iconIptions = createIconOptions();
        td.appendChild(link);
        tr.appendChild(td);
        tr.appendChild(iconIptions);
        tBodies.appendChild(tr);
    }

    foldersTable.appendChild(tBodies);
}

function createIconOptions() {
    var td = document.createElement('td');
    td.setAttribute('class', 'icon-options table-data');

    var deleteIcon = document.createElement('i');
    deleteIcon.setAttribute('class', 'fas fa-trash-alt option-icon');
    deleteIcon.setAttribute('title', 'Delete folder');
    var deleteSpan = document.createElement('span');
    deleteSpan.setAttribute('class', 'float-r')
    deleteSpan.appendChild(deleteIcon);
    td.appendChild(deleteSpan);

    var editIcon = document.createElement('i');
    editIcon.setAttribute('class', 'fas fa-edit option-icon');
    editIcon.setAttribute('title', 'Edin folder name');
    var editSpan = document.createElement('span');
    editSpan.setAttribute('class', 'float-r');
    editSpan.appendChild(editIcon);
    td.appendChild(editSpan);
    
    return td;
}