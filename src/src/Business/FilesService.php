<?php 
    require_once(Config::constructFilePath("/Models/Entities/File.php"));
    require_once(Config::constructFilePath("/DataAccess/FileRepository.php"));
    require_once(Config::constructFilePath("/DataAccess/FolderRepository.php"));
    require_once(Config::constructFilePath("/Models/Dto/FileBaseResult.php"));

    class FilesService {
        private $fileRepository;
        private $folderRepository;

        public function __construct()
        {
            $this->fileRepository = new FileRepository();
            $this->folderRepository = new FolderRepository();
        }

        private function getThumbnail($filePath)
        {
            $serverPath = $_SERVER["DOCUMENT_ROOT"];
            $filePath = $serverPath . "/" . $filePath;

            $folderPath = pathinfo($filePath, PATHINFO_DIRNAME);
            $filenameNoExt = pathinfo($filePath, PATHINFO_FILENAME);
            $thumbnailName = $filenameNoExt . "_thumb" . ".png";
            
            $im = new Imagick($filePath);
            $im->setImageFormat("png");
            $im->thumbnailImage(200, 150, true, true); 

            $thumbnailPath = $folderPath . "/" . $thumbnailName;
            $im->writeImage($thumbnailPath);
            $im->clear(); 
            $im->destroy(); 

            return $thumbnailPath;
        }

        public function getFiles($folderId) {
            //$userId = $_SESSION['userId'];
            $userId = 1;

            $folders = $this->folderRepository->getFoldersByOwnerId($userId);

            for ($i=0; $i < count($folders); $i++) { 
                if($folders[$i]->id == $folderId && $folders[$i]->owner_id != $userId) {
                    die();
                }
            }

            $files = $this->fileRepository->getFilesByFolderId($folderId);
            
            $filesResult = [];
            for ($i=0; $i < count($files); $i++) { 
                $file = $files[$i];

                $filePath = $file->location;
                $thumbnailPath = $this->getThumbnail($filePath);
                $fileResult = new FileBaseResult($file->id, $file->name, $thumbnailPath);

                array_push($filesResult, $fileResult);
            }

            return $filesResult;
        }
        
        public function addFile()
        {
        }

        public function deleteFile($fileId)
        {
            return $this->fileRepository->deleteFile($fileId);
        }

        public function editFile($fileId)
        {
            //$userId = $_SESSION['userId'];
            $userId = 1;

            $file = new File($fileId);
            return $this->fileRepository->updateFile($file);
        }
    }
?>
