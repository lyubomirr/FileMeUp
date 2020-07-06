<?php

    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Models/Entities/File.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php")); 

    session_start();
    if(!Utils::isLoggedIn()) {
        http_response_code(401);
        die();
    }

    if(!isset($_GET["fileId"])) {
        die();
    }

    $fileId = $_GET["fileId"];
    $isDownload = isset($_GET["download"]) && is_bool($_GET["download"]) ? $_GET["download"] : false;
    
    $filesService = new FilesService();
    $file = $filesService->getFileById($fileId);
    if(is_null($file)) {
        echo json_encode(new ErrorResult(["No file with correspoding id!"]));
        die();
    }
    
    if($file->folder->ownerId != $_SESSION["userId"]) {
        http_response_code(403);
        die();
    }

    //TODO:SHOW FILE
?>