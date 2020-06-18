<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Dto/SearchQuery.php")); 
    require_once(Config::constructFilePath("/Business/FoldersService.php")); 

    $searchQuery = SearchQuery::fromJson(file_get_contents('php://input'));
    $folderService = new FoldersService();
    
    $folders = $folderService->getFolders($searchQuery);
    echo json_encode($folders);
?>