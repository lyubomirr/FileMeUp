<?php 
    require_once(Config::constructFilePath("/Models/Entities/Folder.php"));
    require_once(Config::constructFilePath("/DataAccess/FolderRepository.php"));
    require_once(Config::constructFilePath("/Models/Dto/FolderWithLinks.php"));

    class FoldersService {
        private $folderRepository;

        public function __construct()
        {
            $this->folderRepository = new FolderRepository();
        }

        public function getFolders($searchQuery) {
            //TODO add conditions from searchQuery

            $userId = $_SESSION['userId'];
            $folders = $this->folderRepository->getFoldersByOwnerId($userId, $searchQuery);

            $foldersWithLinks = [];
            for ($i = 0; $i < count($folders); $i++) { 
                $openLink = "folder.php?folderId=" . $folders[$i]->id;
                $editLink = "edit-folder.php?folderId=" . $folders[$i]->id;
                $deleteLink = "delete-folder.php?folderId=" . $folders[$i]->id;

                $folderWithLinks = new FolderWithLinks($folders[$i]->id, $folders[$i]->name, $folders[$i]->ownerId, $openLink, $editLink, $deleteLink);
                
                array_push($foldersWithLinks, $folderWithLinks);
            }
            
            return $foldersWithLinks;
        }

        public function addFolder($folderName)
        {
            $folder = new Folder();
            $folder->name = $folderName;

            $userId = $_SESSION['userId'];
            $folder->ownerId = $userId; 

            return $this->folderRepository->addFolder($folder);
        }

        public function deleteFolder($folderId)
        {
            return $this->folderRepository->deleteFolder($folderId);
        }

        public function editFolder($folderId, $folderName)
        {
            $userId = $_SESSION['userId'];

            $folder = new Folder($folderId, $folderName, $userId);
            return $this->folderRepository->updateFolder($folder);
        }
    }
?>
