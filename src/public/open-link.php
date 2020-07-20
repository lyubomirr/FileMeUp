<?php

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Exceptions/AuthenticationException.php")); 
    require_once(Config::constructFilePath("/Business/LinksService.php")); 
    
    $linksService = new LinksService();
    if(!isset($_GET["token"])) {
        echo json_encode(new ErrorResult(["No token provided!"]));
        http_response_code(400);
        die();
    }
    $token = $_GET["token"];

    if (isset($_POST["password"])) {
        $linkPassword = $_POST["password"];
        
        try {
            $linksService->validatePassword($token, $linkPassword); 
            require_once("view-file-from-link.php");

        } catch (AuthenticationException $ex) {
            echo json_encode(
                new ErrorResult([$ex->getMessage()])
            );
        }

        return;
    }

    $link = $linksService->getLink($token);
    if(is_null($link)) {
        http_response_code(404);
        die();
    }

    if (trim($link->password) === '') {
        require_once("view-file-from-link.php");
    } else {
        require_once("password-link.php");
    }
?>