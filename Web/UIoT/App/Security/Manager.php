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
use UIoT\App\Exception\Manager as ExceptionManager;
use UIoT\App\Helpers\Data\ClientData;
use Whitelist\Check;

/**
 * Class Manager
 * @package UIoT\App\Security
 */
final class Manager
{
    /**
     * @var SecuritySettingsModel
     */
    private $settings;

    /**
     * @var Check White List Checker
     */
    private static $whiteList;

    /**
     * Start Security Handler
     */
    public function __construct()
    {
        $this->setSettings(SettingsRegister::getSetting('security'));

        $this->startWhiteList();
    }

    /**
     * Start White List Ip
     */
    private function startWhiteList()
    {
        self::$whiteList = new Check;

        self::loadIpWhiteList($this->settings->whiteIpList);
    }

    /**
     * Create White List Parameters
     *
     * @param array $arguments
     */
    public static function loadIpWhiteList($arguments = [])
    {
        self::$whiteList->whitelist((array)$arguments);
    }

    /**
     * Check white list Ip Address
     *
     * @return boolean
     */
    public static function checkWhiteListIp()
    {
        return self::$whiteList->check(ClientData::getRealClientIpAddress());
    }

    /**
     * Check if Ip Address is valid to Security Access
     *
     * @return null|void
     */
    public static function checkIpAddressAuthority()
    {
        self::checkWhiteListIp() || self::securityProblem(
            'You Don\'t have Permissions',
            'You Don\'t have authorization to get Exception Stack from the Server.
            That Happens because your IP address isn\'t in the white list.'
        );
    }

    /**
     * Security Problem
     *
     * @param string $title
     * @param string $message
     * @throws \Exception
     */
    public static function securityProblem($title = '', $message = '')
    {
        ExceptionManager::throwError(904,
            "Stop! {$title}!",
            'Details: ',
            ['What Happened?' => $message],
            true
        );
    }

    /**
     * Set settings
     *
     * @param SecuritySettingsModel $settings
     */
    public function setSettings($settings)
    {
        $this->settings = $settings;
    }
}
