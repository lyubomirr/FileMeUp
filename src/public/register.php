<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FileMeUp</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <main>
        <section class="form-section shadow" id="register-form-section">
            <h2>Register</h2>
            <section>
                <ul id="error-list">
                </ul>
            </section>
            <form class="flex" action="index.html" method="post" id="register-form">
                <div class="form-group">
                    <label for="username">
                        <span class="label-value">Username</span>
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="username" id="username" required/>
                </div>
                <div class="form-group">
                    <label for="email">
                        <span class="label-value">Email</span>
                    </label>
                    <input type="email" name="email" id="email"/>
                </div>
                <div class="form-group">
                    <label for="password">
                        <span class="label-value">Password</span>
                        <span class="required">*</span>
                    </label>
                    <input type="password" name="password" id="password" required/>
                </div>
                <div class="form-group">
                    <label for="confirm-password">
                        <span class="label-value">Confirm password</span>
                        <span class="required">*</span>
                    </label>
                    <input type="password" name="confirm-password" id="confirm-password" required/>
                </div>
                <div class="form-group aligncenter btn-form-group">
                    <input type="submit" value="Register" class="btn btn-primary w-100" />
                </div>
            </form>
        </section>
    </main>
</body>

</html>