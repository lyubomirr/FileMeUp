<?php
    require_once("JsonBehaviour.php");

    class User {
        private $username;
        private $email;
        private $password;

        public function __construct($username = "", $email = "", $password = "") {
            $this->username = $username;
            $this->$email = $email;
            $this->password = $password;
        }

        public function __get($property) {
    		if (property_exists($this, $property)) {
    			return $this->$property;
    		}
    	}
    
    	public function __set($property, $value) {
    		if (property_exists($this, $property)) {
    			$this->$property = $value;
    		}
        }
    }
?>