<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class FileBaseResult {
        public $id;
        public $name;
        public $filePath;

        use JsonBehaviour;

        public function __construct($id = 0, $name = "", $filePath = "") { 
            $this->id = $id;
            $this->name = $name;
            $this->filePath = $filePath;
        }
    }
?>