<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class File extends BaseEntity {
        private $name;
        private $folder_id;
        private $description;
        private $size;
        private $location;
        private $store_date;
        private $last_modified_date;

        public function __construct($id = 0, $name = "", $folder_id = 0, $description = "", $size = 0, $location = "", $store_date = "", $last_modified_date = "") {
            parent::__construct($id);
            
            $this->name = $name;
            $this->folder_id = $folder_id;
            $this->description = $description;
            $this->size = $size;
            $this->location = $location;
            $this->store_date = $store_date;
            $this->last_modified_date = $last_modified_date;
        }

        use GetSetBehaviour;
        use JsonBehaviour;

        public static function fromAssociativeArray($array) {
            $file = new File();
            parent::populateValuesFromArray($file, $array);
    		return $file;
        }
    }
?>