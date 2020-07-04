<?php
    if($_SERVER["REQUEST_METHOD"] != "DELETE") {
        http_response_code(405);
        die();
    }
    echo "123";
    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Business/FoldersService.php")); 
    session_start();
    
    $folderService = new FoldersService();
    $folderId = $_GET['folderId'];
    $result = $folderService->deleteFolder($folderId);
    echo json_encode($result);
?>