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
            $sql = "INSERT INTO {$this->tableName}(name, owner_id) VALUES (:name, :owner_id)";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "name" => $folder->name,
                "owner_id" => $folder->owner_id
            ]);
        }

        public function getFoldersByOwnerId($ownerId, $searchQuery) {
            $sql = "SELECT * FROM {$this->tableName} WHERE owner_id = :owner_id";
            
            if($searchQuery->searchValue != "") {
                $sql = $sql . " && name LIKE '{$searchQuery->searchValue}%'";
            }

            $result = $this->databaseAdapter->fetchStatement($sql, ["owner_id" => $ownerId]);
            
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
            $sql = "UPDATE {$this->tableName} SET name = :name, owner_id = :owner_id WHERE id = :id";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "id" => $folder->id,
                "name" => $folder->name, 
                "owner_id" => $folder->owner_id
            ]);
        }

        public function deleteFolder($id) {
            $sql = "DELETE FROM {$this->tableName} WHERE id = :id";

            return $this->databaseAdapter->executeCommand($sql, ["id" => $id]);
        }
    }
?>