<?php
    class Utils {
        public static function isLoggedIn() {
            return isset($_SESSION["userId"]);
        }

        public static function getUsername() {
            return $_SESSION["username"];
        }

        public static function redirectIfUnauthorized() {
            if(!Utils::isLoggedIn()) {
                header('Location: login.php?returnUrl='.urlencode($_SERVER['REQUEST_URI']));
            }
        }

        public static function combinePaths($paths) {
            return preg_replace('#/+#', '/', join('/', $paths));
        }
    }
?>