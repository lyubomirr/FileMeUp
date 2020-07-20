<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));

    class LinkSettings {
        private $fileId;
        private $password;
        private $validUntil;
        private $count;

        use JsonBehaviour;
        use GetSetBehaviour;
        
        public static function fromJson($json) {
            $linkSettings = new LinkSettings();
            self::populateFromJson($linkSettings, $json);
            return $linkSettings;
        }

        public function __construct($fileId = 0, $password = "", $validUntil = "", $count = "") {
            $this->fileId = $fileId;
            $this->password = $password;
            $this->validUntil = $validUntil;
            $this->count = $count;
        }

        public static function fromAssociativeArray($array) {
            $linkSettings = new LinkSettings();
            foreach($array as $key => $value) {
                $linkSettings->$key = $value;
    		}
    		return $linkSettings;
        }
    }
?>