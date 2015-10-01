<?php
/**
 * Created by PhpStorm.
 * User: claudio.santoro
 * Date: 9/25/2015
 * Time: 4:06 PM
 */

namespace UIoT\App\Classes\Helpers;

use UIoT\App\Classes\Controllers\Indexer;

/**
 * Class Arrays
 * @package UIoT\App\Classes\Helpers
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
     * Check if is Instance of Closure
     * (Used on ArrayMap)
     *
     * @param $a
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
     * @param $b
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
     * @internal param array $a
     * @return array
     */
    static function staticToArray($controller_name = '')
    {
        return (array_map('self::toActionName', get_class_methods(Indexer::getControllerNameSpace($controller_name))));
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