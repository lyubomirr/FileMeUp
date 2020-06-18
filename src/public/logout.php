<?php
    if($_SERVER["REQUEST_METHOD"] != "POST") {
        http_response_code(405);
        die();
    }

    session_start();
    session_unset();

    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0,
        $params["path"], 
        $params["domain"],
        $params["secure"], 
        $params["httponly"]
    );

    session_destroy();
    header("Location: login.php");
?>
