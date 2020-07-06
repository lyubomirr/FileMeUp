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
    <title>View file - FileMeUp</title>
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php
        require_once("templates/header.php");
    ?>
    <main class="container-large">
        <section class="app-main section border">
            <h1 class="heading" id="file-name"></h1>
            <section id="file-info-section">
                <dl>
                    <dt>Description</dt>
                    <dd id="description"></dd>
                    <dt>Size</dt>
                    <dd id="size"></dd>
                    <dt>Extension</dt>
                    <dd id="extension"></dd>
                    <dt>Store date</dt>
                    <dd id="store-date"></dd>
                    <dt>Last modified date</dt>
                    <dd id="last-modified-date"></dd>
                    
                </dl>
            </section>
            <section id="file-view-section">
            </section>
        </section>
    </main>
    <script src="js/Utils.js" type="text/javascript"></script>
    <script src="js/api/ApiFacade.js" type="text/javascript"></script>
    <script src="js/viewFile.js" type="text/javascript"></script>
</body>

</html>