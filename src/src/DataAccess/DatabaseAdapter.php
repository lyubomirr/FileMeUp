<?php
    class DatabaseAdapter {
        private static $instance = null;
        private $connection;

        public static function getInstance() {
            if(self::$instance == null) {
                self::$instance = new DatabaseAdapter();
            }

            return self::$instance;
        }

        private function __construct() {
            $this->initializeConnection();
        }

        private function initializeConnection() {
            try {
                $this->connection = new PDO("mysql:host=".Config::DB_HOST.";dbname=".Config::DB_NAME, 
                    Config::DB_USER, Config::DB_PASS,
                    [
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION
                    ]);
                    
            } catch (PDOException $ex) {
                die(json_encode(array("errors" => array("Couldn't connect to database."))));
            }
        }
        
        public function executeCommand($sql, $parameters = null) {
            $statement = $this->connection->prepare($sql);
            return $statement->execute($parameters);
        }

        public function fetchStatement($sql, $parameters = null) {
            $statement = $this->connection->prepare($sql);
            $statement->execute($parameters);

            return $statement->fetchAll();
        }
    }
?>