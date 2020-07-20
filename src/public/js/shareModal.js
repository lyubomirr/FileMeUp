(() => {
    const formElement = document.getElementById("share-modal-form");
    formElement.addEventListener("submit", ev => {
        ev.preventDefault();
        let formData = new FormData(formElement);
        const shareLink = formElement.getAttribute("action");
        ApiFacade.postFormData(shareLink, formData)
            .then((response) => {
                showShareLink(response);
            })
            .catch(err => {
                Utils.addErrors(err.errorMessages);
            });
    });
})();

function addShareModalEvent(response) {
    var shareButtons = document.getElementsByClassName("fa-share-alt")

    for (let i = 0; i < shareButtons.length; i++) {
        const shareButton = shareButtons[i];

        shareButton.addEventListener('click', () => {
            var shareModal = document.getElementById("share-modal");
            shareModal.classList.add("show");

            const file = response[i];
            const shareFileLink = "share-file.php?fileId=" + file.id;

            var form = document.getElementById("share-modal-form");
            form.setAttribute("action", shareFileLink);
            form.setAttribute("method", "POST");
        });
    }
}

function showShareLink(token) {
    const pathname = window.location.pathname; 
    const link = pathname.substring(0, pathname.lastIndexOf("/") + 1) + "open-link.php?token=" + token;

    let formGroup = document.getElementsByClassName("form-group")[0];
    formGroup.innerHTML = "<input id='link' type='text' readonly value='" + window.location.origin + link + "'>";

    let submitButton = document.getElementById("submit");
    submitButton.innerHTML = "Copy link";
    submitButton.setAttribute("type", "button");
    submitButton.setAttribute("onclick", "copyLinkToClipboard()");
}

function copyLinkToClipboard() {
    let copyText = document.getElementById("link");
    navigator.clipboard.writeText(copyText.value);
}

function closeShareModal() {
    var shareModal = document.getElementById("share-modal");
    if (shareModal.classList.contains("show")) {
        shareModal.classList.remove("show");
    }
}
