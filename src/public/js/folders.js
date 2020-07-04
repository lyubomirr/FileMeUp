import { SearchQuery } from "./SearchQuery.js"

let searchQuery = new SearchQuery("", 100, 0);
ApiFacade.getFolders(searchQuery)
    .then(response => {
        fillTable(response);
        addEditModalEvent(response);
        addConfirmModalEvent(response);
    });

var searchInput = document.getElementById("search-input");
searchInput.addEventListener("keyup", function(event) {
    if (event.key === "Enter") {
        let searchValue = event.target.value;
        let searchQuery = new SearchQuery(searchValue, 100, 0);

        ApiFacade.getFolders(searchQuery)
            .then(response => {
                updateTable(response);
                addEditModalEvent(response);
                addConfirmModalEvent(response);
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

    var tableRowsHtml = "";
    if (response.length == 0) {
        tableRowsHtml = "<tr class='no-folders'>" +
            "<td><h4>There is no folders! Click the add icon to add a new folders.</h4></td>" +
            "</tr>";
    } else {

        for (let i = 0; i < response.length; i++) {
            const folder = response[i];

            tableRowsHtml = tableRowsHtml +
                "<tr class='table-row clickable-row'>" +
                "<td class='folder-icon table-data'>" +
                "<i class='fa fa-folder'></i>" +
                "</td>" +
                "<td class='table-data'>" +
                "<a href='" + folder.openLink + "' class='w-100 h-100'>" + folder.name + "</a>" +
                "</td>" +
                "<td class='icon-options table-data'>" +
                "<span class='float-r'>" +
                "<i class='fas fa-trash-alt option-icon' title='Delete folder'></i>" +
                "</span>" +
                "<span class='float-r'>" +
                "<i class='fas fa-edit option-icon' title='Edit folder name'></i>" +
                "</span>" +
                "</td>" +
                "</tr>";
        }
    }

    tBodies.innerHTML = tableRowsHtml;
    foldersTable.appendChild(tBodies);
}