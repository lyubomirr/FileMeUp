<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));

    class SearchQuery {
        private $searchValue;
        private $count;
        private $start;

        use JsonBehaviour;
        use GetSetBehaviour;
        
        public static function fromJson($json) {
            $searchQuery = new SearchQuery();
            self::populateFromJson($searchQuery, $json);
            return $searchQuery;
        }

        public function __construct($searchValue = "", $count = 100, $start = 0) {
            $this->searchValue = $searchValue;
            $this->$count = $count;
            $this->start = $start;
        }
    }
?>