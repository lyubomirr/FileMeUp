(() => {
    const formElement = document.getElementById("login-form");

    formElement.addEventListener("submit", ev => {
        ev.preventDefault();
        const userData = Utils.parseFormDataToObject(new FormData(formElement));

        ApiFacade.login(userData)
            .then(() => {
                const urlParams = new URLSearchParams(window.location.search);
                const returnUrl = urlParams.get("returnUrl");
                window.location = returnUrl ? returnUrl : "home.php";
            })
            .catch(err => {
                Utils.addErrors(err.errorMessages);
            });
    })
})();