<?php
    if($_SERVER["REQUEST_METHOD"] != "DELETE") {
        http_response_code(405);
        die();
    }
    
    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    session_start();
    
    $filesService = new FilesService();
    $fileId = $_GET['fileId'];
    $result = $filesService->deleteFile($fileId);
    echo json_encode($result);
?>