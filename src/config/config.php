<?php
    class Config {
        public const DB_HOST = "localhost";
        public const DB_NAME = "filemeup";
        public const DB_USER = "root";
        public const DB_PASS = "";

        public static function constructFilePath($phpFilePath) {
            if(substr($phpFilePath, 0, 1) != "/") {
                $phpFilePath = "/" . $phpFilePath;
            }
            
            return $_SERVER["DOCUMENT_ROOT"] . "/src" . $phpFilePath;
        }
    }
?>