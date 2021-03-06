<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class Folder extends BaseEntity implements JsonSerializable {
        private $name;
        private $ownerId;

        public function __construct($id = 0, $name = "", $ownerId = 0) {
            parent::__construct($id);
            
            $this->name = $name;
            $this->ownerId = $ownerId;
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