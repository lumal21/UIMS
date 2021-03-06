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
     * Define a Constant with jSON
     *
     * @param string $constantName Name
     * @param mixed $constantValue Value
     * @param int $constantOptions jSON Options
     * @return string|null
     */
    public static function addJson($constantName, $constantValue = '', $constantOptions = 0)
    {
        self::add($constantName, Json::jsonEncode($constantValue, $constantOptions));
    }

    /**
     * Define a Constant
     *
     * @param string $constantName Name
     * @param string $constantValue Value
     */
    public static function add($constantName, $constantValue = '')
    {
        defined($constantName) || define($constantName, $constantValue);
    }

    /**
     * Add Serialized Constant
     *
     * @param $constantName
     * @param string|array|object $constantValue
     */
    public static function addObject($constantName, $constantValue)
    {
        self::add($constantName, serialize($constantValue));
    }

    /**
     * Return Unserialized Constant
     *
     * @param string $constantName
     * @return mixed
     */
    public static function getObject($constantName = '')
    {
        return unserialize(self::get($constantName));
    }

    /**
     * Return Constant
     *
     * @param string $constantName
     * @return string
     */
    public static function get($constantName = '')
    {
        return defined($constantName) ? constant($constantName) : '';
    }

    /**
     * Return Json Constant
     *
     * @param string $constantName
     * @return mixed
     */
    public static function getJson($constantName = '')
    {
        return Json::jsonDecode(self::get($constantName));
    }
}
