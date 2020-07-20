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

    static postFormData(endpointPath, formData) {
        return new Promise((resolve, reject) => {
            fetch(endpointPath, {
                    method: "POST",
                    body: formData
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


    static delete(endpointPath, queryParams) {
        const path = this.constructPath(endpointPath, queryParams);

        return new Promise((resolve, reject) => {
            fetch(path, {
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
        if (searchQuery) {
            return this.get("get-folders.php", {
                searchValue: searchQuery.searchValue,
                start: searchQuery.start,
                count: searchQuery.count
            });
        }
        return this.get("get-folders.php", {});
    }

    static getFiles(folderId, searchQuery) {
        if (searchQuery) {
            return this.get("get-files.php", {
                folderId,
                folderId,
                searchValue: searchQuery.searchValue,
                start: searchQuery.start,
                count: searchQuery.count
            });
        }
        return this.get("get-files.php", { folderId, folderId });
    }

    static deleteFolder(folderId) {
        return this.delete("delete-folder.php", { folderId: folderId });
    }

    static getFileById(fileId) {
        return this.get("get-file.php", { fileId: fileId });
    }

    static getFileByToken(token) {
        return this.get("get-file-with-token.php", { token: token });
    }

    static deleteFile(fileId) {
        return this.delete("delete-file.php", { fileId: fileId });
    }

    static getFolderById(folderId) {
        return this.get("get-folder-by-id.php", { folderId: folderId });
    }

    static uploadFile(fileFormData) {
        return this.postFormData("add-file.php", fileFormData);
    }

    static validatePassword(formData) {
        return this.postFormData("validate-link-password.php", formData);
    }
}