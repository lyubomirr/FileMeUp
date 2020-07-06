<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Business/FoldersService.php")); 
    session_start();

    $folderService = new FoldersService();
    
    $folderId = $_GET['folderId'];
    $folderName = json_decode(file_get_contents('php://input'), true);
    $result = $folderService->editFolder($folderId, $folderName);

    echo json_encode($result);
?>