(() => {
    function showErrorMessage(message) {
        const mainSection = document.getElementsByClassName("app-main")[0];
        mainSection.innerHTML = `<h1 class='heading aligncenter'>${message}</h1>`;
    }

    function showNoFileMessage() {
        showErrorMessage("No file found for the corresponding id!");
    }

    function populateFields(file) {
        document.getElementById("file-name").innerText = file.name;
        document.getElementById("description").innerText = file.description;
        document.getElementById("extension").innerText = file.extension;
        document.getElementById("size").innerText = file.size;
        document.getElementById("store-date").innerText = file.storeDate;
        document.getElementById("last-modified-date").innerText = file.lastModifiedDate;
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
            populateFields(file);
        })
        .catch(err => {
            showErrorMessage(err.errorMessages);
        });
})();