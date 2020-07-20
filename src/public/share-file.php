<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Dto/LinkSettings.php")); 
    require_once(Config::constructFilePath("/Business/LinksService.php")); 
    require_once(Config::constructFilePath("/Validation/LinkValidator.php")); 
    session_start();
    
    $fileId = $_GET['fileId'];
    
    $linkSettings = LinkSettings::fromAssociativeArray($_POST);
    $linkSettings->fileId = $fileId;
    
    $validationErrors = LinkValidator::validateLink($linkSettings);
    if(count($validationErrors) > 0) {
        echo json_encode(new ErrorResult($validationErrors));
        die();
    }
    
    $linksService = new LinksService();
    $link = $linksService->generateLink($linkSettings);

    echo json_encode($link);
?>