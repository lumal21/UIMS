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

namespace UIoT\App\Security\Helpers;

/**
 * Class VariableFilters
 * @package UIoT\App\Security\Helpers
 */
final class VariableFilters
{
    /**
     * Sanitize a Variable
     *
     * @param mixed $inputVariable
     * @return array|mixed|string
     */
    public static function sanitizeVariable($inputVariable = '')
    {
        if(is_array($inputVariable) || is_object($inputVariable)) {
            self::sanitizeArray($inputVariable);
        }

        if(is_string($inputVariable)) {
            return self::sanitizeString($inputVariable);
        }

        return $inputVariable;
    }

    /**
     * Sanitize an Array
     *
     * @param array|object $inputArray
     * @return mixed
     */
    protected static function sanitizeArray($inputArray)
    {
        /* $inputArray can be a multidimensional array */
        if(is_array($inputArray) || is_object($inputArray)) {
            return array_map(self::sanitizeVariable($inputArray), (array)$inputArray);
        }

        return $inputArray;
    }

    /**
     * Sanitize a String
     *
     * @param String $inputString
     * @return mixed
     */
    protected static function sanitizeString($inputString)
    {
        return str_replace(['\\', "\0", "\n", "\r", "'", '"', "\x1a"],
            ['\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'], $inputString);
    }
}
