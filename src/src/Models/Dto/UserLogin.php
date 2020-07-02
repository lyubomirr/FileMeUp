<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));
    require_once(Config::constructFilePath("/Models/GetSetBehaviour.php"));

    class UserLogin {
        private $username;
        private $password;

        use JsonBehaviour;
        use GetSetBehaviour;
        
        public static function fromJson($json) {
            $login = new UserLogin();
            self::populateFromJson($login, $json);
            return $login;
        }

        public function __construct($username = "", $password = "") {
            $this->username = $username;
            $this->password = $password;
        }
    }
?>