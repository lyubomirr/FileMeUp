<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Files - FileMeUp</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php
        require_once("templates/header.php");
    ?>
        <main class="container">
            <section class="app-main">
                <div class="row">
                    <input class="main-input w-100 h-100" id="search-input" type="search" placeholder="Search">
                </div>
                <hr>
                <div class="files-root">
                    <div class="information-row">
                        <h3 class="heading files-heading">Files</h3>
                        <span>
                            <i class="fas fa-plus-square add-icon" title="Add file"></i>
                        </span>
                    </div>
                    <div class="grid" id="files-grid">
                        
                    </div>
                </div>
            </section>  
        </main>
        <script type="text/javascript" src="js/files.js"></script>
        <script type="text/javascript" src="js/api/ApiFacade.js"></script>
        <script>
            insertFiles(<?php echo $_GET['folderId']; ?>)
        </script>
</body>

</html>