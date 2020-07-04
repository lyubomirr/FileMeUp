class ApiFacade {
    static get(endpointPath, queryParams) {
        const path = this.constructPath(endpointPath, queryParams);

        return new Promise((resolve, reject) => {
            fetch(path)
                .then(response => response.json())
                .then(jsonResponse => {
                    if (jsonResponse.hasOwnProperty("errorMessages")) {
                        reject(jsonResponse);
                    } else {
                        resolve(jsonResponse);
                    }
                })
                .catch(err => reject(err));
        })
    }

    static constructPath(endpointPath, queryParams) {
        const searchParams = new URLSearchParams("");
        for (const [key, value] of Object.entries(queryParams)) {
            searchParams.set(key, value);
        }

        return endpointPath + "?" + searchParams.toString();
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
                    } else {
                        resolve(jsonResponse);
                    }
                })
                .catch(err => reject(err));
        })
    }

    static delete(endpointPath) {
        return new Promise((resolve, reject) => {
            fetch(endpointPath, {
                    method: "DELETE"
                })
                .then(response => response.json())
                .then(jsonResponse => {
                    if (jsonResponse.hasOwnProperty("errorMessages")) {
                        reject(jsonResponse);
                    } else {
                        resolve(jsonResponse);
                    }
                })
                .catch(err => reject(err));
        })
    }

    static registerUser(userData) {
        return this.post("add-registration.php", userData);
    }

    static login(userData) {
        return this.post("post-login.php", userData);
    }

    static getFolders(searchQuery) {
        return this.post("get-folders.php", searchQuery);
    }

    static getFiles(folderId) {
        return this.post("get-files.php", folderId);
    }

    static getFileById(fileId) {
        return this.get("get-file.php", { fileId: fileId });
    }
}