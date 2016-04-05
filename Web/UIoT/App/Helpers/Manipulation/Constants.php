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
 * Class Constants
 * @package UIoT\App\Helpers\Manipulation
 */
final class Constants
{
    /**
     *
     * Define a Constant with jSON
     *
     * @param string $constant_name Name
     * @param mixed $constant_value Value
     * @param int $constant_options jSON Options
     *
     * @return string|null
     */
    public static function addJsonConstant($constant_name, $constant_value = '', $constant_options = 0)
    {
        self::addConstant($constant_name, Json::jsonEncode($constant_value, $constant_options));
    }

    /**
     *
     * Define a Constant
     *
     * @param string $constant_name Name
     * @param string $constant_value Value
     */
    public static function addConstant($constant_name, $constant_value = '')
    {
        defined($constant_name) || define($constant_name, $constant_value);
    }

    /**
     *
     * Add Serialized Constant
     *
     * @param $constant_name
     * @param string|array|object $constant_value
     */
    public static function addSerializedConstant($constant_name, $constant_value)
    {
        self::addConstant($constant_name, serialize($constant_value));
    }

    /**
     *
     * Return Unserialized Constant
     *
     * @param string $constant_name
     *
     * @return mixed
     */
    public static function returnSerializedConstant($constant_name = '')
    {
        return unserialize(self::returnConstant($constant_name));
    }

    /**
     *
     * Return Constant
     *
     * @param string $constant_name
     *
     * @return string
     */
    public static function returnConstant($constant_name = '')
    {
        return defined($constant_name) ? constant($constant_name) : '';
    }

    /**
     *
     * Return Json Constant
     *
     * @param string $constant_name
     *
     * @return mixed
     */
    public static function returnJsonConstant($constant_name = '')
    {
        return Json::jsonDecode(self::returnConstant($constant_name));
    }
}
