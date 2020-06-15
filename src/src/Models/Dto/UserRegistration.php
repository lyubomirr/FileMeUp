<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));

    class UserRegistration {
        private $username;
        private $email;
        private $password;
        private $passwordConfirmation;

        use JsonBehaviour;
        use GetSetBehaviour;
        
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