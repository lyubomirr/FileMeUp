(() => {
    function showNoLinkMessage() {
        Utils.showErrorMessageInSection("No link found for the corresponding token!");
    }

    function populateFields(file) {
        document.getElementById("file-name").append(file.name);
        document.getElementById("description").innerText = file.description;
        document.getElementById("extension").innerText = file.extension;
        document.getElementById("size").innerText = file.size;
        document.getElementById("store-date").innerText = file.storeDate;
    }

    function addDownloadButtonListener(token) {
        const downloadBtn = document.getElementById("download-button");
        downloadBtn.addEventListener("click", () => {
            window.open(`get-file-content.php?token=${token}&download=true`);
        })
    }

    function showViewer(file, token) {
        const viewSection = document.getElementById("file-view-section");
        if (file.mimeType.startsWith("image")) {
            viewSection.innerHTML = `<img class="file-preview" src="get-file-content.php?token=${token}" />`;
            return;
        }

        if (file.mimeType.startsWith("video")) {
            viewSection.innerHTML =
                `<video class="file-preview" controls>
                    <source src="get-file-content.php?token=${token}" type="${file.mimeType}">
                    Your browser does not support the video tag.
                </video>`;
            return;
        }

        if (file.mimeType.startsWith("audio")) {
            viewSection.innerHTML =
                `<audio class="file-preview" controls>
                    <source src="get-file-content.php?token=${token}" type="${file.mimeType}">
                    Your browser does not support the audio tag.
                </audio>`;
            return;
        }

        if (file.mimeType.startsWith("text") || file.mimeType == "application/pdf") {
            viewSection.innerHTML =
                `<iframe class="file-preview" src="get-file-content.php?token=${token}" title="${file.name}"></iframe>`;
            return;
        }
    }

    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get("token");

    if (!token) {
        showNoLinkMessage();
        return;
    }

    ApiFacade.getFileByToken(token)
        .then((file) => {
            if (Utils.isEmptyNullOrUndefined(file)) {
                showNoFileMessage();
                return;
            }

            addDownloadButtonListener(token);
            populateFields(file);
            showViewer(file, token);
        })
        .catch(err => {
            Utils.showErrorMessageInSection(err.errorMessages);
        });
})();