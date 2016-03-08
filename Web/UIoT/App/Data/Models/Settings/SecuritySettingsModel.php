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

namespace UIoT\App\Data\Models\Settings;

use UIoT\App\Data\Interfaces\SettingsInterface;

/**
 * Class SecuritySettingsModel
 *
 * @package UIoT\App\Data\Models\Settings
 */
class SecuritySettingsModel implements SettingsInterface
{
    const settingsBlockName = 'security';

    /**
     *
     * Max length = 24 characters
     *
     * @var string
     */
    var $sessionHandlerSalt;

    /**
     *
     * Session expire time interval
     *
     * @var integer
     */
    var $sessionTimeOut;

    /**
     *
     * Developer access allowed ip addresses
     *
     * @var array
     */
    var $whiteIpList;
}
