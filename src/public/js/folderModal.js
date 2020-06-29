document.getElementsByClassName("add-icon")[0].addEventListener('click', () => {
    showFolderModal("Add folder", "", "add-folder.php");
});

function addEditModalEvent(response) {
    var editButtons = document.getElementsByClassName("fa-edit")
    
    for (let i = 0; i < editButtons.length; i++) {
        const element = editButtons[i];
            
        element.addEventListener('click', (event) => {
            var editButton = event.target;
            var folderName = editButton.parentNode.parentNode.parentNode.firstChild.firstChild.textContent;

            showFolderModal("Edit folder name", folderName, response[i].editLink);
        });
    }    
}

function showFolderModal(modalTitle, modalBodyText, formAction) {
    var folderModal = document.getElementById("folder-modal");
    folderModal.classList.add("show");

    var title = folderModal.querySelector(".modal-title");
    title.textContent = modalTitle;
        
    var bodyText = document.getElementById("folder-name-input");
    bodyText.value = modalBodyText;

    var form = document.getElementById("modal-form");
    form.setAttribute("action", formAction);
    form.setAttribute("method", "post");
}

function addConfirmModalEvent(response) {
    var deleteButtons = document.getElementsByClassName("fa-trash-alt")
    
    for (let i = 0; i < deleteButtons.length; i++) {
        const element = deleteButtons[i];
            
        element.addEventListener('click', (event) => {
            var folderModal = document.getElementById("confirm-modal");
            folderModal.classList.add("show");
            
            var editButton = event.target;
            var folderName = editButton.parentNode.parentNode.parentNode.firstChild.firstChild.textContent;
            var confirmModalBody = folderModal.querySelector(".modal-dialog .modal-content .modal-body");
            confirmModalBody.innerHTML = "<p> Are you sure you want to delete '" + folderName + "' ?";
            var confirmButton = document.getElementById("confirm");
            confirmButton.setAttribute("onclick", "deleteFolder('" + response[i].deleteLink + "');");
        });
    }    
}

function deleteFolder(deleteLink) {
    ApiFacade.delete(deleteLink)
        .then(window.location.reload());
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
