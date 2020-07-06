<?php
    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php"));

    session_start();
    if(!Utils::isLoggedIn()) {
        http_response_code(401);
        die();
    }

    if(!isset($_GET["fileId"])) {
        echo "{}";
        die();
    }

    $fileId = $_GET["fileId"];
        
    $filesService = new FilesService();
    $file = $filesService->getFileById($fileId);
    if(is_null($file)) {
        echo "{}";
        die();
    }

    if($file->folder->ownerId != Utils::getUserId()) {
        http_response_code(403);
        echo json_encode(new ErrorResult(["You don't have permissions to view this file."]));
        die();
    }
    
    echo json_encode($file);
?>