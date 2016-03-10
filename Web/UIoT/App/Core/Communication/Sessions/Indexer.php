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
 * @copyright University of Bras�lia
 */

namespace UIoT\App\Core\Communication\Sessions;

/**
 * Class Indexer
 * @package UIoT\App\Core\Communication\Sessions
 */
final class Indexer
{
    /**
     * Add SESSION key
     *
     * @param string $key_name
     * @param mixed|array|object|int|string|null $key_value
     */
    public static function addKey($key_name, $key_value)
    {
        self::keyExists($key_name) || Manager::getStorage()->setSessionArrayKey($key_name, $key_value);
    }

    /**
     * Check if SESSION key Exists
     *
     * @param string $key_name
     * @return bool
     */
    public static function keyExists($key_name)
    {
        return array_key_exists($key_name, Manager::getStorage()->getSessionArray());
    }

    /**
     * remove SESSION key
     *
     * @param string $key_name
     */
    public static function removeKey($key_name)
    {
        !self::keyExists($key_name) || Manager::getStorage()->removeSessionArrayKey($key_name);
    }

    /**
     * Check if is needed to Update a SESSION key
     *
     * @param string $key_name
     * @param $key_value
     * @return mixed
     */
    public static function updateKeyIfNeeded($key_name, $key_value)
    {
        /* first check if exists, and if exists, check if value is different, if is, update value, else, do nothing */
        (!self::keyExists($key_name) && self::getKeyValue($key_name) == $key_value) || self::updateKey($key_name, $key_value);

        /* return value if exists, if not return only key value */
        return self::keyExists($key_name) ? self::getKeyValue($key_name) : $key_value;
    }

    /**
     * get SESSION key value
     *
     * Return Session Key Value
     * @param string $key_name
     * @return mixed
     */
    public static function getKeyValue($key_name)
    {
        return self::keyExists($key_name) ? Manager::getStorage()->getSessionArrayKey($key_name) : '';
    }

    /**
     * update SESSION key value
     *
     * @param $key_name
     * @param $key_value
     */
    public static function updateKey($key_name, $key_value)
    {
        Manager::getStorage()->setSessionArrayKey($key_name, $key_value);
    }
}
