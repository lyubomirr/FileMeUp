<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));
    
    class ContentMimeTypeFile implements JsonSerializable {
        private $id;
        private $name;
        private $folderId;
        private $folder;
        private $description;
        private $size;
        private $location;
        private $storeDate;
        private $lastModifiedDate;
        private $extension;
        private $mimeType;

        public function __construct($file) {
            $this->id = $file->id;
            $this->name = $file->name;
            $this->folderId = $file->folderId;
            $this->folder = $file->folder;
            $this->description = $file->description;
            $this->size = $file->size;
            $this->location = $file->location;
            $this->storeDate = $file->storeDate;
            $this->lastModifiedDate = $file->lastModifiedDate;
            $this->extension = $file->extension;
        }
        
        use JsonBehaviour;
        use GetSetBehaviour;
    }
    
?>