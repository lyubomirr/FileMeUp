<?php
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));
    require_once(Config::constructFilePath("/Models/Entities/Link.php"));
    require_once(Config::constructFilePath("/Models/Exceptions/DatabaseExecutionException.php"));

    class LinkRepository {
        private $databaseAdapter;
        private $tableName = "links";

        public function __construct(){
            $this->databaseAdapter = DatabaseAdapter::getInstance();
        }

        public function addLink($link) {
            $sql = "INSERT INTO `{$this->tableName}` (`token`, `fileId`, `password`, `validUntil`, `sharesLeft`) VALUES (:token, :fileId, :password, :validUntil, :sharesLeft)";
            
            $result = $this->databaseAdapter->executeCommand($sql, [
                "token" => $link->token,
                "fileId" => $link->fileId,
                "password" => $link->password,
                "validUntil" => $link->validUntil,
                "sharesLeft" => $link->sharesLeft
            ]);

            if(!$result) {
                throw new DatabaseExecutionException("Could not insert link with token" . $link->token);
            }

            return $this->databaseAdapter->getLastInsertId();
        }

        public function getLink($linkToken) {
            $sql = "SELECT * FROM `{$this->tableName}` WHERE `token` = :token";
            
            $result = $this->databaseAdapter->fetchStatement($sql, ["token" => $linkToken]);
            if (count($result) == 0) {
                return null;
            }

            return Link::fromAssociativeArray($result[0]);
        }

        public function updateLink($link) {
            $sql = "UPDATE `{$this->tableName}`   
                    SET `token` = :token, `fileId` = :fileId, `password` = :password, `validUntil` = :validUntil, `sharesLeft` = :sharesLeft
                    WHERE `id` = :id";
            
            return $this->databaseAdapter->executeCommand($sql, [
                "id" => $link->id,
                "token" => $link->token,
                "fileId" => $link->fileId,
                "password" => $link->password,
                "validUntil" => $link->validUntil,
                "sharesLeft" => $link->sharesLeft
            ]);
        }

        public function deleteLink($id) {
            $sql = "DELETE FROM `{$this->tableName}` WHERE `id` = :id";
            return $this->databaseAdapter->executeCommand($sql, ["id" => $id]);
        }

        public function getPermanentLinkToken($fileId) {
            $sql = "SELECT * FROM `{$this->tableName}` WHERE `fileId`= :fileId AND `password` IS NULL
            AND `validUntil` IS NULL AND sharesLeft IS NULL";

            $result = $this->databaseAdapter->fetchStatement($sql, ["fileId" => $fileId]);
            if(count($result) == 0) {
                return null;
            }
            
            return $result[0]["token"];
        }
    }
?>