<?php
    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Models/Entities/File.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php")); 


    function getFileName($filePath) {
        return pathinfo($filePath, PATHINFO_FILENAME) . "." . pathinfo($filePath, PATHINFO_EXTENSION);
    }

    session_start();
    Utils::redirectIfUnauthorized();

    if(!isset($_GET["fileId"])) {
        http_response_code(400);
        die();
    }

    $fileId = $_GET["fileId"];

    $filesService = new FilesService();
    $file = $filesService->getFileById($fileId);
    if(is_null($file)) {
        echo json_encode(new ErrorResult(["No file with correspoding id!"]));
        die();
    }
    
    if($file->folder->ownerId != Utils::getUserId()) {
        http_response_code(403);
        die();
    }

    if(isset($_GET["download"]) && filter_var($_GET["download"], FILTER_VALIDATE_BOOLEAN)) {
        header("Content-disposition: attachment; filename=" . getFileName($file->location));
    } else {
        header("Content-disposition: inline; filename=\"" . getFileName($file->location));
    }

    $fullPath = $filesService->getFileFullPath($file->location);
    header("Content-Type: " . mime_content_type($fullPath));
    echo readfile($fullPath);
?>