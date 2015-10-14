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
     * @return string|false
     */
    public static function toNameSpace($class = '', $namespace = '')
    {
        return ((class_exists($namespace . ($class = self::toControllerName($class))) ? ($namespace . $class) : false));
    }

    /**
     * Convert string to Controller String
     *
     * @param string $string
     * @return string
     */
    public static function toControllerName($string = '')
    {
        return (self::toActionName($string));
    }

    /**
     * Convert string to Action String
     *
     * @param $string
     * @return string
     */
    public static function toActionName($string = '')
    {
        return (ucfirst(strtolower($string)));
    }

    /**
     * Convert to valid REST(Raise) url
     *
     * @param string $string
     * @return string
     */
    public static function toRestUrlName($string = '')
    {
        return (strtolower($string));
    }

    /**
     * Convert string to Actions Methods Names
     *
     * @param $string
     * @return string
     */
    public static function toActionMethodName($string = '')
    {
        return ('__action' . self::toActionName($string));
    }

    /**
     * Remove Method String from Action String
     *
     * @param string $string
     * @return string
     */
    public static function removeMethodName($string = '')
    {
        return ((stripos($string, '__action') !== false) ? (self::toActionName(str_ireplace('__action', '', $string))) : (self::toActionName($string)));
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
}