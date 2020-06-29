<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class Folder extends BaseEntity {
        private $name;
        private $owner_id;

        public function __construct($id = 0, $name = "", $owner_id = 0) {
            parent::__construct($id);
            
            $this->name = $name;
            $this->owner_id = $owner_id;
        }

        use GetSetBehaviour;
        use JsonBehaviour;

        public static function fromAssociativeArray($array) {
            $folder = new Folder();
            parent::populateValuesFromArray($folder, $array);
    		return $folder;
        }
    }
?>