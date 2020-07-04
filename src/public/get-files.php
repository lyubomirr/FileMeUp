<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php"); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 

    $folderId = json_decode(file_get_contents('php://input'));
    $filesService = new FilesService();
    
    $filesSerialized = [];
    $files = $filesService->getFiles($folderId);
    for ($i=0; $i < count($files); $i++) { 
        array_push($filesSerialized, $files[$i]->jsonSerialize());
    }
    echo json_encode($filesSerialized);
?>