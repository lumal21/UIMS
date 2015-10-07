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

/**
 * Class Starter
 * @property Handler handler
 * @package UIoT\App\Core\Communication\Sessions
 */
final class Starter
{
    /**
     * private var with session security settings
     *
     * @var string $settings
     */
    private $settings;

    /**
     * Init session Handler
     */
    public function __construct()
    {
        $this->__settings();
        $this->__security();
        $this->__instance();
        $this->__handler();
        $this->__start();
    }

    /**
     * Set Session Handler to Store in Files
     */
    private function __settings()
    {
        ini_set('session.save_handler', 'files');
    }

    /**
     * Set security Settings
     */
    private function __security()
    {
        $this->settings = (json_decode(SETTINGS)->security);
    }

    /**
     * Instantiate the Session Handler
     */
    private function __instance()
    {
        $this->handler = new Handler(($this->settings->session_handler_salt), ($this->settings->session_time_out));
    }

    /**
     * Save the Session Handler as PhP Session Handler
     */
    private function __handler()
    {
        session_set_save_handler(($this->handler), true);
    }

    /**
     * Start Session
     */
    public static function __start()
    {
        session_start();
    }

    /**
     * Unset all Sessions
     */
    public static function __erase()
    {
        session_unset();
    }

    /**
     * Stop Session Handler
     */
    public static function __stop()
    {
        session_destroy();
    }
}