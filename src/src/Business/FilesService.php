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
    
    class FilesService {
        private $fileRepository;
        private $folderRepository;
        private $contentRepository;

        public function __construct() {
            $this->fileRepository = new FileRepository();
            $this->folderRepository = new FolderRepository();
            $this->contentRepository = new ContentRepository();
        }

        public function getFiles($folderId, $searchQuery, $userId) {
            $folder = $this->folderRepository->getFolder($folderId);
            if($folder->ownerId != $userId) {
                throw new Exception("");
            }

            $files = $this->fileRepository->getFilesByFolderId($folderId, $searchQuery);
            
            $filesResult = [];
            for ($i=0; $i < count($files); $i++) { 
                $file = $files[$i];

                $relativeFilePath = Utils::combinePaths(array($userId, $folder->id, $file->location));
                $filePath = $this->contentRepository->getFileLocation($relativeFilePath);

                $thumbnailPath = ThumbnailCreator::createThumbnail($filePath, 120, 200);
                $hasThumbnail = $thumbnailPath != null; 

                $fileResult = new FileBaseResult($file->id, $file->name, str_replace(".", "", $file->extension), $thumbnailPath, $hasThumbnail);

                array_push($filesResult, $fileResult);
            }

            return $filesResult;
        }

        public function addFile($userId, $fileEntity, $file) {
            $filePath = Utils::combinePaths(array($userId, $fileEntity->folderId, $file["name"]));

             try {
                $savedFilePath = $this->contentRepository->addFile($file["tmp_name"], $filePath);

                $fileEntity->size = $file["size"];
                $fileEntity->storeDate = date('Y-m-d H:i:s');
                $fileEntity->location = $savedFilePath;
                $fileEntity->extension = pathinfo($file["name"], PATHINFO_EXTENSION);

                $this->fileRepository->addFile($fileEntity);
                return true;

             } catch (DatabaseExecutionException $e) {
                $this->contentRepository->deleteFile($filePath);
                return new ErrorResult([
                    $e->getMessage()
                ]);
             }
        }

        public function deleteFile($fileId) {
            $userId = $_SESSION['userId'];

            $file = $this->fileRepository->getFile($fileId);
            $result = $this->fileRepository->deleteFile($fileId);

            if($result) {
                $url = Utils::combinePaths(array($userId, $file->folderId, $fileId));
                $this->contentRepository->deleteFolder($url);
            }
        }

        public function editFile($fileId) {
            $userId = $_SESSION['userId'];

            $file = new File($fileId);
            return $this->fileRepository->updateFile($file);
        }

        public function getFileById($fileId) {
            return $this->fileRepository->getFile($fileId);
        }
    }
?>
