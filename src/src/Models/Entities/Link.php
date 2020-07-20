<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class Link extends BaseEntity implements JsonSerializable {
        private $token;
        private $fileId;
        private $password;
        private $sharesLeft;
        private $validUntil;

        public function __construct($id = 0, $token = "", $fileId = 0) {
            parent::__construct($id);
            
            $this->token = $token;
            $this->fileId = $fileId;
        }

        use GetSetBehaviour;
        use JsonBehaviour;

        public static function fromAssociativeArray($array) {
            $link = new Link();
            parent::populateValuesFromArray($link, $array);
    		return $link;
        }
    }
?>