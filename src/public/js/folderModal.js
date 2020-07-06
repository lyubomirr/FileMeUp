(() => {
    var form = document.getElementById("modal-form");
    form.addEventListener('submit', (event) => {
        event.preventDefault();

        const folder = Utils.parseFormDataToObject(new FormData(form));
        const link = form.getAttribute("action");
        ApiFacade.post(link, folder.name)
            .then(() => {
                closeFolderModal();

                var searchInput = document.getElementById("search-input");
                let searchQuery = new SearchQuery(searchInput.value, 100, 0);
                updateTableAndAddEvents(searchQuery);
            });
    });
})();

(() => {
    document.getElementsByClassName("add-icon")[0].addEventListener('click', () => {
        showFolderModal("Add folder", "", "add-folder.php");
    });
})();

function addEditModalEvent(response) {
    var editButtons = document.getElementsByClassName("fa-edit")

    for (let i = 0; i < editButtons.length; i++) {
        const editButton = editButtons[i];

        editButton.addEventListener('click', (event) => {
            var folder = response[i];

            var editLink = "edit-folder.php?folderId=" + folder.id;
            showFolderModal("Edit folder name", folder.name, editLink);
        });
    }
}

function showFolderModal(modalTitle, modalBodyText, submitLink) {
    var folderModal = document.getElementById("folder-modal");
    folderModal.classList.add("show");

    var title = folderModal.querySelector(".modal-title");
    title.textContent = modalTitle;
    
    var bodyText = document.getElementById("folder-name-input");
    bodyText.value = modalBodyText;

    var form = document.getElementById("modal-form");
    form.setAttribute("action", submitLink);
}

function addConfirmModalEvent(response) {
    var deleteButtons = document.getElementsByClassName("fa-trash-alt")

    for (let i = 0; i < deleteButtons.length; i++) {
        const deleteButton = deleteButtons[i];

        deleteButton.addEventListener('click', () => {
            var folderModal = document.getElementById("confirm-modal");
            folderModal.classList.add("show");

            var folderName = response[i].name;
            var confirmModalBody = folderModal.querySelector(".modal-dialog .modal-content .modal-body");
            confirmModalBody.innerHTML = "<p> Are you sure you want to delete '" + folderName + "' ?";
            var confirmButton = document.getElementById("confirm");
            confirmButton.setAttribute("onclick", "deleteFolderAndCloseModal('" + response[i].id + "');");
        });
    }
}

function deleteFolderAndCloseModal(folderId) {
    ApiFacade.deleteFolder(folderId)
        .then(() => {
            closeConfirmModal();

            var searchInput = document.getElementById("search-input");
            let searchQuery = new SearchQuery(searchInput.value, 100, 0);
            updateTableAndAddEvents(searchQuery);
        });
}

function closeFolderModal() {
    var folderModal = document.getElementById("folder-modal");
    if (folderModal.classList.contains("show")) {
        folderModal.classList.remove("show");
    }
}

function closeConfirmModal() {
    var folderModal = document.getElementById("confirm-modal");
    if (folderModal.classList.contains("show")) {
        folderModal.classList.remove("show");
    }
}
