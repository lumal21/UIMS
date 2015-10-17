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

use UIoT\App\Core\Helpers\Manipulators\Settings;

/**
 * Class Starter
 * @package UIoT\App\Core\Communication\Sessions
 */
final class Starter
{
    /**
     * @var Handler
     */
    private $handler;

    /**
     * Init session Handler
     */
    public function __construct()
    {
        $this->setSettings();
        $this->setInstance();
        $this->setHandler();
        $this->startSession();
    }

    /**
     * Set Session Handler to Store in Files
     */
    private function setSettings()
    {
        ini_set('session.save_handler', 'files');
    }

    /**
     * Instantiate the Session Handler
     */
    private function setInstance()
    {
        $this->handler = new Handler(Settings::getSetting('security')->session_handler_salt, Settings::getSetting('security')->session_time_out);
    }

    /**
     * Save the Session Handler as PhP Session Handler
     */
    private function setHandler()
    {
        session_set_save_handler($this->handler, true);
    }

    /**
     * Start Session
     */
    public static function startSession()
    {
        session_start();
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
}