<?php
    class Utils {
        public static function isLoggedIn() {
            return isset($_SESSION["username"]);
        }
    }
?>