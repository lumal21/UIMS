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

namespace UIoT\App\Core\Communication\Sessions;

use UIoT\App\Core\Helpers\System\Settings;

/**
 * Class Manager
 * @package UIoT\App\Core\Communication\Sessions
 */
final class Manager
{
    /**
     * @var Storage
     */
    private static $storage;
    /**
     * @var Handler
     */
    private static $handler;

    /**
     * Init session Handler
     */
    public function __construct()
    {
        $this->setSettings();
        $this->setHandler();
        $this->startSession();
        $this->setStorage();
    }

    /**
     * Set Session Handler to Store in Files
     */
    private function setSettings()
    {
        ini_set('session.save_handler', 'files');
        ini_set('session.serialize_handler', 'php_serialize');
    }

    /**
     * Save the Session Handler as PhP Session Handler
     */
    private function setHandler()
    {
        session_set_save_handler(new Handler(Settings::getSetting('security')->session_handler_salt, Settings::getSetting('security')->session_time_out), true);
    }

    /**
     * Start Session
     */
    public static function startSession()
    {
        session_start();
    }

    /**
     * Instantiate the Session Handler
     */
    private function setStorage()
    {
        self::$storage = new Storage;
    }

    /**
     * Unset all Sessions
     */
    public static function eraseSession()
    {
        session_unset();
    }

    /**
     * Stop Session Handler
     */
    public static function stopSession()
    {
        session_destroy();
    }

    /**
     * Get Session Storage Manager
     *
     * @return Storage
     */
    public static function getStorage()
    {
        return self::$storage;
    }

    /**
     * Get Session Handler
     *
     * @return Handler
     */
    public static function getHandler()
    {
        return self::$handler;
    }
}
