<?php
    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/LinksService.php")); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php"));
    require_once(Config::constructFilePath("/Models/Dto/ContentMimeTypeFile.php"));
        
    $LinksService = new LinksService();

    $token = $_GET["token"];
    $file = $LinksService->getFileByToken($token);
    if(is_null($file)) {
        echo "{}";
        die();
    }

    $filesService = new FilesService();
    $fullPath = $filesService->getFileFullPath($file->location);
    $fileWithMimeType = new ContentMimeTypeFile($file);
    $fileWithMimeType->mimeType = mime_content_type($fullPath);

    echo json_encode($fileWithMimeType); 
?>