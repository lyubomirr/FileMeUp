<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    class UserRegistration {
        public $username;
        public $email;
        public $password;
        public $passwordConfirmation;

        use JsonBehaviour;
        
        public static function fromJson($json) {
            $registration = new UserRegistration();
            self::populateFromJson($registration, $json);
            return $registration;
        }

        public function __construct($username = "", $email = "", $password = "", $passwordConfirmation = "") {
            $this->username = $username;
            $this->$email = $email;
            $this->password = $password;
            $this->passwordConfirmation = $passwordConfirmation;
        }
    }
?>