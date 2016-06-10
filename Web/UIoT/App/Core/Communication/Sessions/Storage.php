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
 * Class Storage
 * @package UIoT\App\Core\Communication\Sessions
 *
 * @SuppressWarnings(PHPMD.Superglobals)
 */
final class Storage
{
    /**
     * Get Session Array Key
     *
     * @param string $key
     * @return array
     */
    public function get($key = '')
    {
        return $_SESSION[$key];
    }

    /**
     * Remove Session Array Key
     *
     * @param string $key
     */
    public function remove($key = '')
    {
        unset($_SESSION[$key]);
    }

    /**
     * Set Session Array Key
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get Session Array
     *
     * @return array
     */
    public function getAll()
    {
        return $_SESSION;
    }

    /**
     * Unset all Sessions
     */
    public function removeAll()
    {
        session_unset();
    }

    /**
     * Stop Session Handler
     */
    public function end()
    {
        session_destroy();
    }

    /**
     * Start Session
     */
    public function start()
    {
        session_start();
    }
}
