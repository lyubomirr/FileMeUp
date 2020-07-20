(() => {
    function showNoFileMessage() {
        Utils.showErrorMessageInSection("No file found for the corresponding id!");
    }

    function populateFields(file) {
        document.getElementById("file-name").append(file.name);
        document.getElementById("description").innerText = file.description;
        document.getElementById("extension").innerText = file.extension;
        document.getElementById("size").innerText = getSize(file.size);
        document.getElementById("store-date").innerText = file.storeDate;
    }

    function getSize(fileSize) {
        if (fileSize < 1000) {
            return fileSize + " B";
        }

        if (fileSize < 1000 * 1000) {
            return Math.round(fileSize / 1000, 1) + " KB";
        }

        return Math.round(fileSize / (1000 * 1000), 1) + " MB";
    }

    function addBackButtonListener(folderId) {
        const btn = document.getElementsByClassName("back-icon")[0];
        btn.addEventListener("click", () => {
            redirectToFolder(folderId);
        });
    }

    function addDownloadButtonListener(fileId) {
        const downloadBtn = document.getElementById("download-button");
        downloadBtn.addEventListener("click", () => {
            window.open(`get-file-content.php?fileId=${fileId}&download=true`);
        })
    }

    function redirectToFolder(folderId) {
        window.location.href = "folder.php?folderId=" + folderId;
    }

    function showViewer(file) {
        console.log(file)
        const viewSection = document.getElementById("file-view-section");
        if (file.mimeType.startsWith("image")) {
            viewSection.innerHTML = `<img class="file-preview" src="get-file-content.php?fileId=${file.id}" />`;
            return;
        }

        if (file.mimeType.startsWith("video")) {
            viewSection.innerHTML =
                `<video class="file-preview" controls>
                    <source src="get-file-content.php?fileId=${file.id}" type="${file.mimeType}">
                    Your browser does not support the video tag.
                </video>`;
            return;
        }

        if (file.mimeType.startsWith("audio")) {
            viewSection.innerHTML =
                `<audio class="file-preview" controls>
                    <source src="get-file-content.php?fileId=${file.id}" type="${file.mimeType}">
                    Your browser does not support the audio tag.
                </audio>`;
            return;
        }

        if (file.mimeType.startsWith("text") || file.mimeType == "application/pdf") {
            viewSection.innerHTML =
                `<iframe class="file-preview" src="get-file-content.php?fileId=${file.id}" title="${file.name}"></iframe>`;
            return;
        }
    }

    const urlParams = new URLSearchParams(window.location.search);
    const fileId = urlParams.get("fileId");

    if (!fileId) {
        showNoFileMessage();
        return;
    }

    ApiFacade.getFileById(fileId)
        .then((file) => {
            if (Utils.isEmptyNullOrUndefined(file)) {
                showNoFileMessage();
                return;
            }

            addBackButtonListener(file.folderId);
            addDownloadButtonListener(fileId);
            populateFields(file);
            showViewer(file);
        })
        .catch(err => {
            Utils.showErrorMessageInSection(err.errorMessages);
        });
})();