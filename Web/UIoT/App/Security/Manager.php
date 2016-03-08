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
 * @developer Igor Moraes
 * @copyright University of Brasília
 */

namespace UIoT\App\Security;

use UIoT\App\Core\Helpers\Data\ClientData;
use UIoT\App\Core\Helpers\System\Settings;
use UIoT\App\Core\Helpers\System\Settings\SettingsIndexer;
use UIoT\App\Data\Models\Settings\SecuritySettingsModel;
use UIoT\App\Exception\Register;
use Whitelist\Check;

/**
 * Class Manager
 * Security Manager
 *
 * @package UIoT\App\Security
 */
final class Manager
{
    /**
     * this class will use security helpers
     * like:
     *  - string cleaning
     *  - ip verification
     *  - xss verification
     *  - filter all $_REQUESTS
     *  - handle white list-ip system
     *  - and more
     * @param array $arguments
     */

    /**
     *
     * Settings variable
     *
     * @var SecuritySettingsModel
     */
    private $settings;

    /**
     * @var Check
     */
    private static $white_list;

    /**
     * Start Security Handler
     */
    public function __construct()
    {
        /* set settings */
        $this->setSettings(SettingsIndexer::getSetting('security'));

        /* start white list checker */
        $this->startWhiteList();
    }

    /**
     * Start White List Ip
     */
    private function startWhiteList()
    {
        /* start white list checker */
        self::$white_list = new Check;

        /* load white list ip */
        self::loadIpWhiteList($this->settings->whiteIpList);
    }

    /**
     * Create White List Parameters
     *
     * @param array $arguments
     */
    public static function loadIpWhiteList($arguments = [])
    {
        self::$white_list->whitelist((array)$arguments);
    }

    /**
     * Check white list Ip Address
     *
     * @return boolean
     */
    public static function checkWhiteListIp()
    {
        return self::$white_list->check(ClientData::getRealClientIpAddress());
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
        Register::getRunner()->errorMessage(904,
            "Stop! {$title}!",
            'Details: ',
            ['What Happened?' => $message],
            true
        );
    }

    /**
     *
     * Set settings
     *
     * @param SecuritySettingsModel $settings
     */
    public function setSettings(SecuritySettingsModel $settings)
    {
        $this->settings = $settings;
    }
}
