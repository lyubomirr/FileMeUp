<?php

    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Dto/UserRegistration.php")); 
    require_once(Config::constructFilePath("/Business/UsersService.php")); 

    $registration = UserRegistration::fromJson(file_get_contents('php://input'));
    $userService = new UsersService();
    $userService->registerUser($registration);
?>