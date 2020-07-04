<?php
    class Utils {
        public static function isLoggedIn() {
            return isset($_SESSION["username"]);
        }

        public static function getUsername() {
            return $_SESSION["username"];
        }

        public static function checkSession() {
            if(!Utils::isLoggedIn()) {
                header('Location: login.php');
            }
        }
    }
?>