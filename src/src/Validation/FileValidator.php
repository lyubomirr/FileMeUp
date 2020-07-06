<?php
    require_once(Config::constructFilePath("/Validation/BaseValidator.php"));

    class FileValidator extends BaseValidator {
        private const NAME_MAXLENGTH = 100;
        private const DESCRIPTION_MAXLENGTH = 255;

        public static function validateFile($file) {
            $errors = [];

            parent::validateRequired($file->name, "Name", $errors);
            parent::validateFieldLength($file->name, "Name", 0, self::NAME_MAXLENGTH, $errors);

            parent::validateFieldLength($file->description, "Description", 0, self::DESCRIPTION_MAXLENGTH, $errors); 
            return $errors;
        }
    }
?>