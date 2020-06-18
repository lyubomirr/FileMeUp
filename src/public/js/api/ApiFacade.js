class ApiFacade {
    static get(endpointPath) {
        return new Promise((resolve, reject) => {
            fetch(endpointPath)
                .then(response => response.json())
                .then(jsonResponse => {
                    if (jsonResponse.hasOwnProperty("errorMessages")) {
                        reject(jsonResponse);
                    }
                })
                .then(result => resolve(result))
                .catch(err => reject(err));
        })
    }

    static post(endpointPath, body) {
        return new Promise((resolve, reject) => {
            fetch(endpointPath, {
                    method: "POST",
                    body: JSON.stringify(body),
                    headers: {
                        "Content-type": "application/json; charset=UTF-8"
                    }
                })
                .then(response => response.json())
                .then(jsonResponse => {
                    if (jsonResponse.hasOwnProperty("errorMessages")) {
                        reject(jsonResponse);
                    }
                })
                .then(result => resolve(result))
                .catch(err => reject(err));
        })
    }

    static registerUser(userData) {
        return this.post("add-registration.php", userData);
    }
}