<?php
    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 

    if(!isset($_GET["fileId"])) {
        echo "{}";
        die();
    }

    $fileId = $_GET["fileId"];
    
    $filesService = new FilesService();
    $file = $filesService->getFileById($fileId);
    if(is_null($file)) {
        echo "{}";
        die();
    }
    
    echo json_encode($file);
?>