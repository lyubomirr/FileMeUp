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
    <script type="text/javascript" src="js/api/ApiFacade.js" defer></script>
    <script type="text/javascript" src="js/folderModal.js" defer></script>
    <script type="module" src="js/folders.js" defer></script>
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
                        <span>
                            <i class="fas fa-plus-square add-icon" title="Add folder"></i>
                        </span>
                    </div>
                    <div>
                        <table class="table" id="folders_table">
                        </table>
                    </div>
                </div>
                <?php
                    require_once("templates/modal.php");
                ?>
            </section>  
        </main>
</body>

</html>