<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));
    
    class ErrorResult implements JsonSerializable {
        private $errorMessages;

        public function __construct($errorMessages) {
            $this->errorMessages = $errorMessages;
        }
        
        use JsonBehaviour;
    }
    
?>