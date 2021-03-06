<?php
    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Business/LinksService.php")); 
    require_once(Config::constructFilePath("/Models/Entities/File.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php")); 


    function getFileName($filePath) {
        return pathinfo($filePath, PATHINFO_FILENAME) . "." . pathinfo($filePath, PATHINFO_EXTENSION);
    }

    function checkForParameters() {
        if(Utils::isLoggedIn()) {
            if(!isset($_GET["fileId"]) && !isset($_GET["token"])) {
                http_response_code(400);
                echo json_encode(new ErrorResult(["No fileId or token provided!"]));
                die();
            }
        } else {
            if(!isset($_GET["token"])) {
                Utils::redirectIfUnauthorized();
                die();
            }
        }
    }

    function assertFileNotNull($file) {
        if(is_null($file)) {
            echo json_encode(new ErrorResult(["No file found!"]));
            die();
        }
    }

    session_start();
    checkForParameters();
    $filesService = new FilesService();

    if(isset($_GET["fileId"])) {
        $file = $filesService->getFileById($_GET["fileId"]);

        assertFileNotNull($file);

        if($file->folder->ownerId != Utils::getUserId()) {
            http_response_code(403);
            die();
        }
    } else {
        $linksService = new LinksService();
        $file = $linksService->getFileByToken($_GET["token"]);
        assertFileNotNull($file);
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