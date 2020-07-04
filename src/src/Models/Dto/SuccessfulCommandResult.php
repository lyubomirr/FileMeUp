<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));
    
    class SuccessfulCommandResult implements JsonSerializable {
        public $success = true;
        use JsonBehaviour;
    }
    
?>