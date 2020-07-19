<?php 
    require_once(Config::constructFilePath("/Models/Entities/File.php"));
    require_once(Config::constructFilePath("/DataAccess/FileRepository.php"));
    require_once(Config::constructFilePath("/DataAccess/FolderRepository.php"));
    require_once(Config::constructFilePath("/DataAccess/ContentRepository.php"));
    require_once(Config::constructFilePath("/Models/Dto/FileBaseResult.php"));
    require_once(Config::constructFilePath("/Models/Dto/FileBaseResult.php"));
    require_once(Config::constructFilePath("/Helpers/ThumbnailCreator.php"));
    require_once(Config::constructFilePath("/Models/Exceptions/DatabaseExecutionException.php"));
    require_once(Config::constructFilePath("/Utils.php"));
    require_once(Config::constructFilePath("/Models/Dto/SearchQuery.php")); 
    
    class FilesService {
        private $fileRepository;
        private $folderRepository;
        private $contentRepository;

        public function __construct() {
            $this->fileRepository = new FileRepository();
            $this->folderRepository = new FolderRepository();
            $this->contentRepository = new ContentRepository();
        }

        public function getFilesWithThumbnails($folderId, $searchQuery, $userId) {
            $folder = $this->folderRepository->getFolder($folderId);
            if($folder->ownerId != $userId) {
                throw new UnauthorizedException("You don't have permissions to fetch this folder!");
            }

            $files = $this->fileRepository->getFilesByFolderId($folderId, $searchQuery);
            
            $filesResult = [];
            for ($i=0; $i < count($files); $i++) { 
                $file = $files[$i];

                $thumbnailPath = ThumbnailCreator::createThumbnail($file->location, 120, 200);
                $hasThumbnail = $thumbnailPath != null; 

                $fileResult = new FileBaseResult($file->id, $file->name, str_replace(".", "", $file->extension), $thumbnailPath, $hasThumbnail);

                array_push($filesResult, $fileResult);
            }

            return $filesResult;
        }

        public function getFilesByFolder($folderId, $userId) {
            $folder = $this->folderRepository->getFolder($folderId);
            if($folder->ownerId != $userId) {
                throw new UnauthorizedException("You don't have permissions to fetch this folder!");
            }
            
            return $this->fileRepository->getFilesByFolderId($folderId, new SearchQuery());
        }

        public function addFile($userId, $fileEntity, $file) {
            $extension = pathinfo($file["name"], PATHINFO_EXTENSION);
            
            $savedFiles = [];
            try {
                if ($extension == "zip") {
                    $savedFiles = $this->contentRepository->unzipFile($file["tmp_name"], Utils::combinePaths(array($userId, $fileEntity->folderId)));

                    for ($i=0; $i < count($savedFiles); $i++) {

                        $fileEntity->name = pathinfo($savedFiles[$i]["filename"], PATHINFO_BASENAME);
                        $fileEntity->size = $savedFiles[$i]["size"];
                        $fileEntity->storeDate = date('Y-m-d H:i:s');
                        $fileEntity->location = $savedFiles[$i]["filename"];
                        $fileEntity->extension = pathinfo($savedFiles[$i]["filename"], PATHINFO_EXTENSION);

                        $this->fileRepository->addFile($fileEntity);
                    }
                } else {
                    $filePath = Utils::combinePaths(array($userId, $fileEntity->folderId, $file["name"]));
                    array_push($savedFiles, array("filename" => $filePath));
                    $this->addFileInternal($fileEntity, $file, $filePath);
                }

                return true;
            } catch (DatabaseExecutionException $e) {
                for ($i=0; $i < count($savedFiles); $i++) { 
                    $this->contentRepository->deleteFile($savedFiles[$i]["filename"]);
                }

                return new ErrorResult([
                    $e->getMessage()
                ]);
            }
        }

        private function addFileInternal($fileEntity, $file, $filePath) {
            $savedFilePath = $this->contentRepository->addFile($file["tmp_name"], $filePath);

            $fileEntity->size = $file["size"];
            $fileEntity->storeDate = date('Y-m-d H:i:s');
            $fileEntity->location = $savedFilePath;
            $fileEntity->extension = pathinfo($file["name"], PATHINFO_EXTENSION);

            $this->fileRepository->addFile($fileEntity);
        }

        public function deleteFile($fileId) {
            $userId = $_SESSION['userId'];

            $file = $this->fileRepository->getFile($fileId);
            $result = $this->fileRepository->deleteFile($fileId);
        
            if($result) {
                $this->contentRepository->deleteFile($file->location);
            }

            return $result;
        }

        public function editFile($fileId) {
            $userId = $_SESSION['userId'];

            $file = new File($fileId);
            return $this->fileRepository->updateFile($file);
        }

        public function getFileById($fileId) {
            return $this->fileRepository->getFile($fileId);
        }

        public function getFileFullPath($filePath) {
            return $this->contentRepository->getFileLocation($filePath);
        }
    }
?>
