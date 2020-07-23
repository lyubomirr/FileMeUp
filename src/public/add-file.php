<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Entities/File.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php"));
    require_once(Config::constructFilePath("/Models/Dto/SuccessfulCommandResult.php")); 
    require_once(Config::constructFilePath("/Business/FilesService.php")); 
    require_once(Config::constructFilePath("/Validation/FileValidator.php")); 
    
    session_start();

    if(!Utils::isLoggedIn()) {
        http_response_code(401);
        die();
    }

    $validationErrors = [];

    if(!isset($_FILES["file"])) {
        array_push($validationErrors, "Please upload file.");
    }

    $shouldBeUnziped = false;
    if (isset($_POST["unzip"])) {
        $shouldBeUnziped = true;
    }

    $fileEntity = File::fromAssociativeArray($_POST);
    $validationErrors = FileValidator::validateFile($fileEntity);
    if(count($validationErrors) > 0) {
        echo json_encode(new ErrorResult($validationErrors));
        die();
    }

    $filesService = new FilesService();
    $filesService->addFile(Utils::getUserId(), $fileEntity, $_FILES["file"], $shouldBeUnziped);
    echo json_encode(new SuccessfulCommandResult());
?>