<?php
    require_once("templates/globals.php");
    session_start();
    Utils::redirectIfUnauthorized();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload file - FileMeUp</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php
        require_once("templates/header.php");
    ?>
    <main>
        <section class="app-main section border form-section" id="upload-file-form-section">
            <h2>
                <i class="fa fa-chevron-circle-left back-icon" aria-hidden="true"></i>
                Upload new file
            </h2>
            <section>
                <ul id="error-list">
                </ul>
            </section>
            <form id="upload-file-form">
                <div class="form-group">
                    <label for="file">
                        <span class="label-value">File</span>
                        <span class="required">*</span>
                    </label>
                    <input type="file" name="file" id="file" required />
                </div>
                <div class="form-group">
                    <label for="name">
                        <span class="label-value">Name</span>
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="name" id="name" maxlength="100" required></input>
                </div>
                <div class="form-group">
                    <label for="description">
                        <span class="label-value">Description</span>
                    </label>
                    <textarea name="description" id="description" maxlength="255" resi></textarea>
                </div>
                <div class="form-group aligncenter btn-form-group">
                    <input type="submit" value="Upload" class="btn btn-primary w-100 btn-normal" />
                </div>
            </form>
        </section>


    </main>
    <script src="js/Utils.js" type="text/javascript"></script>
    <script src="js/api/ApiFacade.js" type="text/javascript"></script>
    <script src="js/uploadFile.js" type="text/javascript"></script>
</body>

</html>