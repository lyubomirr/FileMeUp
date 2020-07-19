<?php
    if($_SERVER["REQUEST_METHOD"] != "GET") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Models/Dto/SearchQuery.php")); 
    require_once(Config::constructFilePath("/Models/Exceptions/UnauthorizedException.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php")); 

    session_start();
    Utils::redirectIfUnauthorized();

    if(!isset($_GET["folderId"])) {
        http_response_code(400);
        echo json_encode(new ErrorResult(["No folder id provided!"]));
        die();
    }

    $folderId = $_GET['folderId'];

    $filesService = new FilesService();
    $searchQuery = new SearchQuery();

    try {
        $files = $filesService->getFilesByFolder($folderId, Utils::getUserId());
    } catch(UnauthorizedException $ex) {
        echo json_encode(new ErrorResult([$ex->getMessage()]));
        die();
    }

    header("Content-disposition: attachment; filename=" . "folder-" . $folderId . ".json");
    header("Content-Type: application/json");
    echo json_encode($files);
?>