<?php
    if($_SERVER["REQUEST_METHOD"] != "GET") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Models/Dto/SearchQuery.php")); 
    session_start();

    if(!Utils::isLoggedIn()) {
        http_response_code(401);
        die();
    }

    $folderId = $_GET['folderId'];

    $searchQuery = new SearchQuery();
    if(isset($_GET['searchValue'])) {
        $searchQuery->searchValue = $_GET['searchValue']; 
    }
    if(isset($_GET['start'])) {
        $searchQuery->start = $_GET['start']; 
    }
    if(isset($_GET['count'])) {
        $searchQuery->count = $_GET['count']; 
    }

    $filesService = new FilesService();
    
    $filesSerialized = [];
    $files = $filesService->getFiles($folderId, $searchQuery, $_SESSION["userId"]);
    for ($i=0; $i < count($files); $i++) { 
        array_push($filesSerialized, $files[$i]->jsonSerialize());
    }
    echo json_encode($filesSerialized);
?>