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
            
            return __DIR__ . "/src" . $phpFilePath;
        }

        public static function getUploadsPath() {
            return __DIR__ . "/storage";
        }
    }
?>