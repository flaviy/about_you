<?php

namespace  AboutYou\Entity\Validators;
/**
 * Class ValidationRules
 * @package AboutYou\Entity\Validators
 */
class ValidationRules
{
    /**
     * Check that value is an integer
     *
     * This method will accept strings that contain only integer data
     * as well.
     *
     * @param string $value The value to check
     * @return bool
     */
    public static function isInteger($value)
    {
        if (!is_scalar($value) || is_float($value)) {
            return false;
        }
        if (is_int($value)) {
            return true;
        }

        return (bool)preg_match('/^-?[0-9]+$/', $value);
    }

    /**
     * Boolean validation, determines if value passed is a boolean integer or true/false.
     *
     * @param string $check a valid boolean
     * @return bool Success
     */
    public static function boolean($check)
    {
        $booleanList = [0, 1, '0', '1', true, false];

        return in_array($check, $booleanList, true);
    }

    /**
     * Check if $check is instance of $className
     * @param $check
     * @param $className
     * @return bool
     */
    public static function isInstanceOf($check, $className){
        return !is_scalar($check)  && $check instanceof $className;
    }

    /**
     * Checks that a string contains something other than whitespace
     * @param string|array $check Value to check
     * @return bool Success
     */
    public static function notBlank($check)
    {
        if (empty($check) && $check !== '0' && $check !== 0) {
            return false;
        }
        return is_scalar($check) && preg_match('/[^\s]+/m', $check);
    }
}