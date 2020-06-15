<?php
    class Config {
        public const DB_HOST = "localhost";
        public const DB_NAME = "db";
        public const DB_USER = "admin";
        public const DB_PASS = "admin";

        public static function constructFilePath($phpFilePath) {
            if(substr($phpFilePath, 0, 1) != "/") {
                $phpFilePath = "/" . $phpFilePath;
            }
            
            return $_SERVER["DOCUMENT_ROOT"] . "/src" . $phpFilePath;
        }
    }
?>