<?php
    require_once(Config::constructFilePath("/Models/JsonBehaviour.php"));

    abstract class BaseValidator {
        protected static function validateFieldLength($value, $fieldName, $minlength, $maxlength, &$errors) {
            if($value == null) {
                return;
            }

            $length = strlen($value);
            if($length < $minlength || $length > $maxlength) {
                if($minlength == 0) {
                    array_push($errors, "The field '${fieldName}' should have length less than ${maxlength}.");
                } else {
                    array_push($errors, "The field '${fieldName}' should have length between ${minlength} and ${maxlength}.");
                }

            }
        }

        protected static function validateRequired($value, $fieldName, &$errors) {
            if($value == null) {
                array_push($errors, "The field '${fieldName}' is required.");
            }
        }

        protected static function validateEmail($value, $fieldName, &$errors) {
            if(!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "The email in field '${fieldName}' is invalid.");
            }
        }
    }
?>