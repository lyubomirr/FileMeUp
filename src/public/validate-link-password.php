<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Exceptions/AuthenticationException.php")); 
    require_once(Config::constructFilePath("/Models/Dto/LinkSettings.php")); 
    require_once(Config::constructFilePath("/Business/LinksService.php")); 
    session_start();

    $linksService = new LinksService();
    $token = $_POST["token"];

    if (isset($_POST["password"])) {
        $linkPassword = $_POST["password"];
        
        try {
            $linksService->validatePassword($token, $linkPassword);
            echo json_encode(true);

        } catch (AuthenticationException $ex) {
            echo json_encode(
                new ErrorResult([$ex->getMessage()])
            );
        }
    }
?>