<?php
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));
    require_once(Config::constructFilePath("/Models/Entities/Folder.php"));

    class FolderRepository {
        private $databaseAdapter;
        private $tableName = "folders";

        public function __construct(){
            $this->databaseAdapter = DatabaseAdapter::getInstance();
        }

        public function addFolder($folder) {
            $sql = "INSERT INTO {$this->tableName}(name, ownerId) VALUES (:name, :ownerId)";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "name" => $folder->name,
                "ownerId" => $folder->ownerId
            ]);
        }

        public function getFoldersByOwnerId($ownerId, $searchQuery = null) {
            $sql = "SELECT * FROM {$this->tableName} WHERE ownerId = :ownerId";
            
            if($searchQuery != null && $searchQuery->searchValue != "") {
                $sql = $sql . " && name LIKE '{$searchQuery->searchValue}%'";
            }

            $result = $this->databaseAdapter->fetchStatement($sql, ["ownerId" => $ownerId]);
            
            $folders = [];
            if (count($result) == 0) {
                return $folders;
            }
            
            for ($i = 0; $i < count($result); $i++) {
                $folder = Folder::fromAssociativeArray($result[$i]);
                array_push($folders, $folder);
            }

            return $folders;
        }

        public function getFolder($id) {
            $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
            
            $result = $this->databaseAdapter->fetchStatement($sql, ["id" => $id]);
            if (count($result) == 0) {
                return null;
            }

            return Folder::fromAssociativeArray($result[0]);
        }

        public function updateFolder($folder) {
            $sql = "UPDATE {$this->tableName} SET name = :name, ownerId = :ownerId WHERE id = :id";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "id" => $folder->id,
                "name" => $folder->name, 
                "ownerId" => $folder->ownerId
            ]);
        }

        public function deleteFolder($id) {
            $sql = "DELETE FROM {$this->tableName} WHERE id = :id";
            return $this->databaseAdapter->executeCommand($sql, ["id" => $id]);
        }
    }
?>