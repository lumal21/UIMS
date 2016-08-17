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

namespace UIoT\App\Security;

use UIoT\App\Core\Settings\Register as SettingsRegister;
use UIoT\App\Data\Models\Settings\SecuritySettingsModel;
use Whitelist\Check;

/**
 * Class Manager
 * @package UIoT\App\Security
 */
final class Manager
{
    /**
     * @var Check White List Checker
     */
    private static $whiteList;
    /**
     * @var SecuritySettingsModel
     */
    private $settings;

    /**
     * Start Security Handler
     */
    public function __construct()
    {
        $this->settings = SettingsRegister::get('security');

        $this->start();
    }

    /**
     * Start White List Ip
     */
    private function start()
    {
        self::$whiteList = new Check;

        self::load($this->settings->whiteIpList);
    }

    /**
     * Create White List Parameters
     *
     * @param array $arguments
     */
    public static function load($arguments = [])
    {
        self::$whiteList->whitelist((array)$arguments);
    }
}
