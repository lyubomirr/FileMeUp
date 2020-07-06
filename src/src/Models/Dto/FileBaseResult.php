<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class FileBaseResult {
        public $id;
        public $name;
        public $extension;
        public $thumbnailPath;
        public $hasThumbnail;

        use JsonBehaviour;

        public function __construct($id = 0, $name = "", $extension = "", $thumbnailPath = "", $hasThumbnail = false) { 
            $this->id = $id;
            $this->name = $name;
            $this->extension = $extension;
            $this->thumbnailPath = $thumbnailPath;
            $this->hasThumbnail = $hasThumbnail;
        }
    }
?>