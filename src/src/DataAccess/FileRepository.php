<?php
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));
    require_once(Config::constructFilePath("/Models/Entities/File.php"));

    class FileRepository {
        private $databaseAdapter;
        private $tableName = "files";

        public function __construct(){
            $this->databaseAdapter = DatabaseAdapter::getInstance();
        }

        public function addFile($file) {
            $sql = "INSERT INTO {$this->tableName}(name, folder_id, description, size, location, store_date, last_modified_date) 
                    VALUES (:name, :folder_id, :description, :size, :location, :store_date, :last_modified_date) ";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "name" => $file->name,
                "folder_id" => $file->folder_id,
                "description" => $file->description,
                "size" => $file->size,
                "location" => $file->location,
                "store_date" => $file->store_date,
                "last_modified_date" => $file->last_modified_date
            ]);
        }

        public function getFilesByFolderId($folderId, $searchQuery = null) {
            $sql = "SELECT * FROM {$this->tableName} WHERE folder_id = :folder_id";
            
            if($searchQuery != null && $searchQuery->searchValue != "") {
                $sql = $sql . " && name LIKE '{$searchQuery->searchValue}%'";
            }

            $result = $this->databaseAdapter->fetchStatement($sql, ["folder_id" => $folderId]);
            
            $files = [];
            if (count($result) == 0) {
                return $files;
            }
            
            for ($i = 0; $i < count($result); $i++) {
                $file = File::fromAssociativeArray($result[$i]);
                array_push($files, $file);
            }

            return $files;
        }

        public function getFile($id) {
            $sql = "SELECT * FROM {$this->tableName} WHERE id = :id";
            
            $result = $this->databaseAdapter->fetchStatement($sql, ["id" => $id]);
            if (count($result) == 0) {
                return null;
            }

            return File::fromAssociativeArray($result[0]);
        }

        public function updateFile($file) {
            $sql = "UPDATE {$this->tableName} 
                    SET name = :name, folder_id = :folder_id, description = :description, size = :size, location = :location, store_date = :store_date, last_modified_date = :last_modified_date
                    WHERE id = :id";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "id" => $file->id,
                "name" => $file->name,
                "folder_id" => $file->folder_id,
                "description" => $file->description,
                "size" => $file->size,
                "location" => $file->location,
                "store_date" => $file->store_date,
                "last_modified_date" => $file->last_modified_date
            ]);
        }

        public function deleteFile($id) {
            $sql = "DELETE FROM {$this->tableName} WHERE id = :id";

            return $this->databaseAdapter->executeCommand($sql, ["id" => $id]);
        }
    }
?>