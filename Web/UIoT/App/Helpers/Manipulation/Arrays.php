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
     *
     * Convert String to ActionName
     * (Used on Array_Map)
     *
     * @param $x
     * @return string
     */
    public static function toActionName($x)
    {
        return Strings::toActionName(stripos($x, '__action') !== false ? (str_ireplace('__action', '', $x)) : $x);
    }

    /**
     *
     * Check if is InstanceOf
     * (Used on ArrayMap)
     *
     * @param $a
     * @param string $b
     * @return mixed
     */
    public static function checkIsInstanceOf($a, $b)
    {
        return $a instanceof $b ? $a() : $a;
    }

    /**
     *
     * Convert to Controller Name
     * (Used on ArrayMap)
     *
     * @param $x
     * @return string
     */
    public static function toControllerName($x)
    {
        return Strings::toControllerName($x);
    }

    /**
     *
     * Convert to Controller Name an entire Array
     *
     * @param mixed $a
     *
     * @return array
     */
    public static function toControllerArray($a = [])
    {
        return array_map('self::toControllerName', (array)$a);
    }

    /**
     *
     * Case Insensitive in Array
     *
     * @param mixed $needle
     * @param mixed $haystack
     *
     * @return bool
     */
    public static function inArray($needle, $haystack)
    {
        return in_array(strtolower($needle), array_map('strtolower', $haystack));
    }
}
