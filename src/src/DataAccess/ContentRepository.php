<?php
    require_once(Config::constructFilePath("/Models/Exceptions/ArchiveCannotOpenException.php"));

    class ContentRepository {
        public function deleteFolder($folderPath) {
            $absoluteFolderPath = $this->getAbsolutePath($folderPath);

            $this->deleteFolderInternal($absoluteFolderPath);
        }

        private function deleteFolderInternal($folderPath) {

            if(file_exists($folderPath)) {
                $items = glob($folderPath . "/*");
                foreach($items as $item) {
                    if(is_file($item)) {
                        unlink($item);
                    } else {
                        $this->deleteFolderInternal($item);
                    }
                }

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

        public function unzipFile($tmpName, $folderPath) {
            
            $fullFolderPath = $this->getAbsolutePath($folderPath);

            if(!file_exists($fullFolderPath)) {
                mkdir($fullFolderPath, 0777, true);
            }

            $zip = new ZipArchive;
            if ($zip->open($tmpName) === TRUE) {
                
                $fileNames = [];
                for ($i = 0; $i < $zip->numFiles; $i++) {
                    
                    $filename = $zip->getNameIndex($i);
                    if (!pathinfo($filename, PATHINFO_EXTENSION)) {
                        continue;
                    }
                
                    $newFileName = pathinfo($filename, PATHINFO_BASENAME);
                    if(file_exists(Utils::combinePaths(array($fullFolderPath, $newFileName)))) {
                        $fileNumber = 1;
                        $newPath = self::generateNewFilePath($newFileName, $fileNumber);
                        while(file_exists($this->getAbsolutePath($newPath))) {
                            $fileNumber++;
                            $newPath = self::generateNewFilePath($newFileName, $fileNumber);
                        }
                        
                        $newFileName = $newPath;
                    }

                    copy("zip://".$tmpName."#".$filename, Utils::combinePaths(array($fullFolderPath, $newFileName)));
                    
                    $newFileName = Utils::combinePaths(array($folderPath, $newFileName));
                    $size = $zip->statIndex($i)['size'];
                    array_push($fileNames, array("filename" => $newFileName, "size" => $size));
                }
                $zip->close();

                return $fileNames;
            } else {
                throw new ArchiveCannotOpenException($tmpName + "cannot be opened!");   
            }
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