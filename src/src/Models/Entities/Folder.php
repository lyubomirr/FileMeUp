<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));

    class Folder extends BaseEntity {
        private $name;
        private $ownerId;

        public function __construct($id = 0, $name = "", $ownerId = 0) {
            parent::__construct($id);
            
            $this->name = $name;
            $this->$ownerId = $ownerId;
        }
        
        use GetSetBehaviour;
    }
?>