<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class FolderWithLinks {
        public $id;
        public $name;
        public $ownerId;
        public $openLink;
        public $editLink;
        public $deleteLink;

        use JsonBehaviour;

        public function __construct($id = 0, $name = "", $ownerId = 0, $openLink, $editLink, $deleteLink) { 
            $this->id = $id;
            $this->name = $name;
            $this->ownerId = $ownerId;
            $this->openLink = $openLink;
            $this->editLink = $editLink;
            $this->deleteLink = $deleteLink;
        }
    }
?>