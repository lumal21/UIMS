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

namespace UIoT\App\Data\Models\Settings;

use UIoT\App\Data\Interfaces\SettingsInterface;

/**
 * Class SecuritySettingsModel
 *
 * @package UIoT\App\Data\Models\Settings
 */
final class SecuritySettingsModel implements SettingsInterface
{
    /**
     *
     * Max length = 24 characters
     *
     * @var string
     */
    public $sessionHandlerSalt = 'uniform-internetofthings';
    /**
     *
     * Session expire time interval
     *
     * @var integer
     */
    public $sessionTimeOut = 960;
    /**
     *
     * Developer access allowed ip addresses
     *
     * @var array
     */
    public $whiteIpList = [];

    /**
     *
     * Return Block Name
     *
     * @return string
     */
    public final function getBlockName()
    {
        return 'security';
    }
}

