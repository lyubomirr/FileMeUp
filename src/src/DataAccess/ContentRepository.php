<?php
    class ContentRepository {
        public function deleteFolder($path) {
            $folderPath = $this->getAbsolutePath($path);
            if(file_exists($folderPath)) {
                rmdir($folderPath);
            }
        }

        private function getAbsolutePath($filePath) {
            return Utils::combinePaths(array(Config::getUploadsPath(), $filePath));
        }

        public function addFile($tmpName, $filePath) {

            if(file_exists($this->getAbsolutePath($filePath))) {
                $fileNumber = 1;
                $newPath = self::generateNewFilePath($filePath, $fileNumber);
                while(file_exists($this->getAbsolutePath($newPath))) {
                    $fileNumber++;
                    $newPath = self::generateNewFilePath($filePath, $fileNumber);
                }
                
                $filePath = $newPath;
            }

            $fullFilePath = $this->getAbsolutePath($filePath);
            $fileDirPath = dirname($fullFilePath);

            if(!file_exists($fileDirPath)) {
                mkdir($fileDirPath, 0777, true);
            }

            move_uploaded_file($tmpName, $fullFilePath);
            return $filePath;
        }

        private static function generateNewFilePath($filePath, $number) {
            $pathInfo = pathinfo($filePath);
            $newPath = $pathInfo['dirname'].'/'.$pathInfo['filename']."({$number})".".".$pathInfo['extension'];
            return $newPath;
        }

        public function getFile($filePath) {
            $fullFilePath = $this->getAbsolutePath($filePath);
            file_get_contents($fullFilePath);
        }

        public function deleteFile($filePath) {
            $fullFilePath = $this->getAbsolutePath($filePath);
            if(file_exists($fullFilePath)) {
                unlink($fullFilePath);
            }
        }

        public function getFileLocation($filePath) {
            return $this->getAbsolutePath($filePath);
        }
    }
?>