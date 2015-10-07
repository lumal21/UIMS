<?php
/**
     * Created by PhpStorm.
     * User: claudio.santoro
     * Date: 9/25/2015
     * Time: 4:06 PM
     */

namespace UIoT\App\Core\Helpers\Manipulators;

use UIoT\App\Core\Controllers\Indexer;

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
    static function toActionName($x)
    {
        return (Strings::toActionName(((stripos($x, '__action') !== false) ? (str_ireplace('__action', '', $x)) : $x)));
    }

    /**
     * @param $key
     * @param string $value
     * @param array $array
     */
    static function addOnArray($key, $value, &$array = [])
    {
        $array[$key] = $value;
    }

    /**
     * Check if is Instance of Closure
     * (Used on ArrayMap)
     *
     * @param string $a
     * @return mixed
     */
    static function isInstanceOfClosure($a)
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
    static function checkIsInstanceOf($a, $b)
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
    static function toControllerName($x)
    {
        return (Strings::toControllerName($x));
    }

    /**
     * Convert to Controller Name an entire Array
     *
     * @param array $a
     * @return array
     */
    static function toControllerArray($a = [])
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
    static function staticToArray($controller_name = '')
    {
        return (array_map('self::toActionName', get_class_methods(Indexer::getControllerNameSpace($controller_name))));
    }

    /**
     * Remove Blank Items from Array
     *
     * @param array $array
     * @return array
     */
    static function removeBlank($array = [])
    {
        return array_values(array_diff($array, ['']));
    }

    /**
     * Get Entire Methods (Actions) of UIoT Abstract Controller
     * (Only for Public - non-static - methods)
     *
     * @param array $a
     * @return array
     */
    static function abstractToArray($a = [])
    {
        return (array_map('self::toActionName', array_keys((array)$a)));
    }
}