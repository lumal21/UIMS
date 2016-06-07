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
     * @param string $sessionKey
     * @return array
     */
    public function getSessionArrayKey($sessionKey = '')
    {
        return $_SESSION[$sessionKey];
    }

    /**
     * Remove Session Array Key
     *
     * @param string $sessionArrayKey
     */
    public function removeSessionArrayKey($sessionArrayKey = '')
    {
        unset($_SESSION[$sessionArrayKey]);
    }

    /**
     * Set Session Array Key
     *
     * @param $sessionArrayKey
     * @param $sessionArrayValue
     */
    public function setSessionArrayKey($sessionArrayKey, $sessionArrayValue)
    {
        $_SESSION[$sessionArrayKey] = $sessionArrayValue;
    }

    /**
     * Get Session Array
     *
     * @return array
     */
    public function getSessionArray()
    {
        return $_SESSION;
    }
}
