<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    require_once("templates/globals.php");
    require_once(Config::constructFilePath("/Models/Dto/UserLogin.php")); 
    require_once(Config::constructFilePath("/Models/Dto/SuccessfulCommandResult.php")); 
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php")); 
    require_once(Config::constructFilePath("/Models/Exceptions/AuthenticationException.php")); 
    require_once(Config::constructFilePath("/Business/UsersService.php")); 

    $login = UserLogin::fromJson(file_get_contents('php://input'));
    $userService = new UsersService();
    
    try {
        $userService->login($login);
        
        session_start();
        $_SESSION["username"] = $login->username;

        echo json_encode(new SuccessfulCommandResult(true));

    } catch(AuthenticationException $ex) {
        echo json_encode(
            new ErrorResult([$ex->getMessage()])
        );
    }
?>