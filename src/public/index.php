<?php
    require_once("templates/imports.php");
    session_start();

    if(Utils::isLoggedIn()) {
        //Go to docs page.
    }
    else {
        header('Location: login.php');
    }
?>