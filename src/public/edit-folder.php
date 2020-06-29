<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Business/FoldersService.php")); 

    $folderService = new FoldersService();
    
    $folderId = $_GET['folderId'];
    $folderName = $_POST['name'];
    $result = $folderService->editFolder($folderId, $folderName);

    header('Location: home.php');
?>