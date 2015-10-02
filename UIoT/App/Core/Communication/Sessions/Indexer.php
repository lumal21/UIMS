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
 * @copyright University of Brasília
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
     * @param string $key_value
     */
    static function addKey($key_name, $key_value)
    {
        (self::keyExists($key_name)) || ($_SESSION[$key_name] = $key_value);
    }

    /**
     * Check if SESSION key Exists
     *
     * @param string $key_name
     * @return bool
     */
    static function keyExists($key_name)
    {
        return array_key_exists($key_name, $_SESSION);
    }

    /**
     * remove SESSION key
     *
     * @param string $key_name
     */
    static function removeKey($key_name)
    {
        if (self::keyExists($key_name)) unset($_SESSION[$key_name]);
    }

    /**
     * Check if is needed to Update a SESSION key
     *
     * @param $key_name
     * @param $key_value
     * @return mixed
     */
    static function updateKeyIfNeeded($key_name, $key_value)
    {
        /* first check if exists, and if exists, check if value is different, if is, update value, else, do nothing */
        (!self::keyExists($key_name)) || (((self::getKeyValue($key_name)) != $key_value) ? (self::updateKey($key_name, $key_value)) : null);

        /* return value if exists, if not return only key value */
        return ((self::keyExists($key_name)) ? (self::getKeyValue($key_name)) : $key_value);
    }

    /**
     * get SESSION key value
     *
     * Return Session Key Value
     * @param string $key_name
     * @return mixed
     */
    static function getKeyValue($key_name)
    {
        return ((self::keyExists($key_name)) ? $_SESSION[$key_name] : '');
    }

    /**
     * update SESSION key value
     *
     * @param $key_name
     * @param $key_value
     */
    static function updateKey($key_name, $key_value)
    {
        ($_SESSION[$key_name] = $key_value);
    }
}