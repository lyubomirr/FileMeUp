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
    <title>Home - FileMeUp</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <?php
        require_once("templates/header.php");
    ?>
        <main class="container">
            <section class="app-main">
                <div>
                    <input class="main-input w-100 h-100" id="search-input" type="search" placeholder="Search">
                </div>
                <hr>
                <div class="folders-root section border">
                    <div class="information-row">
                        <h3 class="heading folders-heading">Folders</h3>
                        <i class="fas fa-plus-square add-icon" title="Add folder"></i>
                    </div>
                    <div>
                        <table class="table" id="folders_table">
                        </table>
                    </div>
                </div>
                <?php
                    require_once("templates/modal.php");
                    require_once("templates/confirmModal.php");
                ?>
            </section>  
        </main>

        <script type="text/javascript" src="js/searchQuery.js"></script>
        <script type="text/javascript" src="js/Utils.js"></script>
        <script type="text/javascript" src="js/api/ApiFacade.js"></script>
        <script type="text/javascript" src="js/confirmModal.js"></script>
        <script type="text/javascript" src="js/formModal.js"></script>
        <script type="text/javascript" src="js/folders.js"></script>
</body>

</html>