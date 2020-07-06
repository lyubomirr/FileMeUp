<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class File extends BaseEntity implements JsonSerializable {
        private $name;
        private $folderId;
        private $folder;
        private $description;
        private $size;
        private $location;
        private $storeDate;
        private $lastModifiedDate;
        private $extension;

        public function __construct(
            $id = 0, 
            $name = "", 
            $folderId = 0, 
            $folder = NULL,
            $description = "", 
            $size = 0, 
            $location = "", 
            $storeDate = "", 
            $lastModifiedDate = "", 
            $extension = "") {
            parent::__construct($id);
            
            $this->name = $name;
            $this->folderId = $folderId;
            $this->folder = $folder;
            $this->description = $description;
            $this->size = $size;
            $this->location = $location;
            $this->storeDate = $storeDate;
            $this->lastModifiedDate = $lastModifiedDate;
            $this->extension = $extension;
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