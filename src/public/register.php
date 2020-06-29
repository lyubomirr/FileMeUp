<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FileMeUp</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <main>
        <section id="success-section" class="section shadow">
            <h1>You have registered your user account successfully!</h1>
            <p>
                <a href="login.php" class="link">Go to login page</a>
            </p>
        </section>
        <section class="section form-section shadow" id="register-form-section">
            <h2>Register</h2>
            <section>
                <ul id="error-list">
                </ul>
            </section>
            <form action="register.php" method="post" id="register-form">
                <div class="form-group">
                    <label for="username">
                        <span class="label-value">Username</span>
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="username" id="username" maxlength="50" required />
                </div>
                <div class="form-group">
                    <label for="email">
                        <span class="label-value">Email</span>
                    </label>
                    <input type="email" name="email" id="email" maxlength="100"/>
                </div>
                <div class="form-group">
                    <label for="password">
                        <span class="label-value">Password</span>
                        <span class="required">*</span>
                    </label>
                    <input type="password" name="password" id="password" minlength="8"  maxlength="100" required/>
                </div>
                <div class="form-group">
                    <label for="passwordConfirmation">
                        <span class="label-value">Confirm password</span>
                        <span class="required">*</span>
                    </label>
                    <input type="password" name="passwordConfirmation" id="passwordConfirmation" minlength="8" maxLength="100" required/>
                </div>
                <div class="form-group aligncenter btn-form-group">
                    <input type="submit" value="Register" class="btn btn-primary w-100" />
                </div>
            </form>
        </section>
    </main>
    <script src="js/Utils.js" type="text/javascript"></script>
    <script src="js/api/ApiFacade.js" type="text/javascript"></script>
    <script src="js/register.js" type="text/javascript"></script>
</body>

</html>