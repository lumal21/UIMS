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

namespace UIoT\App\Core\Helpers\Manipulation;

use UIoT\App\Core\Controllers\Indexer;
use UIoT\App\Data\Models\MethodModel;

/**
 * Class Arrays
 * @package UIoT\App\Core\Helpers\Manipulation
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
     * Add value in Method
     *
     * @param $key
     * @param $value
     * @param MethodModel $class
     * @param array $array
     * @return boolean
     */
    public static function addOnHttpMethod($key, $value, MethodModel $class, &$array = [])
    {
        $array[$key] = $class->setData($value);
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
     * @param array $a
     * @return array
     */
    public static function toControllerArray($a = [])
    {
        return array_map('self::toControllerName', (array)$a);
    }

    /**
     *
     * Get Entire Methods (Actions) of User Defined Controller
     * (Only for Public - non-static - methods)
     *
     * @param string $controller_name
     *
     * @return array
     */
    public static function getStaticControllerActions($controller_name = '')
    {
        return array_map('self::toActionName', get_class_methods(Indexer::getControllerNameSpace($controller_name)));
    }

    /**
     *
     * Get Entire Methods (Actions) of UIoT Abstract Controller
     * (Only for Public - non-static - methods)
     *
     * @param array $a
     *
     * @return array
     */
    public static function getAbstractControllerActions($a = [])
    {
        return is_array($a) ? (array_map('self::toActionName', array_keys((array)$a))) : [];
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
