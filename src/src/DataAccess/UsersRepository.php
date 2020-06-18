<?php 
    require_once(Config::constructFilePath("/DataAccess/DatabaseAdapter.php"));
    require_once(Config::constructFilePath("/Models/Entities/User.php"));

    class UsersRepository {
        public function addUser($user) {
            $sql = "INSERT INTO `Users` (`username`, `email`, `password`) VALUES (:username, :email, :password)";
            $adapter = DatabaseAdapter::getInstance();
            return $adapter->executeCommand($sql, [
                "username" => $user->username,
                "email" => $user->email,
                "password" => $user->password
            ]);
        }

        public function getUser($username) {
            $sql = "SELECT * FROM `Users` WHERE `username` = :username";
            $adapter = DatabaseAdapter::getInstance();
            
            $result = $adapter->fetchStatement($sql, [
                "username" => $username
            ]);

            if(count($result) == 0) {
                return null;
            }

            return User::fromAssociativeArray($result[0]);
        }
    }

?>