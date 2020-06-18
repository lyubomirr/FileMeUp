<?php
    require_once(Config::constructFilePath("/Models/Entities/BaseEntity.php"));
    require_once(Config::constructFilePath("/Models//GetSetBehaviour.php"));

    class User extends BaseEntity {
        private $username;
        private $email;
        private $password;

        public function __construct($id = 0, $username = "", $email = "", $password = "") {
            parent::__construct($id);
            
            $this->username = $username;
            $this->$email = $email;
            $this->password = $password;
        }
        
        use GetSetBehaviour;

        public static function fromAssociativeArray($array) {
            $user = new User();
            self::populateValuesFromArray($user, $array);
    		return $user;
        }
    }
?>