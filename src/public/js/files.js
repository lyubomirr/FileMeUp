(() => {

    const urlParams = new URLSearchParams(window.location.search);
    const folderId = urlParams.get("folderId");
    if (!folderId) {
        Utils.showErrorMessageInSection("No folder with this id.");
        return;
    }

    addExportButtonListener(folderId);
    addUploadButtonListener(folderId);
    showLoader();
    ApiFacade.getFiles(folderId)
        .then(response => {
            fillGrid(response);
            addConfirmModalEvent(response, "fa-trash", "deleteFileAndCloseModal");
            addShareModalEvent(response);
        })
        .catch(err => Utils.showErrorMessageInSection(err.errorMessages));

    var searchInput = document.getElementById("search-input");
    searchInput.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            let searchValue = event.target.value;
            const urlParams = new URLSearchParams(window.location.search);
            const folderId = urlParams.get("folderId");

            showLoader();
            let searchQuery = new SearchQuery(searchValue, 100, 0);
            ApiFacade.getFiles(folderId, searchQuery)
                .then(response => {
                    fillGrid(response)
                    addConfirmModalEvent(response, "fa-trash", "deleteFileAndCloseModal");
                    addShareModalEvent(response);
                })
                .catch(err => Utils.showErrorMessageInSection(err.errorMessages));
        }
    });
})();

function fillGrid(response) {
    var filesGrid = document.getElementById("files-grid");
    var filesGridHTML = "";

    let filesInformation = document.getElementById("files-information");
    filesInformationHTML = "";

    if (response.length == 0) {
        filesInformationHTML = "<div class='no-files items-information'>" +
            "<h4>There is no files! Click the add icon to add a new files.</h4>" +
            "</div>";
    } else {
        for (let i = 0; i < response.length; i++) {
            const file = response[i];

            let fileIcon = getFileIconFromExtension(file.extension);
            let contentImage = "";
            let contentClassList = "";
            if (file.hasThumbnail == true) {
                contentImage = file.thumbnailPath;
                contentClassList = "file-thumb";
            } else {
                contentImage = fileIcon;
                contentClassList = "file-icon-image";
            }

            filesGridHTML = filesGridHTML +
                "<div class='file-item'>" +
                `<a href=view-file.php?fileId=${file.id}>` +
                "<div class='file-content'>" +
                "<div class='" + contentClassList + "'>" +
                "<img src='" + contentImage + "'>" +
                "</div>" +
                "<div class='file-data'>" +
                "<div class='file-type-icon'>" +
                "<img class='file-icon' src='" + fileIcon + "'></i>" +
                "</div>" +
                "<span class='file-name'>" +
                file.name +
                "</span>" +
                "</div>" +
                "</a>" +
                "<div class='file-options'>" +
                "<i class='fa fa-share-alt file-option share-icon' title='Share'></i>" +
                "<i class='fa fa-trash file-option delete-icon' title='Delete file'></i>" +
                "</div>" +
                "</div>" +
                "</div>";
        }
    }
    filesGrid.innerHTML = filesGridHTML;
    filesInformation.innerHTML = filesInformationHTML;

    hideLoader();
}

function getFileIconFromExtension(extension) {
    const baseUrl = "http://ssl.gstatic.com/docs/doclist/images/mediatype/";
    switch (extension) {
        case "pdf":
            return baseUrl + "icon_3_pdf_x128.png";
        case "docx":
        case "doc":
        case "docs":
            return baseUrl + "icon_1_document_x128.png";
        case "png":
        case "jpeg":
        case "jpg":
        case "gif":
            return baseUrl + "icon_1_image_x128.png";
        case "txt":
            return baseUrl + "icon_1_text_x128.png";
        case "xlsx":
        case "csv":
        case "xls":
            return baseUrl + "icon_1_spreadsheet_x128.png";
        case "mp3":
            return baseUrl + "icon_1_audio_x128.png";
        case "mp4":
            return baseUrl + "icon_1_video_x128.png";
        default:
            return baseUrl + "icon_1_text_x128.png";
    }
}

function updateGridAndAddEvents(searchQuery) {
    const urlParams = new URLSearchParams(window.location.search);
    const folderId = urlParams.get("folderId");

    showLoader();
    ApiFacade.getFiles(folderId, searchQuery)
        .then(response => {
            fillGrid(response);
            addConfirmModalEvent(response, "fa-trash", "deleteFileAndCloseModal");
            addShareModalEvent(response);
        });
}

function hideLoader() {
    const loader = document.getElementById("loader-spinner");
    loader.classList.add("hide");
}

function showLoader() {
    const loader = document.getElementById("loader-spinner");
    if (loader.classList.contains("hide")) {
        loader.classList.remove("hide");
    }
}

function addExportButtonListener(folderId) {
    const btn = document.getElementsByClassName("export-icon")[0];
    btn.addEventListener("click", () => {
        window.open(`export-folder-metadata.php?folderId=${folderId}`);
    })
}

function addUploadButtonListener(folderId) {
    const btn = document.getElementsByClassName("add-icon")[0];
    btn.addEventListener("click", () => {
        window.location = `upload-file.php?folderId=${folderId}`;
    })
}