<?php

/**
 * UIoT CMS
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
 * @app UIoT Content Management System
 * @author UIoT
 * @developer Claudio Santoro
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Core\Helpers\Manipulators;

use UIoT\App\Core\Controllers\Indexer;
use UIoT\App\Data\Models\Method;

/**
 * Class Arrays
 * @package UIoT\App\Core\Helpers\Manipulators
 */
class Arrays
{
    /**
     * Convert String to ActionName
     * (Used on Array_Map)
     *
     * @param $x
     * @return string
     */
    public static function toActionName($x)
    {
        return (Strings::toActionName(((stripos($x, '__action') !== false) ? (str_ireplace('__action', '', $x)) : $x)));
    }

    /**
     * Add Value in Array
     *
     * @param $key
     * @param string $value
     * @param array $array
     */
    public static function addOnArray($key, $value, &$array = [])
    {
        $array[$key] = $value;
    }

    /**
     * Add value in Method
     *
     * @param $key
     * @param $value
     * @param Method $class
     * @param array $array
     */
    public static function addOnHttpMethod($key, $value, Method $class, &$array = [])
    {
        $array[$key] = ($class->setData($value));
    }

    /**
     * Check if is Instance of Closure
     * (Used on ArrayMap)
     *
     * @param string $a
     * @return mixed
     */
    public static function isInstanceOfClosure($a)
    {
        return self::checkIsInstanceOf($a, 'Closure');
    }

    /**
     * Check if is InstanceOf
     * (Used on ArrayMap)
     *
     * @param $a
     * @param string $b
     * @return mixed
     */
    public static function checkIsInstanceOf($a, $b)
    {
        return (($a instanceof $b) ? $a() : $a);
    }

    /**
     * Convert to Controller Name
     * (Used on ArrayMap)
     *
     * @param $x
     * @return string
     */
    public static function toControllerName($x)
    {
        return (Strings::toControllerName($x));
    }

    /**
     * Convert to Controller Name an entire Array
     *
     * @param array $a
     * @return array
     */
    public static function toControllerArray($a = [])
    {
        return (array_map('self::toControllerName', $a));
    }

    /**
     * Get Entire Methods (Actions) of User Defined Controller
     * (Only for Public - non-static - methods)
     *
     * @param string $controller_name
     * @return array
     */
    public static function staticToArray($controller_name = '')
    {
        return (array_map('self::toActionName', get_class_methods(Indexer::getControllerNameSpace($controller_name))));
    }

    /**
     * Remove Blank Items from Array
     *
     * @param array $array
     * @return array
     */
    public static function removeBlank($array = [])
    {
        return ((is_array($array)) ? array_values(array_diff($array, [''])) : []);
    }

    /**
     * Get Entire Methods (Actions) of UIoT Abstract Controller
     * (Only for Public - non-static - methods)
     *
     * @param array $a
     * @return array
     */
    public static function abstractToArray($a = [])
    {
        return ((is_array($a)) ? (array_map('self::toActionName', array_keys((array)$a))) : []);
    }
}