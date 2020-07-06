<?php
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));
    require_once(Config::constructFilePath("/Models/Entities/File.php"));
    require_once(Config::constructFilePath("/Models/Entities/Folder.php"));
    require_once(Config::constructFilePath("/Models/Exceptions/DatabaseExecutionException.php"));

    class FileRepository {
        private $databaseAdapter;
        private $tableName = "files";

        public function __construct(){
            $this->databaseAdapter = DatabaseAdapter::getInstance();
        }

        public function addFile($file) {
            $sql = "INSERT INTO `{$this->tableName}` (`name`, `folderId`, `description`, `size`, `extension`, `location`, `storeDate`, `lastModifiedDate`) 
                    VALUES (:name, :folderId, :description, :size, :extension, :location, :storeDate, :lastModifiedDate) ";
            
            $result = $this->databaseAdapter->executeCommand($sql, [
                "name" => $file->name,
                "folderId" => $file->folderId,
                "description" => $file->description,
                "size" => $file->size,
                "extension" => $file->extension,
                "location" => $file->location,
                "storeDate" => $file->storeDate,
                "lastModifiedDate" => $file->lastModifiedDate
            ]);

            if(!$result) {
                throw new DatabaseExecutionException("Could not insert file with name" . $file->name);
            }

            return $this->databaseAdapter->getLastInsertId();
        }

        public function getFilesByFolderId($folderId, $searchQuery = null) {
            $sql = "SELECT * FROM `{$this->tableName}` WHERE `folderId` = :folderId";
            
            if($searchQuery != null && $searchQuery->searchValue != "") {
                $sql = $sql . " && name LIKE '{$searchQuery->searchValue}%'";
            }

            $result = $this->databaseAdapter->fetchStatement($sql, ["folderId" => $folderId]);
            
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
            $sql = "SELECT `{$this->tableName}`.*, `folders`.`id` as `fId`, `folders`.`name` as `folderName`, `folders`.`ownerId` 
            FROM `{$this->tableName}` INNER JOIN `folders` ON `{$this->tableName}`.`folderId`=`folders`.`id` 
            WHERE {$this->tableName}.`id` = :id";
            
            $result = $this->databaseAdapter->fetchStatement($sql, ["id" => $id]);
            if (count($result) == 0) {
                return null;
            }

            $file = File::fromAssociativeArray($result[0]);
            $file->folder = new Folder($result[0]["fId"], $result[0]["folderName"], $result[0]["ownerId"]);
            return $file;
        }

        public function updateFile($file) {
            $sql = "UPDATE `{$this->tableName}` 
                    SET `name` = :name, `folderId` = :folderId, `description` = :description, 
                    `size` = :size, `location` = :location, `storeDate` = :storeDate, `lastModifiedDate` = :lastModifiedDate
                    WHERE `id` = :id";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "id" => $file->id,
                "name" => $file->name,
                "folderId" => $file->folderId,
                "description" => $file->description,
                "size" => $file->size,
                "location" => $file->location,
                "storeDate" => $file->storeDate,
                "lastModifiedDate" => $file->lastModifiedDate
            ]);
        }

        public function deleteFile($id) {
            $sql = "DELETE FROM `{$this->tableName}` WHERE `id` = :id";
            return $this->databaseAdapter->executeCommand($sql, ["id" => $id]);
        }
    }
?>