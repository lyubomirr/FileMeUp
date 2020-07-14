(() => {
    function showNoFileMessage() {
        Utils.showErrorMessageInSection("No file found for the corresponding id!");
    }

    function populateFields(file) {
        document.getElementById("file-name").append(file.name);
        document.getElementById("description").innerText = file.description;
        document.getElementById("extension").innerText = file.extension;
        document.getElementById("size").innerText = file.size;
        document.getElementById("store-date").innerText = file.storeDate;
        document.getElementById("last-modified-date").innerText = file.lastModifiedDate;
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
        })
        .catch(err => {
            Utils.showErrorMessageInSection(err.errorMessages);
        });
})();