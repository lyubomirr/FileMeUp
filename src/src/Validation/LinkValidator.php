<?php
    require_once(Config::constructFilePath("/Validation/BaseValidator.php"));

    class LinkValidator extends BaseValidator {
        private const PASSWORD_MAXLENGTH = 100;
        private const COUNT_MINVALUE = 0;

        public static function validateLink($link) {
            $errors = [];

            parent::validateFieldLength($link->password, "Password", 0, self::PASSWORD_MAXLENGTH, $errors);

            parent::validateNumberValue($link->count, "Count", self::COUNT_MINVALUE, $errors); 
            return $errors;
        }
    }
?>