<?php
    require_once("templates/globals.php");
    session_start();

    if(Utils::isLoggedIn()) {
        header('Location: home.php');
    }
    else {
        header('Location: login.php');
    }
?>