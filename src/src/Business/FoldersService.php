<?php 
    require_once(Config::constructFilePath("/Models/Entities/Folder.php"));
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));

    class FoldersService {
        public function getFolders($searchQuery) {
            //TODO add conditions from searchQuery

            $databaseAdapter = DatabaseAdapter::getInstance();
            $selectStatement = "Select id, name, owner_id From Folders";
            
            return $databaseAdapter->fetchStatement($selectStatement, null);
        }
    }
?>
