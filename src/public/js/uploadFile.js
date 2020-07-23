(() => {
    const fileInput = document.getElementById("file");
    fileInput.addEventListener("change", (event) => {
        const fileInput = event.currentTarget;

        const lastDot = fileInput.files[0].name.lastIndexOf('.');
        const ext = fileInput.files[0].name.substring(lastDot + 1);
        const zipCheckbox = document.getElementById("zip-checkbox");
        if (ext == "zip") {
            if (zipCheckbox.classList.contains("hide"))
                zipCheckbox.classList.remove("hide");
        } else {
            if (!zipCheckbox.classList.contains("hide"))
                zipCheckbox.classList.add("hide");
        }
    })

    function addFormEventListener(folderId) {
        const formElement = document.getElementById("upload-file-form");

        formElement.addEventListener("submit", ev => {
            ev.preventDefault();
            let formData = new FormData(formElement);

            var file = document.getElementById("file");
            if (file.files.length == 0) {
                Utils.addErrors(["Please choose file."]);
            }

            formData.append("folderId", folderId);

            ApiFacade.uploadFile(formData)
                .then(() => {
                    redirectToFolder(folderId);
                })
                .catch(err => {
                    Utils.addErrors(err.errorMessages);
                });
        });
    }

    function redirectToFolder(folderId) {
        window.location.href = "folder.php?folderId=" + folderId;
    }

    function addBackButtonListener(folderId) {
        const btn = document.getElementsByClassName("back-icon")[0];
        btn.addEventListener("click", () => {
            redirectToFolder(folderId);
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    const folderId = urlParams.get("folderId");

    if (!folderId) {
        Utils.showErrorMessageInSection("No folder id provided.");
        return;
    }

    addFormEventListener(folderId);
    addBackButtonListener(folderId);

    ApiFacade.getFolderById(folderId)
        .catch(err => {
            Utils.showErrorMessageInSection(err.errorMessages);
        });
})();