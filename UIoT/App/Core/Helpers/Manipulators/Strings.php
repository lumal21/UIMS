<?php
/**
 * Created by PhpStorm.
 * User: claudio.santoro
 * Date: 9/25/2015
 * Time: 4:06 PM
 */

namespace UIoT\App\Core\Helpers\Manipulators;

/**
 * Class Strings
 * @package UIoT\App\Core\Helpers\Manipulators
 */
class Strings
{
    /**
     * Convert string to a NameSpace String
     *
     * @param string $class
     * @param string $namespace
     * @return bool|string
     */
    static function toNameSpace($class = '', $namespace = '')
    {
        return ((class_exists($namespace . ($class = self::toControllerName($class))) ? ($namespace . $class) : false));
    }

    /**
     * Convert string to Controller String
     *
     * @param string $string
     * @return string
     */
    static function toControllerName($string = '')
    {
        return (self::toActionName($string));
    }

    /**
     * Convert string to Action String
     *
     * @param $string
     * @return string
     */
    static function toActionName($string = '')
    {
        return (ucfirst(strtolower($string)));
    }

    /**
     * Convert to valid REST(Raise) url
     *
     * @param string $string
     * @return string
     */
    static function toRestUrlName($string = '')
    {
        return (strtolower($string));
    }

    /**
     * Convert string to Actions Methods Names
     *
     * @param $string
     * @return string
     */
    static function toActionMethodName($string = '')
    {
        return ('__action' . self::toActionName($string));
    }

    /**
     * Remove Method String from Action String
     *
     * @param string $string
     * @return string
     */
    static function removeMethodName($string = '')
    {
        return ((stripos($string, '__action') !== false) ? (self::toActionName(str_ireplace('__action', '', $string))) : (self::toActionName($string)));
    }
}