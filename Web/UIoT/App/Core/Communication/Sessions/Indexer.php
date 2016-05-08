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
     * @param string $keyName
     * @param mixed|array|object|int|string|null $keyValue
     */
    public static function addKey($keyName, $keyValue)
    {
        self::keyExists($keyName) || Manager::getStorage()->setSessionArrayKey($keyName, $keyValue);
    }

    /**
     * Check if SESSION key Exists
     *
     * @param string $keyName
     * @return bool
     */
    public static function keyExists($keyName)
    {
        return array_key_exists($keyName, Manager::getStorage()->getSessionArray());
    }

    /**
     * Remove SESSION key
     *
     * @param string $keyName
     */
    public static function removeKey($keyName)
    {
        !self::keyExists($keyName) || Manager::getStorage()->removeSessionArrayKey($keyName);
    }

    /**
     * Check if is needed to Update a SESSION key
     *
     * @param string $keyName
     * @param $keyValue
     * @return mixed
     */
    public static function updateKeyIfNeeded($keyName, $keyValue)
    {
        /* first check if exists, and if exists, check if value is different, if is, update value, else, do nothing */
        (!self::keyExists($keyName) && self::getKeyValue($keyName) == $keyValue) || self::updateKey($keyName, $keyValue);

        /* return value if exists, if not return only key value */
        return self::keyExists($keyName) ? self::getKeyValue($keyName) : $keyValue;
    }

    /**
     * Get SESSION key value
     *
     * Return Session Key Value
     * @param string $keyName
     * @return mixed
     */
    public static function getKeyValue($keyName)
    {
        return self::keyExists($keyName) ? Manager::getStorage()->getSessionArrayKey($keyName) : '';
    }

    /**
     * Update SESSION key value
     *
     * @param $keyName
     * @param $keyValue
     */
    public static function updateKey($keyName, $keyValue)
    {
        Manager::getStorage()->setSessionArrayKey($keyName, $keyValue);
    }
}
