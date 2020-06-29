class Utils {
    static parseFormDataToObject(formData) {
        const obj = {};
        formData.forEach((value, key) => { obj[key] = value });
        return obj;
    }
    static addErrors(errorMessages) {
        const errorList = document.getElementById("error-list");
        errorList.innerHTML = "";

        for (let message of errorMessages) {
            const errorItem = document.createElement("li");
            errorItem.append(message);
            errorList.appendChild(errorItem);
        }

        window.scrollTo(0, 0);
    }
}