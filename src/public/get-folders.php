<?php
    if($_SERVER["REQUEST_METHOD"] != "GET") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Dto/SearchQuery.php")); 
    require_once(Config::constructFilePath("/Business/FoldersService.php")); 
    session_start();

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
    
    $folderService = new FoldersService();
    
    $foldersSerialized = [];
    $folders = $folderService->getFolders($searchQuery);
    for ($i=0; $i < count($folders); $i++) { 
        array_push($foldersSerialized, $folders[$i]->jsonSerialize());
    }

    echo json_encode($foldersSerialized);
?>