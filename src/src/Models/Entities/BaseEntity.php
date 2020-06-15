<?php
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));

    abstract class BaseEntity {
        private $id;

        protected function __construct($id) {
            $this->id = $id;
        }

        use GetSetBehaviour;
    }