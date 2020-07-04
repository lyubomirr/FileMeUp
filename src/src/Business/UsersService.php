<?php 
    require_once(Config::constructFilePath("/Models/Dto/UserRegistration.php"));
    require_once(Config::constructFilePath("/Models/Entities/User.php"));
    require_once(Config::constructFilePath("/Models/Dto/ErrorResult.php"));
    require_once(Config::constructFilePath("/Models/Exceptions/AuthenticationException.php"));
    require_once(Config::constructFilePath("/DataAccess/UsersRepository.php"));
    
    class UsersService {
        private $usersRepository;

        public function __construct() {
            $this->usersRepository = new UsersRepository();
        }
        
        public function registerUser($userRegistration) {
            return $this->safeExecute(function() use ($userRegistration) {
                if($this->doesUserExist($userRegistration->username)) {
                    return new ErrorResult([
                        "A user with that username is already registered."
                    ]);
                }

                $user = new User();

                $user->username = $userRegistration->username;
                $user->email = $userRegistration->email;
                $user->password = password_hash($userRegistration->password, PASSWORD_DEFAULT);
    
                return $this->usersRepository->addUser($user);
            });
        }

        private function doesUserExist($username) {
            $user = $this->usersRepository->getUser($username);
            return !is_null($user);
        }

        private function safeExecute($function) {
            try {
                return $function();
            } catch (PDOException $e) {
                return new ErrorResult([
                    "There was a problem with the database. Please try again later!"
                ]);
            }
        }

        public function login($userLogin) {
            $user = $this->usersRepository->getUser($userLogin->username);
            if(is_null($user)) {
                throw new AuthenticationException("No user with this username registered.");
            }
    
            if(!password_verify($userLogin->password, $user->password)) {
                throw new AuthenticationException("Your password is incorrect.");
            }

            return $user;
        }
    }
?>
