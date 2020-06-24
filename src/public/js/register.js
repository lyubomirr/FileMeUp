(() => {
    const formElement = document.getElementById("register-form");

    formElement.addEventListener("submit", ev => {
        ev.preventDefault();
        const userData = Utils.parseFormDataToObject(new FormData(formElement));

        ApiFacade.registerUser(userData)
            .then(() => {
                const formSection = document.getElementById("register-form-section");
                const successSection = document.getElementById("success-section");

                formSection.style.display = "none";
                successSection.style.display = "block";
            })
            .catch(err => {
                Utils.addErrors(err.errorMessages);
            });
    })

})();