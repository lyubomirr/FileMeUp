<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View file from link - FileMeUp</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
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
                    <dt>Shared by</dt>
                    <dd id="shared-by"></dd>
                    
                </dl>
                <button class="btn btn-normal btn-primary" id="download-button">
                    <i class="fa fa-download" aria-hidden="true"></i>Download
                </button>

            </section>
            <section id="file-view-section">
            </section>
        </section>
    </main>
    <script src="js/Utils.js" type="text/javascript"></script>
    <script src="js/api/ApiFacade.js" type="text/javascript"></script>
    <script src="js/viewFileFromLink.js" type="text/javascript"></script>
</body>

</html>