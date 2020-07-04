function insertFiles(folderId) {

    ApiFacade.getFiles(folderId)
    .then(response => {
        fillGrid(response);
        //addEditModalEvent(response);
        //addConfirmModalEvent(response);
    });
}

// function fillTable(response) {
//     var filesTable = document.getElementById("files_table");
//     var tBodies = document.createElement('tbody');

//     var tableRowsHtml = "";
//     if (response.length == 0) {
//         tableRowsHtml = "<tr class='no-files'>" +
//                             "<td><h4>There is no files! Click the add icon to add a new file.</h4></td>" + 
//                         "</tr>";
//     } else {
//         var container = document.getElementsByClassName("container")[0];
//         var tableWidth = container.innerWidth;
//         var numberOfFilesOnRow = tableWidth / 200;
//         var rows = response.length / numberOfFilesOnRow;

//         var processedFiles = 0;
//         for (let i = 0; i < rows; i++) {
//             var tableRow = document.createElement('tr');
//             var tableRowDataHtml = "";
//             for (let j = 0; j < numberOfFilesOnRow; j++) {
//                 let file = response[processedFiles];

//                 tableRowDataHtml = tableRowDataHtml + 
//                 "<td class='file-box'>" +
//                     "<div class='file'>" +
//                         "<div class='file-content'>" +
//                         "</div>" +
//                         "<div class='file-data'>" +
//                         "</div>" +
//                     "</div>" +
//                 "</td>"; 

//                 processedFiles++;
//             }

//             tableRow.innerHTML = tableRowDataHtml;
//         }

//         for (let i = 0; i < response.length; i++) {
//             const file = response[i];
            
//             tableRowsHtml = tableRowsHtml + 
//             "<tr class='table-row clickable-row'>" +
//                 "<td class='folder-icon table-data'>" +
//                     "<i class='fa fa-folder'></i>" +
//                 "</td>" +
//                 "<td class='table-data'>" + 
//                     "<a href='" + folder.openLink + "' class='w-100 h-100'>" + folder.name + "</a>" + 
//                 "</td>" + 
//                 "<td class='icon-options table-data'>" + 
//                     "<span class='float-r'>" + 
//                     "<i class='fas fa-trash-alt option-icon' title='Delete folder'></i>" + 
//                     "</span>" + 
//                     "<span class='float-r'>" + 
//                     "<i class='fas fa-edit option-icon' title='Edit folder name'></i>" + 
//                     "</span>" + 
//                 "</td>" +
//             "</tr>";
//         }
//     }
    
//     tBodies.innerHTML = tableRowsHtml;
//     filesTable.appendChild(tBodies);
// }

function fillGrid(response) {
    var filesGrid = document.getElementById("files-grid");

    var filesGridHTML = "";

    for (let i = 0; i < response.length; i++) {
        const file = response[i];
        filesGridHTML = filesGridHTML + 
        "<div class='file'>" +
            "<div class='file-content'>" +
                "<img class='file-thumb' src='" + file.filePath + "'>" +
            "</div>" +
            "<div class='file-data'>" +
                file.name +
            "</div>" +
        "</div>";
    }

    filesGrid.innerHTML = filesGridHTML;
}