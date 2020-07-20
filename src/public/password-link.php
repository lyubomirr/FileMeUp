<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link - FileMeUp</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <main>
        <section class="section form-section shadow" id="password-form-section">
            <h2>Password needed</h2>
            <section>
                <ul id="error-list">
                </ul>
            </section>
            <form method="post" id="password-form">
                <div class="form-group">
                    <label for="password">
                        <span class="label-value">Password</span>
                        <span class="required">*</span>
                    </label>
                    <input type="password" name="password" id="password" required/>
                </div>
                <div class="form-group aligncenter btn-form-group">
                    <input type="submit" value="Check password" class="btn btn-primary btn-normal w-100" />
                </div>
            </form>
        </section>
    </main>
    <script src="js/Utils.js" type="text/javascript"></script>
    <script src="js/api/ApiFacade.js" type="text/javascript"></script>
    <script src="js/linkPasswordValidation.js" type="text/javascript"></script>
</body>

</html>