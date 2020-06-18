(() => {
    const formElement = document.getElementById("register-form");

    formElement.addEventListener("submit", ev => {
        ev.preventDefault();
        const userData = Utils.parseFormDataToObject(new FormData(formElement));

        ApiFacade.registerUser(userData)
            .then(result => console.log(result))
            .catch(err => {
                for (message of err.errorMessages) {
                    Utils.addError(message);
                }
            });
    })

})();