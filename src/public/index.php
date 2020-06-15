<?php
    require_once("templates/globals.php");
    session_start();

    if(Utils::isLoggedIn()) {
        //Go to docs page.
    }
    else {
        header('Location: login.php');
    }
?>