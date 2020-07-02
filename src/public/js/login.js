(() => {
    const formElement = document.getElementById("login-form");

    formElement.addEventListener("submit", ev => {
        ev.preventDefault();
        const userData = Utils.parseFormDataToObject(new FormData(formElement));

        ApiFacade.login(userData)
            .then(() => {
                window.location = "home.php";
            })
            .catch(err => {
                Utils.addErrors(err.errorMessages);
            });
    })
})();