<?php
    class ContentRepository {
        private $storagePath;
        private $storageName = "FileMeUpStorage";

        public function __construct(){
            $this->storagePath = Utils::combinePaths(array($_SERVER["DOCUMENT_ROOT"], $this->storageName));
        }

        public function addFolder($url) {
            $folderPath = Utils::combinePaths(array($this->storagePath, $url));
            mkdir($folderPath);
        }

        public function deleteFolder($url) {
            $folderPath = Utils::combinePaths(array($this->storagePath, $url));
            rmdir($folderPath);
        }

        public function addUploadedFile($url) {
            $fileName = pathinfo($url, PATHINFO_FILENAME);
            $filePath = Utils::combinePaths(array($this->storagePath, $url));

            move_uploaded_file($fileName, $filePath);
        }

        public function getFile($url) {
            $filePath = Utils::combinePaths(array($this->storagePath, $url));
            file_get_contents($filePath);
        }

        public function updateFile($url, $fileName) {
            $filePath = Utils::combinePaths(array($this->storagePath, $url));
        }

        public function deleteFile($url) {
            $filePath = Utils::combinePaths(array($this->storagePath, $url));
            unlink($filePath);
        }

        public function getFileLocation($url) {
            return Utils::combinePaths(array($this->storageName, $url));
        }
    }
?>