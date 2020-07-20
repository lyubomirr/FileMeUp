<?php
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));
    require_once(Config::constructFilePath("/Models/Entities/ExternalApp.php"));

    class ExternalAppsRepository {
        private $databaseAdapter;

        public function __construct(){
            $this->databaseAdapter = DatabaseAdapter::getInstance();
        }

        public function getExternalApp($extension) {
            $sql = "SELECT * FROM `extensiontoapp`  INNER JOIN `externalapps` ON `extensiontoapp`.`appId`=`externalapps`.`id` 
            WHERE `extensiontoapp`.`extension` = :extension";

            $result =  $this->databaseAdapter->fetchStatement($sql, ["extension" => $extension]);
            if (count($result) == 0) {
                return null;
            }

            return ExternalApp::fromAssociativeArray($result[0]);
        }

    }
?>