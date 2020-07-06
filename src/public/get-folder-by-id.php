<?php
    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Business/FoldersService.php")); 
    require_once(Config::constructFilePath("/Models/Entities/Folder.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php")); 

    session_start();

    if(!Utils::isLoggedIn()) {
        http_response_code(401);
        die();
    }

    if(!isset($_GET["folderId"])) {
        echo "{}";
        die();
    }


    $folderService = new FoldersService();
    $folder = $folderService->getById($_GET["folderId"]);

    if(is_null($folder)) {
        echo "{}";
        die();
    }

    if($folder->ownerId != Utils::getUserId()) {
        http_response_code(403);
        echo json_encode(new ErrorResult(["You dont have permissions to access this folder."]));
        die();
    }

    echo json_encode($folder);
?>