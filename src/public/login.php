<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FileMeUp</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <main>
        <section class="form-section shadow" id="login-form-section">
            <h2>Login</h2>
            <section>
                <ul id="error-list">
                </ul>
            </section>
            <form action="index.html" method="post" id="login-form">
                <div class="form-group">
                    <label for="username">
                        <span class="label-value">Username</span>
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="username" id="username" required/>
                </div>
                <div class="form-group">
                    <label for="password">
                        <span class="label-value">Password</span>
                        <span class="required">*</span>
                    </label>
                    <input type="password" name="password" id="password" required/>
                </div>
                <div class="form-group aligncenter btn-form-group">
                    <input type="submit" value="Login" class="btn btn-primary w-100" />
                    <p>
                        Don't have an account? <a href="register.php" id="register-link">Register here.</a>
                    </p>
                </div>
            </form>
        </section>
    </main>
</body>

</html>