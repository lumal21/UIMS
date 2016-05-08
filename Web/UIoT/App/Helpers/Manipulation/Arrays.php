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

/**
 * Class Arrays
 * @package UIoT\App\Helpers\Manipulation
 */
class Arrays
{
    /**
     * Convert String to ActionName
     *
     * @param $x
     * @return string
     */
    public static function toCamel($x)
    {
        return Strings::toCamel(stripos($x, 'action') !== false ? (str_ireplace('action', '', $x)) : $x);
    }

    /**
     * Case Insensitive in Array
     *
     * @param mixed $needle
     * @param mixed $haystack
     * @return bool
     */
    public static function inArray($needle, $haystack)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }
}
