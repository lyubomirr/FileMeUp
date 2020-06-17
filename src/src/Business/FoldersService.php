<?php 
    require_once(Config::constructFilePath("/Models/Entities/Folder.php"));
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));

    class FoldersService {
        public function getFolders($searchQuery) {
            //TODO add conditions from searchQuery

            $databaseAdapter = DatabaseAdapter::getInstance();
            $selectStatement = "Select id, name, owner_id From Folders";
            
            $result = $databaseAdapter->fetchStatement($selectStatement, null);
            echo json_encode($result);
        }
    }
?>
