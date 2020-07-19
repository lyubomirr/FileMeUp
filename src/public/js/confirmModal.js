function addConfirmModalEvent(response, iconClassName, onClickAction) {
    var deleteButtons = document.getElementsByClassName(iconClassName)

    for (let i = 0; i < deleteButtons.length; i++) {
        const deleteButton = deleteButtons[i];

        deleteButton.addEventListener('click', () => {
            var confirmModal = document.getElementById("confirm-modal");
            confirmModal.classList.add("show");

            var name = response[i].name;
            var confirmModalBody = confirmModal.querySelector(".modal-dialog .modal-content .modal-body");
            confirmModalBody.innerHTML = "<p> Are you sure you want to delete '" + name + "' ?";
            var confirmButton = document.getElementById("confirm");
            confirmButton.setAttribute("onclick", onClickAction + "('" + response[i].id + "');");
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

function deleteFileAndCloseModal(fileId) {
    ApiFacade.deleteFile(fileId)
        .then(() => {
            closeConfirmModal();

            var searchInput = document.getElementById("search-input");
            let searchQuery = new SearchQuery(searchInput.value, 100, 0);
            updateGridAndAddEvents(searchQuery);
        });
}

function closeConfirmModal() {
    var folderModal = document.getElementById("confirm-modal");
    if (folderModal.classList.contains("show")) {
        folderModal.classList.remove("show");
    }
}