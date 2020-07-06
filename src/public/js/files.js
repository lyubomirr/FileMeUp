(() => {

    const urlParams = new URLSearchParams(window.location.search);
    const folderId = urlParams.get("folderId");
    if (!folderId) {
        Utils.showErrorMessageInSection("No folder with this id.");
        return;
    }

    ApiFacade.getFiles(folderId)
        .then(response => {
            fillGrid(response);
        });

    var searchInput = document.getElementById("search-input");
    searchInput.addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            let searchValue = event.target.value;
            const urlParams = new URLSearchParams(window.location.search);
            const folderId = urlParams.get("folderId");

            let searchQuery = new SearchQuery(searchValue, 100, 0);
            ApiFacade.getFiles(folderId, searchQuery)
                .then(response => fillGrid(response));
        }
    });

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
                    "<div class='file-name'>" +
                    file.name +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</a>" +
                    "</div>";
            }
        }
        filesGrid.innerHTML = filesGridHTML;
        filesInformation.innerHTML = filesInformationHTML;
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
})();