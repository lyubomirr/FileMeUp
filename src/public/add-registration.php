<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Dto/UserRegistration.php")); 
    require_once(Config::constructFilePath("/Business/UsersService.php")); 
    require_once(Config::constructFilePath("/Validation/UserRegistrationValidator.php")); 

    $registration = UserRegistration::fromJson(file_get_contents('php://input'));
    $validationErrors = UserRegistrationValidator::validateUserRegistration($registration);
    if(count($validationErrors) > 0) {
        echo json_encode(new ErrorResult($validationErrors));
        die();
    }

    $userService = new UsersService();
    $result = $userService->registerUser($registration);
    echo json_encode($result);
?>