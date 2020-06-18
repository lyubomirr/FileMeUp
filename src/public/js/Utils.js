class Utils {
    static parseFormDataToObject(formData) {
        const obj = {};
        formData.forEach((value, key) => { obj[key] = value });
        return obj;
    }

    static addError(errorMsg) {
        const errorList = document.getElementById("error-list");
        const errorItem = document.createElement("li");

        errorItem.append(errorMsg);
        errorList.appendChild(errorItem);

        window.scrollTo(0, 0);
    }
}