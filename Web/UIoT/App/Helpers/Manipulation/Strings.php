<?php

/**
 * UIoTuims
 * @version dev-alpha
 *                          88
 *                          ""              ,d
 *                                          88
 *              88       88 88  ,adPPYba, MM88MMM
 *              88       88 88 a8"     "8a  88
 *              88       88 88 8b       d8  88
 *              "8a,   ,a88 88 "8a,   ,a8"  88,
 *               `"YbbdP'Y8 88  `"YbbdP"'   "Y888
 *
 * @project Uniform Internet of Things
 * @app UIoT User-Friendly Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Helpers\Manipulation;

use UIoT\App\Security\Helpers\VariableFilters;

/**
 * Class Strings
 * @package UIoT\App\Helpers\Manipulation
 */
class Strings
{
    /**
     * Check if is Equal
     *
     * @param string $firstString
     * @param string $secondString
     * @return bool
     */
    public static function isEqual($firstString, $secondString)
    {
        return self::toLower($firstString) == self::toLower($secondString);
    }

    /**
     * Convert to valid REST(Raise) url
     *
     * @param string $string
     * @return string
     */
    public static function toLower($string = '')
    {
        return strtolower($string);
    }

    /**
     * Convert string to Actions Methods Names
     *
     * @param $string
     * @return string
     */
    public static function toAction($string = '')
    {
        return ('action' . self::toCamel($string));
    }

    /**
     * Convert string to Controller String
     *
     * @param string $string
     * @param bool $forceCamel
     * @return string
     */
    public static function toCamel($string = '', $forceCamel = false)
    {
        if($forceCamel) {
            $string = str_replace('_', ' ', $string);
        }

        return ucfirst(self::toLower($string));
    }

    /**
     * Remove Empty HTML Lines
     *
     * @param string $string
     * @return mixed
     */
    public static function removeEmptyLines($string = '')
    {
        return preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $string);
    }

    /**
     * Sanitize the String
     *
     * @param string $inputString
     * @return array|mixed|string
     */
    public static function sanitizeString($inputString = '')
    {
        return VariableFilters::sanitizeVariable((string)$inputString);
    }

    /**
     * Check if is Regex
     *
     * @param string $string
     * @return bool
     */
    public static function isRegex($string)
    {
        return (bool)preg_match("/^\/[\s\S]+\/$/", $string);
    }
}
