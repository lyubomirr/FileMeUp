<?php
    abstract class BaseEntity {
        private $id;

        protected function __construct($id) {
            $this->id = $id;
        }

        protected static function populateValuesFromArray($object, $array) {
            foreach($array as $key => $value) {
                $object->$key = $value;
    		}
        }
    }