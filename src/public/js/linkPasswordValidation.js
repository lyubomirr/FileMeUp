(() => {
    const formElement = document.getElementById("password-form");

    formElement.addEventListener("submit", ev => {
        ev.preventDefault();
        const formData = new FormData(formElement);
        const urlParams = new URLSearchParams(window.location.search);
        const token = urlParams.get("token");

        formData.append("token", token);
        ApiFacade.validatePassword(formData)
            .then(() => {
                formElement.submit();
            })
            .catch(err => {
                Utils.addErrors(err.errorMessages);
            });
    })
})();