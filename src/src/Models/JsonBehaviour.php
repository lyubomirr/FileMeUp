<?php 
    trait JsonBehaviour {
        private static function populateFromJson($object, $json) {
            $array = json_decode($json, true);
            foreach($array as $key => $value) {
    			$object->$key = $value;
    		}
        }
    }

?>