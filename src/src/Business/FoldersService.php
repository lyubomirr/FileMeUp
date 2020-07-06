<?php 
    require_once(Config::constructFilePath("/Models/Entities/Folder.php"));
    require_once(Config::constructFilePath("/DataAccess/FolderRepository.php"));
    require_once(Config::constructFilePath("/DataAccess/ContentRepository.php"));
    require_once(Config::constructFilePath("/DataAccess/UsersRepository.php"));
    require_once(Config::constructFilePath("/Models/Dto/FolderWithLinks.php"));
    require_once(Config::constructFilePath("/Models/Exceptions/DatabaseExecutionException.php"));

    class FoldersService {
        private $folderRepository;
        private $contentRepository;

        public function __construct()
        {
            $this->folderRepository = new FolderRepository();
            $this->contentRepository = new ContentRepository();
        }

        public function getById($folderId) {
            return $this->folderRepository->getFolder($folderId);
        }

        public function getFolders($searchQuery) {
            $userId = $_SESSION['userId'];
            $folders = $this->folderRepository->getFoldersByOwnerId($userId, $searchQuery);

            return $folders;
        }

        public function addFolder($folderName)
        {
            $folder = new Folder();
            $folder->name = $folderName;

            $userId = $_SESSION['userId'];
            $folder->ownerId = $userId; 

            try {
                $this->folderRepository->addFolder($folder);
                return true;  

            } catch (DatabaseExecutionException $e) {
                return new ErrorResult([
                    $e->getMessage()
                ]);
            }
        }

        public function deleteFolder($folderId)
        {
            $userId = 1;
            $result = $this->folderRepository->deleteFolder($folderId);

            if($result) {
                $url = Utils::combinePaths(array($userId, $folderId));
                $this->contentRepository->deleteFolder($url);
            }

            return $result;
        }

        public function editFolder($folderId, $folderName)
        {
            $userId = $_SESSION['userId'];

            $folder = new Folder($folderId, $folderName, $userId);
            return $this->folderRepository->updateFolder($folder);
        }
    }
?>
