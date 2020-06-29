<?php
    require_once(Config::constructFilePath("/Validation/BaseValidator.php"));


    class UserRegistrationValidator extends BaseValidator {
        private const USERNAME_MAXLENGTH = 50;
        private const EMAIL_MAXLENGTH = 100;
        
        private const PASSWORD_MINLENGTH = 8;
        private const PASSWORD_MAXLENGTH = 100;

        public static function validateUserRegistration($registration) {
            $errors = [];

            parent::validateRequired($registration->username, "Username", $errors);
            parent::validateFieldLength($registration->username, "Username", 0, self::USERNAME_MAXLENGTH, $errors);

            parent::validateRequired($registration->password, "Password", $errors);
            parent::validateFieldLength($registration->password, "Password", self::PASSWORD_MINLENGTH, 
            self::PASSWORD_MAXLENGTH, $errors);

            parent::validateRequired($registration->passwordConfirmation, "Confirm password", $errors);
            parent::validateFieldLength($registration->password, "Confirm password", self::PASSWORD_MINLENGTH, 
            self::PASSWORD_MAXLENGTH, $errors);

            parent::validateFieldLength($registration->email, "Email", 0, self::EMAIL_MAXLENGTH, $errors);
            parent::validateEmail($registration->email, "Email", $errors);

            if($registration->password != $registration->passwordConfirmation) {
                array_push($errors, "Password confirmation doesn't match.");
            }

            return $errors;
        }
    }
?>