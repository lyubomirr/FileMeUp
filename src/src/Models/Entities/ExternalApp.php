<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class ExternalApp extends BaseEntity implements JsonSerializable {
        private $name;
        private $url;

        public function __construct($id = 0, $name = "", $url = "") {
            parent::__construct($id);
            
            $this->name = $name;
            $this->url = $url;
        }

        use GetSetBehaviour;
        use JsonBehaviour;

        public static function fromAssociativeArray($array) {
            $app = new ExternalApp();
            parent::populateValuesFromArray($app, $array);
    		return $app;
        }
    }
?>