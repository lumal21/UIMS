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
     * @param string $key
     * @param mixed|array|object|int|string|null $value
     */
    public static function add($key, $value)
    {
        self::exists($key) || Manager::getStorage()->set($key, $value);
    }

    /**
     * Check if SESSION key Exists
     *
     * @param string $key
     * @return bool
     */
    public static function exists($key)
    {
        return array_key_exists($key, Manager::getStorage()->getAll());
    }

    /**
     * Remove SESSION key
     *
     * @param string $key
     */
    public static function remove($key)
    {
        !self::exists($key) || Manager::getStorage()->remove($key);
    }

    /**
     * Get SESSION key value
     *
     * Return Session Key Value
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        return self::exists($key) ? Manager::getStorage()->get($key) : '';
    }

    /**
     * Update SESSION key value
     *
     * @param $key
     * @param $value
     */
    public static function update($key, $value)
    {
        !self::exists($key) || Manager::getStorage()->set($key, $value);
    }
}
