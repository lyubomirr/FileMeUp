<?php
    require_once("User.php");

    class UserRegistration extends User {
        private $passwordConfirmation;

        use JsonBehaviour;
        
        public static function fromJson($json) {
            $regisration = new UserRegistration();
            self::populateFromJson($regisration, $json);
            return $regisration;
        }

        public function __construct($username = "", $email = "", $password = "", $passwordConfirmation = "") {
            parent::__construct($username, $email, $password);
            $this->passwordConfirmation = $passwordConfirmation;
        }
    }
?>