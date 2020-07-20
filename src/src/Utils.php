<?php
    class Utils {
        public static function isLoggedIn() {
            return isset($_SESSION["userId"]);
        }

        public static function getUsername() {
            return $_SESSION["username"];
        }

        public static function getUserId() {
            return $_SESSION["userId"];
        }

        public static function redirectIfUnauthorized() {
            if(!Utils::isLoggedIn()) {
                header('Location: login.php?returnUrl='.urlencode($_SERVER['REQUEST_URI']));
            }
        }

        public static function combinePaths($paths) {
            return preg_replace('#/+#', '/', join('/', $paths));
        }

        public static function getAppFullUrl() {
            //This whole function is a joke...
            if(isset($_SERVER['HTTPS'])){
                $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
            }
            else {
                $protocol = 'http';
            }

            $port = $_SERVER['SERVER_PORT'];
            if($port == 80 || $port == 443) {
                $port = "";
            }

            $fullUrl = $protocol . "://" . $_SERVER['SERVER_NAME'] . ':' . $port . self::getAppPath();
            return $fullUrl;
        }

        private static function getAppPath() {
            $split=explode('/', $_SERVER['REQUEST_URI']);
            array_pop($split);
            return implode('/',$split);
        }
    }
?>